<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "admin";
    $db = "website_db";
    $pdo=null;
    $dsn = 'mysql:host=' . $dbhost . ';dbname=' . $db;
    try {  
        $pdo = new PDO($dsn, $dbuser,  $dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        echo 'Database connection failed.';
        die();
    }  
?>