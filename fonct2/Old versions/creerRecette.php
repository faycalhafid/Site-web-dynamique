<html>
<h> Création d'une recette !</h><br/><br/>

<form method="post" action="creerRecette.php">
    <li/>Titre :<br/> <input type="text" name="titre" value="Titre de la recette"/><br/>
    <li/>Auteur : <br/><input type="text" name="auteur" value="Votre nom"/><br/>
    <li/>Catégorie de la recette : <br/><input type="radio" name="categorie" value="entree"/>Entrée<br/>
    <input type="radio" name="categorie" value="plat"/>Plat<br/>
    <input type="radio" name="categorie" value="dessert"/>Dessert<br/><br/>
    <input type="submit" name="submit" value="Créer"><br/>
</form>
<br/><br/><a href="viewRecettes.php">Retour</a>
</html>
<?php
$server="localhost";
$user="root";
$password='';
$bd="bddrecettes";
//connexion
try{
    $pdo=new PDO("mysql:host=$server;dbname=$bd",$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}
catch (PDOException $e){
    die("Error : ".$e->getMessage());
}
if($_POST){
    extract($_POST);
    $titre=$_POST['titre'];
    $auteur=$_POST['auteur'];
    $categorie=$_POST['categorie'];
    $sql="INSERT INTO recettes(`titre`,`auteur`,`datecreation`,`categorie`) VALUES (?,?,DATE(NOW()),?)";
    $res=$pdo->prepare($sql);
    $res->execute(array($titre,$auteur,$categorie));
    $sql="SELECT ID FROM recettes WHERE (`titre`=? AND `auteur`=?)";
    $res=$pdo->prepare($sql);
    $res->execute(array($titre,$auteur));
    $result=$res->fetchAll(PDO::FETCH_ASSOC);
    $id=$result[0]['ID'];

    header('Location: remplirRecette.php?id='.$id);
}
?>
