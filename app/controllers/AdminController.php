    <?php
        class AdminController extends Controller
        {
            protected $userRepository;

            public function __construct() {
                parent::__construct(); // Call parent constructor to instantiate the database connection
                $this->userRepository = new UserRepository($this->db, 'users', 'User');
            }
            
            public function index()
            {
                $result =  $this->userRepository->findAll(); 
                $this->view('admin/index', ['result' => $result]); 
            }
            

            public function createUserView()
            {
                return $this->view('admin/createUser');
            }

            public function createUser()
            {
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $user = new User();

                    $user->username = $_POST['username'];
                    $user->email = $_POST['email'];
                    $user->role = $_POST['role'];

                    $password = $_POST['password'];
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $user->password = $hashed_password;
                    $user->acc_created_by = $_POST['creator'];
                    $user->loginCount = 0;
                    $this->userRepository->save($user);

                    // SEND MAIL FUNCTIONALITY
                    // $subject = "Account Created Successfully";
                    // $body = "UserName: $user->username     Email: $user->email     Password: $password";
                    // AdminController::sendMail($user->email, $subject, $body);
                    header("Location: /Task1/public/admin/index");

                } else {
                    echo "User Creation Unsuccessful";
                }
            }


            public function edit($id)
            {
                $user = $this->userRepository->findById($id);
                if(!$user){
                    echo "User not found";
                }
                $this->view('admin/editUser', ['user' => $user]);
            }

            public function editUser()
            {
                if(isset($_POST['id'])) {
                    $user = $this->userRepository->findById($_POST['id']);

                    if($user) {
                        $user->username = $_POST['username'];
                        $user->email = $_POST['email'];
                        $user->role = $_POST['role'];
                        $this->userRepository->update($user);
                        
                        header("Location: /Task1/public/admin/index");
                        exit();
                    } else {
                        echo "User not found.";
                    }
                } else {
                    echo "User ID not provided.";
                }
            }


            public function deleteUser($id)
            {
                if(!$this->userRepository->delete($id)){
                    echo "User Deletion Unsuccessful";
                }
                header("Location: /Task1/public/admin/index");
            }

            public function sendMail($email, $subject, $body)
            {
                require '../vendor/autoload.php'; 
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->SMTPDebug = 2;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'adhikarikshitiz12@gmail.com';
                $mail->Password = 'rrng qogp wfoh purf';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('adhikarikshitiz12@gmail.com', 'Kshitiz Adhikari');
                $mail->addAddress($email);

                // Add CC and BCC recipients if needed
                // $mail->addCC('cc@example.com', 'CC Name');
                // $mail->addBCC('bcc@example.com', 'BCC Name');

                
                $mail->Subject = $subject;
                $mail->Body    = $body;

                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                    die;
                } else {
                    echo 'Message has been sent successfully';
                    header("Location: /Task1/public/admin/index");

                }

            }
            
        }