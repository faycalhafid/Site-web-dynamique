<?php
echo "<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>";
    $sql="SELECT * FROM recettes WHERE id_user=?";
    $arr=array($id);
    include "functions/select_from_bdd.php";
    //print_r($result);
    foreach($result as $r) {
        //Pour chaque recette afficher le titre en lien vers le contenu
        echo "<a href=\"contenuRecette.php?id=".$r['id_recette']."\">".$r['titre']. "</a><br/>\n";
    }