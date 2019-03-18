<?php
if (!defined('included')){
    die('Sorry you cannot access this file directly!');
}

class db_connect{

    protected  $conn;
    function connection_start(){
        $this->conn = new  mysqli(db_host,db_user,db_pass,db_name);
        if($this->conn->connect_error) die("Error");
        return $this->conn;
    }
    function quit_connection(){
        $end = $this->conn;
        mysqli_close($end);
        return;
    }
}



?>