<?php
    $server="xxxxxx";
    $username="xxx";
    $password="xxxx";
    $database="xxxxxx";

    try{
        $link = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    } catch(PDOException $e)
    {
        die("Connection failed: ".$e->getMessage());
    }
?>