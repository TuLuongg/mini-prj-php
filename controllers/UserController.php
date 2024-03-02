<?php

require_once '../models/User.php';
require_once '../helpers/session_helper.php';

class Users {

    private $userModel;
    
    public function __construct(){
        $this->userModel = new User;
    }

    public function register(){
        //Process form
        
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'usersUid' => trim($_POST['usersUid']),
            'usersPwd' => trim($_POST['usersPwd']),
            'pwdRepeat' => trim($_POST['pwdRepeat'])
        ];

        //Validate inputs
        if(empty($data['usersUid']) || empty($data['usersPwd']) || empty($data['pwdRepeat'])){
            flash("register", "Please fill out all inputs");
            redirect("../register.php");
        }

        if(strlen($data['usersPwd']) < 6){
            flash("register", "Invalid password");
            redirect("../register.php");
        } else if($data['usersPwd'] !== $data['pwdRepeat']){
            flash("register", "Passwords don't match");
            redirect("../register.php");
        }

        //User with the same username already exists
        if($this->userModel->findUserByUsername($data['usersUid'])){
            flash("register", "Username already taken");
            redirect("../register.php");
        }

        //Passed all validation checks.
        //Now going to hash password
        $data['usersPwd'] = password_hash($data['usersPwd'], PASSWORD_DEFAULT);

        //Register User
        if($this->userModel->register($data)){
            redirect("../login.php");
        }else{
            die("Something went wrong");
        }
    }

    public function login(){
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data=[
            'name' => trim($_POST['name']),
            'usersPwd' => trim($_POST['usersPwd'])
        ];

        if(empty($data['name']) || empty($data['usersPwd'])){
            flash("login", "Please fill out all inputs");
            redirect("../login.php");
        }

        //Check for user
        $loggedInUser = $this->userModel->login($data['name'], $data['usersPwd']);
        if($loggedInUser){
            //Create session
            $this->createUserSession($loggedInUser);
        }else{
            flash("login", "Username or password incorrect");
            redirect("../login.php");
        }
    }

    public function createUserSession($user){
        $_SESSION['usersId'] = $user->usersId;
        $_SESSION['usersUid'] = $user->usersUid;
        redirect("../index.php");
    }

    public function logout(){
        unset($_SESSION['usersId']);
        unset($_SESSION['usersUid']);
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

?>