<?php

require_once '../models/User.php';
require_once '../helpers/session_helper.php';

class UserController
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new User;

        // Kiểm tra cookie và đăng nhập tự động nếu có
        if (isset($_COOKIE['remember_me_username']) && isset($_COOKIE['remember_me_password'])) {
            $username = $_COOKIE['remember_me_username'];
            $password = $_COOKIE['remember_me_password'];
            $loggedInUser = $this->userModel->login($username, $password);
            if ($loggedInUser) {
                // Tạo session
                $this->createUserSession($loggedInUser);
            }
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $data = [
                'userName' => trim($_POST['userName']),
                'userPwd' => trim($_POST['userPwd']),
                'pwdRepeat' => trim($_POST['pwdRepeat'])
            ];
            // Kiểm tra mật khẩu trùng khớp
            if ($data['userPwd'] !== $data['pwdRepeat']) {
                flash("register", "Passwords don't match");
                redirect("../view/register.php");
            }

            // Kiểm tra xem tên người dùng đã tồn tại chưa
            if ($this->userModel->findUserByUsername($data['userName'])) {
                flash("register", "Username already taken");
                redirect("../view/register.php");
            }

            // Hash mật khẩu trước khi lưu vào cơ sở dữ liệu
            $data['userPwd'] = password_hash($data['userPwd'], PASSWORD_DEFAULT);

            // Thực hiện đăng ký người dùng
            if ($this->userModel->register($data)) {
                redirect("../view/login.php");
                success("register", "Register successfully, now you can login");
            } else {
                die("Something went wrong");
            }
        } else {
            // Nếu không phải phương thức POST, chuyển hướng về trang đăng ký
            redirect("../view/register.php");
        }
    }

    public function login()
    {
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'userName' => trim($_POST['userName']),
            'userPwd' => trim($_POST['userPwd'])
        ];

        if (empty($data['userName']) || empty($data['userPwd'])) {
            flash("login", "Please fill out all inputs");
            header("location: ../view/login.php");
            exit();
        }


        //Check for user
        if ($this->userModel->findUserByUsername($data['userName'])) {
            //User Found
            $loggedInUser = $this->userModel->login($data['userName'], $data['userPwd']);
            if ($loggedInUser) {
                //Create session
                $this->createUserSession($loggedInUser);
                redirect("../view/index.php");
                success("login", "Login successfully");
            } else {
                flash("login", "Password Incorrect");
                redirect("../view/login.php");
            }
        } else {
            flash("login", "No user found");
            redirect("../view/login.php");
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['userId'] = $user->userId;
        $_SESSION['userName'] = $user->userName;

        // Kiểm tra xem người dùng đã chọn "Lưu trạng thái đăng nhập" hay không
        if (isset($_POST['remember'])) {
            // Lưu thông tin đăng nhập vào cookies trong 30 ngày
            $cookie_name_id = "remember_me_id";
            $cookie_value_id = $user->userId;
            setcookie($cookie_name_id, $cookie_value_id, time() + (30 * 24 * 60 * 60), "/");

            $cookie_name_username = "remember_me_username";
            $cookie_value_username = $user->userName;
            setcookie($cookie_name_username, $cookie_value_username, time() + (30 * 24 * 60 * 60), "/");

            // Không lưu mật khẩu vào cookie nếu đăng nhập tự động
            if (!isset($_COOKIE['remember_me_password'])) {
                $cookie_name_password = "remember_me_password";
                $cookie_value_password = password_hash($_POST['userPwd'], PASSWORD_DEFAULT);
                setcookie($cookie_name_password, $cookie_value_password, time() + (30 * 24 * 60 * 60), "/");
            }
        }
    }



    public function logout()
    {
        // Xóa các biến phiên và hủy phiên
        session_unset();
        session_destroy();

        // Xóa cookies nếu tồn tại
        if (isset($_COOKIE['remember_me_id'])) {
            setcookie('remember_me_id', '', time() - 3600, '/');
        }
        if (isset($_COOKIE['remember_me_username'])) {
            setcookie('remember_me_username', '', time() - 3600, '/');
        }
        if (isset($_COOKIE['remember_me_password'])) {
            setcookie('remember_me_password', '', time() - 3600, '/');
        }

        // Chuyển hướng đến trang index hoặc trang đăng nhập
        redirect("../view/index.php");
    }
}
