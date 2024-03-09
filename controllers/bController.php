<?php
require_once 'BlogController.php';
$blogController = new BlogController();

// Xử lý yêu cầu dựa trên type được gửi từ form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'add':
            $blogController->addContent();
            break;
        case 'delete':
            $blogController->deleteContent();
            break;
        case 'update':
            $blogController->updateContent();
            break;
        default:
            redirect("../view/blog.php");
    }
} else {
    redirect("../view/blog.php");
}
