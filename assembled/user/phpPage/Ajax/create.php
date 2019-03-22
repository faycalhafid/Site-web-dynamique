<?php
if (isset($_POST['ID_recette']) && isset($_POST['ID_user']) && isset($_POST['commentaire'])) {
    require("lib.php");
    $Auteur = $_POST['ID_user'];
    $recette = $_POST['ID_recette'];
    $commentaire = $_POST['commentaire'];
    $object = new CRUD();
    $object->Create($Auteur,$commentaire,$recette);
}
?>
