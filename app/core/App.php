<?php

class App {

    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
        $url[0] = $url[0] . 'Controller';
        // Check if the controller file exists
        if(file_exists('../app/controllers/'. $url[0] .'.php')) {
            $this->controller = $url[0];
            // Remove the controller segment from the URL
            unset($url[0]);
        }

        // Include the controller file
        require_once '../app/controllers/'. $this->controller .'.php';

        $this->controller = new $this->controller;

        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);

    }   

    public function parseUrl() {
        if(isset($_GET['url'])) {
            // Explode the URL into segments and sanitize them
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}

?>
