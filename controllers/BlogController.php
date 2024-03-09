<?php
require_once '../models/Blog.php';
require_once '../helpers/session_helper.php';

class BlogController
{

    private $blogModel;

    public function __construct()
    {
        $this->blogModel = new Blog();
    }

    public function addContent()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $content = trim($_POST['content']);

            // Thêm nội dung vào blog
            if ($this->blogModel->addContent($content)) {
                success('blog', 'Content added successfully');
                redirect("../view/blog.php");
            } else {
                flash('blog', 'Failed to add content');
                redirect("../view/blog.php");
            }
        } else {
            redirect("../view/blog.php");
        }
    }

    public function deleteContent()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ID của nội dung muốn xóa
            $id = trim($_POST['id']);

            // Xóa nội dung từ blog
            if ($this->blogModel->deleteContent($id)) {
                success('blog', 'Content deleted successfully');
                redirect("../view/blog.php");
            } else {
                flash('blog', 'Failed to delete content');
                redirect("../view/blog.php");
            }
        } else {
            redirect("../view/blog.php");
        }
    }

    public function updateContent()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $id = trim($_POST['id']);
            $content = trim($_POST['content']);

            // Cập nhật nội dung vào blog
            if ($this->blogModel->updateContent($id, $content)) {
                success('blog', 'Content updated successfully');
                redirect("../view/blog.php");
            } else {
                flash('blog', 'Failed to update content');
                redirect("../view/blog.php");
            }
        } else {
            redirect("../view/blog.php");
        }
    }
}
