<?php
require_once 'db_connect.php';

class User {

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    //Find user by email or username
    public function findUserByUsername($username){
        $this->db->query('SELECT * FROM users WHERE usersUid = :username');
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    //Register User
    public function register($data){
        $this->db->query('INSERT INTO users (usersUid, usersPwd) VALUES (:username, :password)');
        //Bind values
        $this->db->bind(':username', $data['usersUid']);
        $this->db->bind(':password', $data['usersPwd']);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //Login user
    public function login($username, $password){
        $row = $this->findUserByUsername($username);

        if($row == false) return false;

        $hashedPassword = $row->usersPwd;
        if(password_verify($password, $hashedPassword)){
            return $row;
        }else{
            return false;
        }
    }
}
?>