<?php
include ('functions/connect_bdd.php');
echo "<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>";
if($_POST){
    @session_start();
    extract($_POST);
    $titre=$_POST['titre'];
    $categorie=$_POST['categorie'];
    $sql="INSERT INTO recettes(`titre`,`id_user`,`datecreation`,`categorie`) VALUES (?,?,DATE(NOW()),?)";
    $arr=array($titre,$_SESSION['id_user'],$categorie);
    include('functions/pass_to_bdd.php');
    $sql="SELECT id_recette FROM recettes WHERE (`titre`=? AND `id_user`=?)";
    $arr=array($titre,$_SESSION['id_user']);
    include "functions/select_from_bdd.php";
    $id=$result[0]['id_recette'];
    header('Location: remplirRecette.php?id='.$id);
}
