<?php

    class HomeController extends Controller
    {
        public function index()
        {
            $this->view('home/index');
        }

        public function signup()
        {
            $this->view('home/signup');
        }
    }