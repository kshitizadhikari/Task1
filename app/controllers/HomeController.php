<?php

class HomeController extends Controller
{
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

        $userMapper = new GenericMapper($this->db, 'users');
        $user = $userMapper->findByUserName($usernameOrEmail);

        if (!$user) {
            $user = $userMapper->findByUserEmail($usernameOrEmail);
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

            if ($user->role == 'admin') {
                header("Location: /Task1/public/admin/index");
                exit();
            } elseif ($user->role == 'user') {
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
