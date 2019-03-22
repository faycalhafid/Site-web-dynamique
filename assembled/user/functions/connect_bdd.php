<?php
    echo "<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>";
    $server="localhost";
    $user="root";
    $password='';
    $bd="our_bdd";
    //connexion
    try{
        $pdo=new PDO("mysql:host=$server;dbname=$bd",$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $bdd=$pdo;
    }
    catch (PDOException $e){
        die("Error : ".$e->getMessage());
    }


