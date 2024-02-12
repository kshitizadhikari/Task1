<?php

class Controller {

    public $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    
    // public function model($model) {
    //     require_once  '../app/models/' . $model . '.php';
    //     return new $model();
    // }

    public function view($view, $data = []) {
        require_once  '../app/views/'  . $view . '.php';
    }

    public function executeQuery($query, $params = [])
    {
        return $this->db->query($query, $params);
    }
}

?>
