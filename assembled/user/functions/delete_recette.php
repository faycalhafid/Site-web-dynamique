<?php
    echo "<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>";
    $sql1="DELETE FROM listeingredients WHERE `id_recette`=?";
    $sql2="DELETE FROM listeetapes WHERE `id_recette`=?";
    $sql4="DELETE FROM commentaires WHERE `id_recette`=?";
    $sql5="DELETE FROM notes WHERE `id_recette`=?";
    $sql3="DELETE FROM recettes WHERE `id_recette`=?";
    $req=$pdo->prepare($sql1);
    $req->execute(array($ID));
    $req=$pdo->prepare($sql2);
    $req->execute(array($ID));
    $req=$pdo->prepare($sql4);
    $req->execute(array($ID));
    $req=$pdo->prepare($sql5);
    $req->execute(array($ID));
    $req=$pdo->prepare($sql3);
    $req->execute(array($ID));
