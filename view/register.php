<?php
include_once 'header.php';
include_once '../helpers/session_helper.php';
?>

<h1 class="header">Điền thông tin để tạo tài khoản mới !</h1>

<?php flash('register') ?>

<form method="post" action="../controllers/uController.php">
    <input type="hidden" name="type" value="register">
    <input type="text" name="userName" placeholder="Username...">
    <input type="password" name="userPwd" placeholder="Password...">
    <input type="password" name="pwdRepeat" placeholder="Repeat password">
    <button type="submit" name="submit">Đăng ký</button>
</form>

<?php
include_once 'footer.php';
