<?php
require_once 'UserController.php';

$userController = new UserController();

// Ensure that user is sending a post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['type'])) {
        $type = $_POST['type'];
        switch ($type) {
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
        // Handle invalid request
        redirect("../view/index.php");
    }
} else {
    if (isset($_GET['q'])) {
        $query = $_GET['q'];
        switch ($query) {
            case 'logout':
                $userController->logout();
                break;
            default:
                redirect("../view/index.php");
        }
    } else {
        // Handle invalid request
        redirect("../view/index.php");
    }
}
?>