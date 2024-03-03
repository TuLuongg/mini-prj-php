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
    
        // Kiểm tra xem người dùng đã chọn "Nhớ mật khẩu" hay không
        if(isset($_POST['remember'])){            
            // Lưu thông tin đăng nhập vào cookies trong 30 ngày
            $cookie_name_username = "remember_me_username";
            $cookie_value_username = $user->userName;
            setcookie($cookie_name_username, $cookie_value_username, time() + (30 * 24 * 60 * 60), "/");
    
            $cookie_name_password = "remember_me_password";
            $cookie_value_password = $_POST['userPwd']; // Lưu mật khẩu chưa mã hóa, hãy chắc chắn rằng bạn mã hóa mật khẩu trước khi lưu nó.
            setcookie($cookie_name_password, $cookie_value_password, time() + (30 * 24 * 60 * 60), "/");
        }
    
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

    