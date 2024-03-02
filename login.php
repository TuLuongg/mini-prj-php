<?php 
    include_once 'header.php';
    include_once './helpers/session_helper.php';
?>
<h1 class="header">Điền thông tin để đăng nhập !</h1>

<?php flash('login') ?>

<form method="post" action="./controllers/UserController.php">
    <input type="hidden" name="type" value="login">
    <input type="text" name="name/email" placeholder="Username/Email...">
    <input type="password" name="usersPwd" placeholder="Password...">
    <button type="submit" name="submit">Đăng nhập</button>
</form>

<div class="form-sub-msg"><a href="./reset-password.php">Bạn quên mật khẩu?</a></div>

<?php 
    include_once 'footer.php'
?>