<?php
    $servername = "localhost";
    $username = "hwyh-dev";
    $password = "pass_12ABC";
    $database_name = "library_management";
    
    try
    {
        $pdo = new PDO("mysql:host=$servername;dbname=$database_name", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 

    catch (PDOException $e) 
    {
        die("Connection failed: " . $e->getMessage());
    }

    session_start();

?>