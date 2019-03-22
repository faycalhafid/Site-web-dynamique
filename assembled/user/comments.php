<?php
echo "<meta name='author' content='AROUSSI Amal and MAJDOUBI Imen'>";
    include "functions/connect_bdd.php";
    $sql="SELECT * FROM commentaires WHERE id_recette=? ORDER BY date_commentaire";
    $arr=array($ID);
    include("functions/select_from_bdd.php");
    $result2=$result;
    $i=0;
    echo "<table style='color:#23272b;
                font-size: small;'>";
    foreach ($result2 as $r){
        $i++;
        $sql="SELECT nom, prenom FROM users WHERE id_user=?";
        $arr=array($r['id_user']);
        include("functions/select_from_bdd.php");
        echo "<tr> <th style='width:100px;'>".$i."</th><td>";
        echo $result[0]['nom']." ".$result[0]['prenom']." le ".$r['date_commentaire'];
        if ($_SESSION['statut']!="visiteur"){
            if ($_SESSION['statut']=="admin" or $_SESSION['id_user']==$r['id_user']){
                if ($_SESSION['statut']!="blocked"){
                    echo " <a href='update_comment.php?comment=".$r['id_commentaire']."&action=supprimer'><img src=\"delete-button.png\" width='15' height='15'/></a>";
                }
            }
        }


        echo "<br/> ".$r['commentaire']."</td></tr>";
    }

    @session_start();
    if ($_SESSION['statut'] != "visiteur")
    {
        $current_id=$_SESSION['id_user'];
        $sql="SELECT id_user FROM recettes WHERE id_recette=?";
        $arr=array($ID);
        include ("functions/select_from_bdd.php");
        $auteur_id=$result[0]['id_user'];
        if ($auteur_id!=$current_id and $_SESSION['statut']!="blocked"){
            //créer un nouveau commentaire
            echo "
        <form method='post' action='new_comment.php?id_recette=".$ID."&user=".$current_id."'>
            <textarea name='commentaire'></textarea>
            <br/><input type='submit' value='Commenter'/>
        </form>
        ";
        }
    }

