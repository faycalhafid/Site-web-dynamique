<?php
echo "<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>";
    include ('functions/connect_bdd.php');
    if(isset($_POST['submit'])){
        $note=$_POST['rating'];
        $ID=$_GET['id'];
        $utilisateur=$_GET['utilisateur'];
        $sql="SELECT id_user FROM recettes WHERE id_recette=".$ID;
        try {
            $arr=array();
            include "functions/select_from_bdd.php";
            print_r($result);
        }
        catch(PDOException $e){
            die("Error : ".$e->getMessage());
        }
        if ($utilisateur!=$result[0]['id_user']){
            $sql="SELECT * FROM notes WHERE id_recette=? AND id_user=?";
            $arr=array($ID,$utilisateur);
            include "functions/select_from_bdd.php";
            echo "1";
            if (!$result){
                $sql="INSERT INTO notes(`id_recette`,`id_user`,`note`) VALUES(?,?,?)";
                $arr=array($ID,$utilisateur,$note);
                include ('functions/pass_to_bdd.php');
                header('Location: contenuRecette.php?id='.$ID);
                include ('functions/disconnect_bdd.php');

            }
        }
        else{
            echo "2";
            header('Location: contenuRecette.php?id='.$ID);
        }
    }


