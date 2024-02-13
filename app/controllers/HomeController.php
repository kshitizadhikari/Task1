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
            $username = $_POST['username'];
            $password = $_POST['password'];
            $userMapper = new GenericMapper($this->db, 'users');
            $user = $userMapper->findByUserName($username);


            if(!$user)
            {
                echo "User Not Found";
                die;
            }
            if (password_verify($password, $user->password)) {
                echo "yay";
            }

            // return header("Location: /MVC/public/user/index");


        }
    }