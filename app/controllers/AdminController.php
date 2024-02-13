    <?php

        class AdminController extends Controller
        {
            
            public function index()
            {
                $userMapper = new GenericMapper($this->db, 'users');
                $result =  $userMapper->findAll(); 
                $this->view('admin/index', ['result' => $result]); 
            }

            public function createUser()
            {
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $user = new User();

                    $user->username = $_POST['username'];
                    $user->email = $_POST['email'];
                    $user->password = $_POST['password'];
                    $user->role = "user";

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
                $this->view('admin/edit', ['user' => $user]);
            }

            public function editUser()
            {
                $userMapper = new GenericMapper($this->db, 'users');
                $user = new User;
                $user->id = $_POST['id'];
                $user->username = $_POST['username'];
                $user->email = $_POST['email'];
                $user->role = $_POST['role'];
                $user->password = $_POST['password'];
                $userMapper->update($user);
                
                header("Location: /Task1/public/admin/index");

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