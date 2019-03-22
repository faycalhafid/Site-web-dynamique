<?php
    include ('functions/connect_bdd.php');
    if(isset($_POST['submit'])){
        $note=$_POST['rating'];
        $ID=$_GET['id'];
        $utilisateur=$_GET['utilisateur'];
        $sql="SELECT auteur FROM recettes WHERE id_recette=".$ID;
        try {
            $arr=array();
            include "functions/select_from_bdd.php";
        }
        catch(PDOException $e){
            die("Error : ".$e->getMessage());
        }
        if ($utilisateur!=$res){
            $sql="INSERT INTO noterecette(`id_recette`,`user`,`note`) VALUES(?,?,?)";
            $arr=array($ID,$utilisateur,$note);
            include ('functions/pass_to_bdd.php');
        }
    }
    include ('functions/disconnect_bdd.php');
