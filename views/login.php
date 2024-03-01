<?php
include_once 'header.php';
require_once('controllers/UserController.php');

?>
<h1 class="header">Hãy điền thông tin để đăng nhập</h1>


<form method="post" action="./controllers/Users.php">
    <input type="hidden" name="type" value="login">
    <input type="text" name="name" placeholder="Username">
    <input type="password" name="usersPwd" placeholder="Password">
    <input type="checkbox" name="remember_me" id="remember_me">
    <label for="remember_me">Remember Me</label>

    <button type="submit" name="submit">LOG IN</button>
</form>

<div class="form-sub-msg"><a href="./reset-password.php">Bạn quên mật khẩu?</a></div>

<?php
include_once 'footer.php'
?>