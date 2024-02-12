<?php
    require_once 'core/App.php';
    require_once 'core/Controller.php';
    require_once 'models/Database.php';

    function my_autoloader($class) {
        include 'models/' . $class . '.php';
    }

    spl_autoload_register('my_autoloader');

?>