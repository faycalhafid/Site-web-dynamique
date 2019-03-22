<html>
    <h> Création d'une recette !</h>
    <br/>
    <br/>
    <form method="post" action="creerRecette.php">
        <li/>Titre :<br/> <input type="text" name="titre" value="Titre de la recette"/><br/>
        <li/>Auteur : <br/><input type="text" name="auteur" value="Votre nom"/><br/>
        <li/>Catégorie de la recette : <br/>
        <input type="radio" name="categorie" value="entree"/>Entrée<br/>
        <input type="radio" name="categorie" value="plat"/>Plat<br/>
        <input type="radio" name="categorie" value="dessert"/>Dessert<br/><br/>
        <input type="submit" name="submit" value="Créer"><br/>
    </form>
    <br/>
    <br/>
    <a href="viewRecettes.php">Retour</a>
</html>
<?php
    include ('functions/connect_bdd.php');
    if($_POST){
        extract($_POST);
        $titre=$_POST['titre'];
        $auteur=$_POST['auteur'];
        $categorie=$_POST['categorie'];
        $sql="INSERT INTO recettes(`titre`,`auteur`,`datecreation`,`categorie`) VALUES (?,?,DATE(NOW()),?)";
        $arr=array($titre,$auteur,$categorie);
        include('functions/pass_to_bdd.php');
        $sql="SELECT ID FROM recettes WHERE (`titre`=? AND `auteur`=?)";
        $arr=array($titre,$auteur);
        include "functions/select_from_bdd.php";
        $id=$result[0]['ID'];

        header('Location: remplirRecette.php?id='.$id);
    }
?>
