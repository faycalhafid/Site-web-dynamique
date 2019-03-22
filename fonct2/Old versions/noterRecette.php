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
if(isset($_POST['submit'])){
    $note=$_POST['rating'];
    $ID=$_GET['id'];
    $utilisateur=$_GET['utilisateur'];
    $requette="SELECT auteur FROM recettes WHERE ID=".$ID;
    try {
        $res=$pdo->prepare($requette);
        $res->execute();
    }
    catch(PDOException $e){
        die("Error : ".$e->getMessage());
    }
    if ($utilisateur!=$res){
        $sql="INSERT INTO noterecette(`ID_recette`,`user`,`note`) VALUES(?,?,?)";
        $req=$pdo->prepare($sql);
        $req->execute(array($ID,$utilisateur,$note));
    }

}
if ($pdo){
    $pdo=NULL;
}
