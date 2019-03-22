<?php
echo "<meta name='author' content='AROUSSI Amal and MAJDOUBI Imen'>";
    include "functions/connect_bdd.php";
    @session_start();
    if ($_SESSION['statut']!="blocked"){
        $id_recette=$_GET['id_recette'];
        $id_user=$_GET['user'];
        $commentaire=$_POST['commentaire'];
        $sql="INSERT INTO commentaires(`id_recette`,`id_user`,`commentaire`,`date_commentaire`) VALUES (?,?,?,DATE(NOW()))";
        $arr=array($id_recette,$id_user,$commentaire);
        include "functions/pass_to_bdd.php";
    }

    header("Location: contenuRecette.php?id=".$id_recette);
