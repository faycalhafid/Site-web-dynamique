<?php
    $server="localhost";
    $user="root";
    $password='';
    $bd="our_bdd";
    //connexion
    try{
        $pdo=new PDO("mysql:host=$server;dbname=$bd",$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    }
    catch (PDOException $e){
        die("Error : ".$e->getMessage());
    }
$bdd = $pdo;

