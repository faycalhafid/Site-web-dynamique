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
echo '<h>Liste des recettes disponibles : </h><br/><br/>';
$sql="SELECT * FROM recettes";
$pdoStatement=$pdo->query($sql);
$result=$pdoStatement->fetchAll(PDO::FETCH_ASSOC);
//print_r($result);

foreach($result as $r) {
    echo '<a href=\'contenuRecette.php?id='.$r['ID'].'\'>'.$r['titre'], '</a><br>';
}
echo '<br/><br/> <a href=\'creerRecette.php\'>Créer une nouvelle recette</a>';
if ($pdo){
    $pdo=NULL;
}