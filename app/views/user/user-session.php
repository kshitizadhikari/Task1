<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: ../home/login"); 
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $user_role = $_SESSION['user_role'];
?>