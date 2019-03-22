<?php
    $server="localhost";
    $user="root";
    $password='';
    $bd="bddrecettes";
    //connexion
    try{
        $pdo=new PDO("mysql:host=$server;dbname=$bd",$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    }
    catch (PDOException $e){
        die("Error : ".$e->getMessage());
    }


