<?php
require_once '../database/Database.php';

class User {

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

   // Tìm người dùng theo tên người dùng
   public function findUserByUsername($username){
    $this->db->query('SELECT * FROM users WHERE userName = :username');
    $this->db->bind(':username', $username);
    return $this->db->single();
}

// Đăng ký người dùng mới
public function register($data){
    $this->db->query('INSERT INTO users (userName, userPwd) VALUES (:username, :password)');
    $this->db->bind(':username', $data['userName']);
    $this->db->bind(':password', $data['userPwd']);
    return $this->db->execute();
}
    //Login user
    public function login($username, $password){
        $row = $this->findUserByUsername($username);

        if($row == false) return false;

        $hashedPassword = $row->userPwd;
        if(password_verify($password, $hashedPassword)){
            return $row;
        }else{
            return false;
        }
    }
}
?>