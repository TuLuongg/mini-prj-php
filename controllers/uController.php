<?php
require_once 'UserController.php';

$userController = new UserController();

//Ensure that user is sending a post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'register':
            $userController->register();
            break;
        case 'login':
            $userController->login();
            break;
        default:
            redirect("../view/index.php");
    }
} else {
    switch ($_GET['q']) {
        case 'logout':
            $userController->logout();
            break;
        default:
            redirect("../view/index.php");
    }
}
