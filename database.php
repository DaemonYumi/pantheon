<?php

$servername = "localhost";
$username = "root";
$password = "";

    try {
        $pdo = new PDO("mysql:host=".$servername.";dbname=pantheon", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
        
        // set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully"; 

    }catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

    
    function fetch($sql_statement, $array_value){
        $pdo = $GLOBALS['pdo'];
    
        $res = $pdo -> prepare($sql_statement);
        $res -> execute($array_value);
        return $res -> fetch(PDO::FETCH_ASSOC); 
    }
    
    function fetchAll($sql_statement, $array_value){
        $pdo = $GLOBALS['pdo'];
    
        $res = $pdo -> prepare($sql_statement);
        $res -> execute($array_value);
        return $res -> fetchAll(PDO::FETCH_ASSOC); 
    }
    
    function executeSQL($sql_statement, $array_value){
        $pdo = $GLOBALS['pdo'];
        $pdo -> prepare($sql_statement) -> execute($array_value);    
    }


?>