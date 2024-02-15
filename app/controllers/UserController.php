    
    <?php
        class UserController extends Controller
        {
            protected $userRepository;

            public function __construct() {
                parent::__construct(); // Call parent constructor to instantiate the database connection
                $this->userRepository = new UserRepository($this->db, 'users', 'User');
            }
            
            public function index()
            {
                $this->view('user/index'); 
            }

            public function createUser()
            {
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    
                    $user = new User();
                    $user->username = $_POST['username'];
                    $user->email = $_POST['email'];
                    $user->role = 'user';
                    $user->acc_created_by = 'user';
                    $user->loginCount = 0;
                    $password = $_POST['password'];
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $user->password = $hashed_password;
                    $this->userRepository->save($user);
                    header("Location: /Task1/public/user/index");

                } else {
                    echo "User Creation Unsuccessful";
                }
            }

            public function editDetailsView($id)
            {
                $user = $this->userRepository->findById($id);
                if(!$user){
                    echo "User not found";
                }
                $this->view('user/editDetails', ['user' => $user]);
            }

            public function editDetails()
            {                                                                               
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    UserController::validate_csrf_token($_POST['csrf_token']);

                    $user = $this->userRepository->findById($_POST['id']);
                    $user->username = $_POST['username'];
                    $user->email = $_POST['email'];
                    $user->role = $_POST['role'];

                    if(password_verify($_POST['oldPassword'], $user->password)){
                        $password = $_POST['newPassword'];
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $user->password = $hashed_password;
                        $this->userRepository->update($user);
                        header("Location: /Task1/public/user/index");
                    } else {
                        $errorMsg = "<br>Incorrect Old Password";
                        return $this->view('user/editDetails', ['user' => $user, 'errorMsg' => $errorMsg]);
                    }
                }
                
            }

            public static function validate_csrf_token($token)
            {
                session_start(); 
                if($token !== $_SESSION['csrf_token'])
                    {
                        echo "CSRF token mistmatch"; die;
                    } 
            }
        }