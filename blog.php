<?php 
    // Include file header.php và session_helper.php
    include_once 'header.php';
    include_once './helpers/session_helper.php';

    try {
        // Kết nối đến cơ sở dữ liệu
        $pdo = new PDO('mysql:host=localhost;dbname=mini_prj_php', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Chuẩn bị truy vấn SQL để lấy toàn bộ nội dung từ bảng blogs
        $stmt = $pdo->query('SELECT * FROM blogs');
        $contents = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Xử lý ngoại lệ nếu có lỗi kết nối hoặc truy vấn
        echo "Error: " . $e->getMessage();
        $contents = []; // Trả về một mảng rỗng nếu có lỗi
    }
?>
<h1 class="header">Diễn đàn chung !</h1>

<?php flash('blog') ?>

<form method="post" action="./controllers/BlogController.php">
    <input type="hidden" name="type" value="add">
    <input type="text" name="content" placeholder="Content...">
    <button type="submit" name="submit">Thêm</button>
</form>

<ul>
    <?php foreach ($contents as $content): ?>
    <li>
        <?php echo $content['content']; ?>
        <form method="post" action="./controllers/BlogController.php" style="display: inline;">
            <input type="hidden" name="type" value="delete">
            <input type="hidden" name="id" value="<?php echo $content['id']; ?>">
            <button type="submit" name="submit" style="color: red;">Xóa</button>
        </form>
    </li>
    <?php endforeach; ?>
</ul>

<?php 
    // Include file footer.php
    include_once 'footer.php';
?>