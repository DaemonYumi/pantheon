<?php

session_start();

require_once 'includes.php';

use Controller\UserController;

$curruser = new UserController();

// check if there is a user thats logged in
if(!isset($_SESSION['id'])){
    header('location:index.php');
    die;
}

$curr_user_id = $_SESSION['id'];

$data = $curruser->currentUser($curr_user_id);


