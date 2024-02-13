    <?php
        class AdminController extends Controller
        {
            
            public function index()
            {
                $userMapper = new GenericMapper($this->db, 'users');
                $result =  $userMapper->findAll(); 
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

                    $userMapper = new GenericMapper($this->db, 'users');
                    $userMapper->save($user);

                    $subject = "Account Created Successfully";
                    $body = "UserName: $user->username     Email: $user->email     Password: $password";
                    AdminController::sendMail($user->email, $subject, $body);
                    header("Location: /Task1/public/admin/index");

                } else {
                    echo "User Creation Unsuccessful";
                }
            }


            public function edit($id)
            {
                $userMapper = new GenericMapper($this->db, 'users');
                $user = $userMapper->findById($id);
                if(!$user){
                    echo "User not found";
                }
                $this->view('admin/editUser', ['user' => $user]);
            }

            public function editUser()
            {
                if(isset($_POST['id'])) {
                    $userMapper = new GenericMapper($this->db, 'users');
                    $user = $userMapper->findById($_POST['id']);

                    if($user) {
                        $user->username = $_POST['username'];
                        $user->email = $_POST['email'];
                        $user->role = $_POST['role'];
                        $userMapper->update($user);
                        
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
                $userMapper = new GenericMapper($this->db, 'users');
                
                if(!$userMapper->delete($id)){
                    echo "User not found";
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