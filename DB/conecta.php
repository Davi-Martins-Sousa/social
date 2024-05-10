<?php 
    function getConection(){
        $server = "localhost";
        $user = "root";
        $password = "";
        $database = "social";
        return mysqli_connect($server,$user,$password,$database);
    }
?>