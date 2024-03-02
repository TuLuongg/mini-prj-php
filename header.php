<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lương Xuân Tú</title>
    <link rel="stylesheet" href="./style.scss" type="text/css">
</head>

<body>
    <nav>
        <ul>
            <a href="index.php">
                <li>Home</li>
            </a>
            <?php if(!isset($_SESSION['usersId'])) : ?>
            <a href="register.php">
                <li>Đăng ký</li>
            </a>
            <a href="login.php">
                <li>Đăng nhập</li>
            </a>
            <?php else: ?>
            <a href="./controllers/Users.php?q=logout">
                <li>Đăng xuất</li>
            </a>
            <?php endif; ?>
        </ul>
    </nav>