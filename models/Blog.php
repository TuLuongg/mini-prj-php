<?php

class Blog
{
    function All()
    {
        require_once('db_connect.php');
        $data = array();
        $sql = "SELECT * FROM blog";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    function find($id)
    {
        require_once('db_connect.php');
        $sql = "SELECT * FROM blog WHERE id='" . $id . "'";
        $data = $conn->query($sql)->fetch_assoc();
        return $data;
    }

    function insert($data)
    {
        require_once('db_connect.php');
        $sql = "INSERT INTO blog (author, date, title, content) VALUES ('" . $data['author'] . "','" . $data['date'] . "','" . $data['title'] . "','" . $data['content'] . "')";
        $result = $conn->query($sql);
        return $result;
    }
    function update($data)
    {
        require_once('db_connect.php');
        $sql = "UPDATE blog SET author='" . $data['author'] . "',date='" . $data['date'] . "',title='" . $data['title'] . "',content='" . $data['content'] . "' WHERE id='" . $data['id'] . "'";
        $result = $conn->query($sql);
        return $result;
    }

    function delete($id)
    {
        require_once('db_connect.php');
        $sql = "DELETE FROM blog WHERE id='" . $id . "'";
        $result = $conn->query($sql);
        return $result;
    }
}
