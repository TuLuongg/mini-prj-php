<?php
include_once 'header.php';
include_once '../helpers/session_helper.php';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=mini_prj_php', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query('SELECT * FROM blogs');
    $contents = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    $contents = [];
}
?>
<h1 class="header">Diễn đàn chung !</h1>

<?php flash('blog') ?>

<form method="post" action="../controllers/bController.php">
    <input type="hidden" name="type" value="add">
    <input type="text" name="content" placeholder="Content...">
    <button type="submit" name="submit">Thêm</button>
</form>

<ul>
    <?php foreach ($contents as $content) : ?>
    <li class="content">
        <p class="blog-content"><?php echo $content['content']; ?></p>
        <form method="post" action="../controllers/bController.php" style="display: inline;">
            <input type="hidden" name="type" value="delete">
            <input type="hidden" name="id" value="<?php echo $content['id']; ?>">
            <button class="blog-delete-button" type="submit" name="submit" style="color: red;">Xóa</button>
        </form>
        <!-- Thêm nút cập nhật và form cập nhật -->
        <button class="blog-update-button" onclick="showUpdateForm(<?php echo $content['id']; ?>)">Cập nhật</button>
        <form id="updateForm_<?php echo $content['id']; ?>" method="post" action="../controllers/bController.php"
            style="display: none;">
            <input type="hidden" name="type" value="update">
            <input type="hidden" name="id" value="<?php echo $content['id']; ?>">
            <input type="text" name="content" placeholder="New Content...">
            <button type="submit" name="submit">Cập nhật</button>
        </form>
    </li>
    <?php endforeach; ?>
</ul>

<script>
function showUpdateForm(id) {
    var updateForm = document.getElementById('updateForm_' + id);
    if (updateForm.style.display === "none") {
        updateForm.style.display = "block";
    } else {
        updateForm.style.display = "none";
    }
}
</script>

<?php
include_once 'footer.php';
?>