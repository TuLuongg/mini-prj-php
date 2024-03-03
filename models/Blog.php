<?php
require_once '../database/Database.php';

class Blog {

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getAllContent(){
        try {
            $this->db->query('SELECT * FROM blogs');
            $result = $this->db->resultSet();
            return $result;
        } catch (PDOException $e) {
            // Xử lý ngoại lệ nếu có
            echo "Error: " . $e->getMessage();
            return []; // Trả về một mảng rỗng nếu có lỗi
        }
    }
    

    // Thêm một bản ghi mới vào bảng blogs
    public function addContent($content){
        $this->db->query('INSERT INTO blogs (content) VALUES (:content)');
        $this->db->bind(':content', $content);
        return $this->db->execute();
    }

    // Xóa một bản ghi từ bảng blogs dựa trên id
    public function deleteContent($id){
        $this->db->query('DELETE FROM blogs WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
?>