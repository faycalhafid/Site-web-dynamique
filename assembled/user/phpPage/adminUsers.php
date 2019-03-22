<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body id='first'>
<form id='form' name="fonctionnalités" action="adminUsers.php" method="post">
<P>Pour afficher la liste des utilisateurs, veuillez cliquer sur le bouton ci-dessous</p>
<input type="submit" value="afficheliste" name="afficheliste">
</br>
<?php
// connexion à la base de données
include ('test_connexion.php');
$bdd = connectbdd();
$url = '../img/images.jpeg';
$url1 = '../img/bloquer.jpg';
if(isset($_POST['afficheliste']) && $_POST['afficheliste'] == 'afficheliste'){
	$req = $bdd->prepare("select * from user where statut !='administrateur'");
	$req->execute(array());
        
	while( $data=$req->fetch(PDO::FETCH_ASSOC) ){       
		echo $data['nom']." ".$data['prenom']."   ".$data['email']."<a href=\"deleteUser.php?id=".$data['ID_user']."\">
<img src= ".$url." width='15' height='15'/></a> <a href=\"bloquerUser.php?id=".$data['ID_user']."\"> <img src= ".$url1." width='15' height='15'/></a><br>";

	}
	$req->closeCursor();
}      
?>
</form>
</body>
</html>
<?php
if (isset($erreur)) echo '<br />',$erreur;
?>
    <a href="deconnexion.php">Déconnexion</a> <br>
<a href="membre.php">Retour</a>
