<?php
// connexion à la base de données
include ('test_connexion.php');
$bdd = connectbdd();
            if(isset($_GET['id']))
            {   
                $ID=$_GET['id'];
                $sql="update user set statut ='bloqué' where ID_user=?";
                $req= $bdd->prepare($sql);
                $req->execute(array($ID));
   
            }

            header('Location: admin.php?id='.$ID);
?>

