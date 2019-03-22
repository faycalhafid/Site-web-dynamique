<?php
echo "<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>";
    include('functions/connect_bdd.php');
    echo "<h>Liste des recettes disponibles : </h><br/><br/>\n";
    //Affichage de la liste des recettes qui sont sur la BDD
    $sql="SELECT * FROM recettes WHERE categorie=?";
    $arr=array("entree");
    include "functions/select_from_bdd.php";
    //print_r($result);
    echo " <P>Entrées:</P>";
    foreach($result as $r) {
        //Pour chaque recette afficher le titre en lien vers le contenu
        echo "<a href=\"contenuRecette.php?id=".$r['id_recette']."\">".$r['titre']. "</a><br/>\n";
    }
    $sql="SELECT * FROM recettes WHERE categorie=?";
    $arr=array("plat");
    include "functions/select_from_bdd.php";
    //print_r($result);
    echo " <br/><P>Plats:</P>";
    foreach($result as $r) {
        //Pour chaque recette afficher le titre en lien vers le contenu
        echo "<a href=\"contenuRecette.php?id=".$r['id_recette']."\">".$r['titre']. "</a><br/>\n";
    }
    $sql="SELECT * FROM recettes WHERE categorie=?";
    $arr=array("dessert");
    include "functions/select_from_bdd.php";
    //print_r($result);
    echo " <br/><P>Desserts:</P>";
    foreach($result as $r) {
        //Pour chaque recette afficher le titre en lien vers le contenu
        echo "<a href=\"contenuRecette.php?id=".$r['id_recette']."\">".$r['titre']. "</a><br/>\n";
    }
    // Lien pour créer une nouvelle recette
    @session_start();
    if($_SESSION['statut']!="visiteur" and $_SESSION['statut']!="blocked"){
        echo "<br/><br/> <a href=\"creerRecette.php\">Créer une nouvelle recette</a>\n";
    }


    include('functions/disconnect_bdd.php');