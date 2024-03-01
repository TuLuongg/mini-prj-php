
<?php
require_once('views/index.php');
$act = isset($_GET['action']) ? $_GET['action'] : 'list';

require_once('controllers/UserController.php');
$user_controller = new UserController();
require_once('controllers/BlogController.php');
$blog_controller = new BlogController();
switch ($act) {
    case 'register':
        $user_controller->register();
        break;
    case 'login':
        $user_controller->login();
        break;
    case 'logout':
        $user_controller->logout();
        break;
    case 'list':
        $blog_controller->list();
        break;
    case 'find':
        $blog_controller->find();
        break;
    case 'add':
        $blog_controller->add();
        $blog_controller->store();
        break;
    case 'edit':
        $blog_controller->edit();
        $blog_controller->update();
        break;
    case 'delete':
        $blog_controller->delete();
        break;
    default:
        echo "Không có gì hết";
        break;
}
?>