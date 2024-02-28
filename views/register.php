<?php 
    include_once 'header.php';
?>

<h1 class="header">Hãy điền thông tin để đăng ký</h1>

<form method="post" action="./controllers/Users.php">
    <input type="hidden" name="type" value="register">
    <input type="text" name="usersUid" placeholder="Username...">
    <input type="password" name="usersPwd" placeholder="Password...">
    <input type="password" name="pwdRepeat" placeholder="Repeat password">
    <button type="submit" name="submit">REGISTER</button>
</form>

<?php 
    include_once 'footer.php'
?>