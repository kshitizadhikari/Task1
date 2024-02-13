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
            
        }