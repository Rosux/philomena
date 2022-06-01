<?php
    $servername = "localhost";
    $databasename = "philomena";
    $username = "root";
    $password = "";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        exit();
    }
?>