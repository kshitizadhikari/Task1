<?php

class HomeController extends Controller
{

    protected $userRepository;

    public function __construct() {
        parent::__construct(); // Call parent constructor to instantiate the database connection
        $this->userRepository = new UserRepository($this->db, 'users', 'User');
    }

    public function index()
    {
        return $this->view('home/index');
    }

    public function signup()
    {
        return $this->view('home/signup');
    }

    public function login()
    {
        return $this->view('home/login');
    }

    public function loginRedirect()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: /Task1/public/home/login");
            exit();
        }

        $usernameOrEmail = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        if (!$usernameOrEmail || !$password) {
            echo "Please provide both username and password";
            exit();
        }

        $user = $this->userRepository->findByUserName($usernameOrEmail);
        if (!$user) {
            $user = $this->userRepository->findByUserEmail($usernameOrEmail);
            if(!$user) {
                echo "User Not Found";
                exit();
            }
        }

        if (password_verify($password, $user->password)) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = $user->username;
            $_SESSION['user_role'] = $user->role;
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));               
            $loginCount = 0;
            if ($user->role == 'admin') {
                header("Location: /Task1/public/admin/index");
                $loginCount = $user->loginCount + 1;
                $user->loginCount = $loginCount;
                $this->userRepository->update($user);
                exit();
            } elseif ($user->role == 'user') {
                if($user->acc_created_by !== 'user' && $user->loginCount == 0) {
                    $loginCount = $user->loginCount + 1;
                    $user->loginCount = $loginCount;
                    $this->userRepository->update($user);
                    header("Location: /Task1/public/user/editDetailsView/$user->id");
                    exit();
                }
                $loginCount = $user->loginCount + 1;
                $user->loginCount = $loginCount;
                $this->userRepository->update($user);
                header("Location: /Task1/public/user/index");
                exit();
            }
        } else {
            header("Location: /Task1/public/home/login");
            exit();
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: /Task1/public/home/login");
        exit();
    }
}

?>
