<?php

// $root= dirname(__FILE__);
// require_once "$root/auth.php";
require 'includes.php';

use Controller\UserController;

$user = new UserController();

    // Register
    if(isset($_POST['action']) && $_POST['action'] === "register"){

        $fname = $user->test_input($_POST['fname']);
        $lname = $user->test_input($_POST['lname']);
        $email = $user->test_input($_POST['email']);
        $username = $user->test_input($_POST['username']);
        $password = $user->test_input($_POST['password']);

        $hpass = password_hash($password, PASSWORD_DEFAULT);

        // checking if email is registered
        if($user->userExist($email)){
            echo 'Email taken';
        }else{
            $user->registerUser($fname, $lname, $email, $username, $hpass);
            echo 'registered';
        }

    }

    // Login
    if(isset($_POST['action']) && $_POST['action'] === "login"){
       $username = $user->test_input($_POST['username']);
       $password = $user->test_input($_POST['password']);

       $user->login($username, $password);

    }


?>