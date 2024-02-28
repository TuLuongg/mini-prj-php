<?php
session_start();
include('./controllers/Users.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <?php include("view.php"); ?>
    </div>
    <script src="script.js"></script>
</body>

</html>