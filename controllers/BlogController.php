<?php
require_once '../models/Blog.php';
require_once '../helpers/session_helper.php';

class BlogController {
    
    private $blogModel;

    public function __construct(){
        $this->blogModel = new Blog();
    }

    public function addContent(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $content = trim($_POST['content']);

            // Thêm nội dung vào blog
            if ($this->blogModel->addContent($content)) {
                flash('blog', 'Content added successfully');
                redirect("../blog.php");
            } else {
                flash('blog', 'Failed to add content');
                redirect("../blog.php");
            }
        } else {
            redirect("../blog.php");
        }
    }

    public function deleteContent(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ID của nội dung muốn xóa
            $id = trim($_POST['id']);

            // Xóa nội dung từ blog
            if ($this->blogModel->deleteContent($id)) {
                flash('blog', 'Content deleted successfully');
                redirect("../blog.php");
            } else {
                flash('blog', 'Failed to delete content');
                redirect("../blog.php");
            }
        } else {
            redirect("../blog.php");
        }
    }
}

$blogController = new BlogController();

// Xử lý yêu cầu dựa trên type được gửi từ form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch($_POST['type']) {
        case 'add':
            $blogController->addContent();
            break;
        case 'delete':
            $blogController->deleteContent();
            break;
        default:
            redirect("../blog.php");
    }
} else {
    redirect("../blog.php");
}
?>