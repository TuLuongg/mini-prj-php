<?php
if(isset($_SESSION['username'])) {
    echo "<p>Welcome, {$_SESSION['username']}! <a href='index.php?logout=true'>Logout</a></p>";
} else {
    echo "<form method='post'><input type='text' name='username' placeholder='Username'><input type='password' name='password' placeholder='Password'><input type='checkbox' name='remember'> Remember me<input type='submit' name='login' value='Login'></form>";
}
?>

<div id="crud">
    <h2>CRUD Operations</h2>
    <form id="createForm" method="post">
        <input type="text" name="name" placeholder="Enter item name">
        <button type="submit" name="action" value="create">Create</button>
    </form>
    <!-- List items (not implemented in this example) -->
</div>