<?php

class User
{
    function login($data)
    {
        require_once('db_connect.php');
        $sql = "SELECT * FROM users WHERE username='" . $data['username'] . "' AND password='" . $data['password'] . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            if ($data['remember']) {
                setcookie('username', $row['username'], time() + (86400 * 30), "/"); // 30 days
            }
            return true;
        } else {
            return false;
        }
    }

    function register($data)
    {
        require_once('db_connect.php');
        $sql = "INSERT INTO users (username, password, email, avatar) VALUES ('" . $data['username'] . "','" . $data['password'] . "','" . $data['email'] . "','" . $data['avatar'] . "')";
        $result = $conn->query($sql);
        return $result;
    }
}
