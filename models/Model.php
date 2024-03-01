<?php

/**
 * 
 */
include_once('Connection.php');
class Model
{
    var $conn;
    var $table_name = '';
    var $primary_key = '';
    function __construct()
    {
        $connection = new Connection();
        $this->conn = $connection->conn;
    }
}
