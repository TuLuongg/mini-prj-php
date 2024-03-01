<?php
include_once 'header.php';
require_once('controllers/UserController.php');
?>

<h1 class="header">Hãy điền thông tin để đăng ký</h1>

<form method="post" action="./controllers/UsersController.php">
    <input type="hidden" name="type" value="register">
    <input type="text" name="usersUid" placeholder="Username...">
    <input type="password" name="usersPwd" placeholder="Password...">
    <input type="password" name="pwdRepeat" placeholder="Repeat password">
    <input type="submit" name="register">REGISTER</input>
</form>

<?php
include_once 'footer.php'
?>