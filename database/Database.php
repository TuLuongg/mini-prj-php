<?php

class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $dbname = 'mini_prj_php';

    //Đối tượng PDO
    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
        //Set DSN
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        //Tạo phiên bản PDO
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    //Chuẩn bị câu lệnh có truy vấn
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    //Liên kết các giá trị với câu lệnh đã chuẩn bị bằng cách sử dụng các tham số được đặt tên
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    //Thực hiện câu lệnh đã chuẩn bị
    public function execute(){
        return $this->stmt->execute();
    }

    //Trả về nhiều bản ghi
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //Trả về một bản ghi
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //Nhận số hàng
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}