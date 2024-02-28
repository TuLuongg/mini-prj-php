<?php
require_once(__DIR__ . '/../models/userModel.php');


// Handle login/logout
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    if(login($username, $password)) {
        $_SESSION['username'] = $username;
        if($remember) {
            setcookie('username', $username, time() + (86400 * 30), "/"); // 30 days
        }
    }
}

if(isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    setcookie('username', '', time() - 3600, "/");
}

// Handle CRUD operations
if(isset($_POST['action'])) {
    $action = $_POST['action'];
    if($action == 'create') {
        $name = $_POST['name'];
        createItem($name);
    } elseif($action == 'update') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        updateItem($id, $name);
    } elseif($action == 'delete') {
        $id = $_POST['id'];
        deleteItem($id);
    }
}
?>