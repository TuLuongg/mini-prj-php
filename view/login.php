<?php
include_once 'header.php';
include_once '../helpers/session_helper.php';
?>
<h1 class="header">Điền thông tin để đăng nhập !</h1>

<?php flash('login') ?>

<form method="post" action="../controllers/uController.php">
    <input type="hidden" name="type" value="login">
    <input type="text" name="userName" placeholder="Username..." value="<?php echo isset($_COOKIE['remember_me_username']) ? $_COOKIE['remember_me_username'] : ''; ?>">
    <input type="password" name="userPwd" placeholder="Password..." value="<?php echo isset($_COOKIE['remember_me_password']) ? $_COOKIE['remember_me_password'] : ''; ?>">

    <label>Lưu trạng thái đăng nhập</label>
    <input class="remember-checkbox" type="checkbox" name="remember">
    <button class="submit-login-button" type="submit" name="submit">Đăng nhập</button>
</form>

<!-- <div class="form-sub-msg"><a href="./reset-password.php">Bạn quên mật khẩu?</a></div> -->

<?php
include_once 'footer.php'
?>