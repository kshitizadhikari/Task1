    <?php

        class UserController extends Controller
        {
            
            public function index()
            {
                $userMapper = new GenericMapper($this->db, 'users');
                $result =  $userMapper->findAll(); 
                $this->view('user/index', ['result' => $result]); 
            }

            public function edit($id)
            {
                $userMapper = new GenericMapper($this->db, 'users');
                $user = $userMapper->findById($id);
                if(!$user){
                    echo "User not found";
                }
                $this->view('user/edit', ['user' => $user]);
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
                
                header("Location: /MVC/public/user/index");

            }

            public function deleteUser($id)
            {
                $userMapper = new GenericMapper($this->db, 'users');
                
                if(!$userMapper->delete($id)){
                    echo "User not found";
                }
                header("Location: /MVC/public/user/index");

            }
            
        }