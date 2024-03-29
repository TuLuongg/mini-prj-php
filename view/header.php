<?php
session_start();

// Kiểm tra nếu có cookie remember_me_username và remember_me_password, tức là người dùng đã đăng nhập trước đó và chọn "Nhớ mật khẩu"
if (isset($_COOKIE['remember_me_username']) && isset($_COOKIE['remember_me_id'])) {
    // Nếu phiên đăng nhập chưa được thiết lập, hãy sử dụng thông tin từ cookie để thiết lập phiên đăng nhập
    if (!isset($_SESSION['userId'])) {
        $_SESSION['userName'] = $_COOKIE['remember_me_username'];
        $_SESSION['userId'] = $_COOKIE['remember_me_id'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sun* - Talent & Product Incubator Vietnam Unit</title>
    <link rel="stylesheet" href="../public/style.scss" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <base href="index.php">
</head>

<body>
    <nav>
        <ul>
            <a class="header-button" href="./index.php">
                <li class="nav-text-style nunito-nav-text">Trang chủ</li>
            </a>
            <?php if (!isset($_SESSION['userId'])) : ?>
            <a class="header-button" href="./register.php">
                <li class="nav-text-style nunito-nav-text">Đăng ký</li>
            </a>
            <a class="header-button" href="./login.php">
                <li class="nav-text-style nunito-nav-text">Đăng nhập</li>
            </a>
            <?php else : ?>
            <a class="header-button" href="../controllers/uController.php?q=logout">
                <li class="nav-text-style nunito-nav-text">Đăng xuất</li>
            </a>
            <a class="header-button" href="./blog.php">
                <li class="nav-text-style nunito-nav-text">Blogs</li>
            </a>
            <?php endif; ?>
        </ul>
    </nav>