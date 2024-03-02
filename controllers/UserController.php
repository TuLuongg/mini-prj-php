<?php

    require_once '../models/User.php';
    require_once '../helpers/session_helper.php';

    class Users {

        private $userModel;
        
        public function __construct(){
            $this->userModel = new User;
        }

        public function register(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Lấy dữ liệu từ form
                $data = [
                    'userName' => trim($_POST['userName']),
                    'userPwd' => trim($_POST['userPwd']),
                    'pwdRepeat' => trim($_POST['pwdRepeat'])
                ];
    
                // Kiểm tra mật khẩu trùng khớp
                if($data['userPwd'] !== $data['pwdRepeat']){
                    flash("register", "Passwords don't match");
                    redirect("../register.php");
                }
    
                // Kiểm tra xem tên người dùng đã tồn tại chưa
                if($this->userModel->findUserByUsername($data['userName'])){
                    flash("register", "Username already taken");
                    redirect("../register.php");
                }
    
                // Hash mật khẩu trước khi lưu vào cơ sở dữ liệu
                $data['userPwd'] = password_hash($data['userPwd'], PASSWORD_DEFAULT);
    
                // Thực hiện đăng ký người dùng
                if($this->userModel->register($data)){
                    redirect("../login.php");
                } else {
                    die("Something went wrong");
                }
            } else {
                // Nếu không phải phương thức POST, chuyển hướng về trang đăng ký
                redirect("../register.php");
            }
        }

    public function login(){
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data=[
            'userName' => trim($_POST['userName']),
            'userPwd' => trim($_POST['userPwd'])
        ];

        if(empty($data['userName']) || empty($data['userPwd'])){
            flash("login", "Please fill out all inputs");
            header("location: ../login.php");
            exit();
        }

        //Check for user
        if($this->userModel->findUserByUsername($data['userName'])){
            //User Found
            $loggedInUser = $this->userModel->login($data['userName'], $data['userPwd']);
            if($loggedInUser){
                //Create session
                $this->createUserSession($loggedInUser);
            }else{
                flash("login", "Password Incorrect");
                redirect("../login.php");
            }
        }else{
            flash("login", "No user found");
            redirect("../login.php");
        }

    }

    public function createUserSession($user){
        $_SESSION['userId'] = $user->userId;
        $_SESSION['userName'] = $user->userName;
        redirect("../index.php");
    }

    public function logout(){
        unset($_SESSION['userId']);
        unset($_SESSION['userName']);
        session_destroy();
        redirect("../index.php");
    }
}

    $init = new Users;

    //Ensure that user is sending a post request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        switch($_POST['type']){
            case 'register':
                $init->register();
                break;
            case 'login':
                $init->login();
                break;
            default:
            redirect("../index.php");
        }
        
    }else{
        switch($_GET['q']){
            case 'logout':
                $init->logout();
                break;
            default:
            redirect("../index.php");
        }
    }

    