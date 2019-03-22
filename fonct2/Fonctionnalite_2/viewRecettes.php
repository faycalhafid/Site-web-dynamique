<?php
    include('functions/connect_bdd.php');
    echo "<h>Liste des recettes disponibles : </h><br/><br/>\n";
    //Affichage de la liste des recettes qui sont sur la BDD
    $sql="SELECT * FROM recettes";
    $arr=array();
    include "functions/select_from_bdd.php";
    //print_r($result);

    foreach($result as $r) {
        //Pour chaque recette afficher le titre en lien vers le contenu
        echo "<a href=\"contenuRecette.php?id=".$r['ID']."\">".$r['titre']. "</a><br/>\n";
    }
    // Lien pour créer une nouvelle recette
    echo "<br/><br/> <a href=\"creerRecette.php\">Créer une nouvelle recette</a>\n";

    include('functions/disconnect_bdd.php');