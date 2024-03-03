<?php 
    include_once 'header.php';
    include_once './helpers/session_helper.php';

?>
<h1 class="header">Diễn đàn chung !</h1>

<?php flash('blog') ?>

<form method="post" action="./controllers/BlogController.php">
    <input type="hidden" name="type" value="add">
    <input type="text" name="content" placeholder="Content...">
    <button type="submit" name="submit">Thêm</button>
</form>

<?php 
    include_once 'footer.php'
?>