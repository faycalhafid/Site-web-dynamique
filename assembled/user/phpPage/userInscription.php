<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body id='first'>
<form id='form' name="Ajouter" action="userInscription.php" method="post">
<P>Inscription / Devenir membre:</P>
<p>Nom:<input type="text" name="nom" size="20" "<?php if (isset($_POST['nom'])) echo $_POST['nom']; ?>"><br /></p>
<p>Prenom:<input type="text" name="prenom" size="20" "<?php if (isset($_POST['prenom'])) echo $_POST['prenom']; ?>"><br /></p>
<p>Email:<input type="text" name="email" size="20" "<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"><br /></p>
<p>Password:<input type="text" name="password" size="20" "<?php if (isset($_POST['password'])) echo $_POST['password']; ?>"><br /></p>
<input type="submit" value="Inscription" name="Inscription">
</form>
</body>
</html>
<?php
// connexion à la base de données
include ('test_connexion.php');
$bdd = connectbdd();

 
//on teste si le visiteur a soumis le formulaire d'inscription
if(isset($_POST['Inscription']) && $_POST['Inscription'] == 'Inscription'){
	//on teste l'existence de nos variables. on teste également si elles ne sont pas vides
	if ((isset($_POST['nom']) && !empty($_POST['nom'])) && (isset ($_POST['prenom']) && !empty($_POST['prenom'])) && (isset ($_POST['email']) && !empty($_POST['email']))&&(isset ($_POST['password']) && !empty($_POST['password']))) {
		$nom=$_POST['nom'];
		$prenom=$_POST['prenom'];
		$email=$_POST['email'];
		$password=$_POST['password'];

		//on teste si une entrée de la base contient cet email
		$req = $bdd->prepare('select count(*) from user where email=?');
		$req->execute(array($email));
		$data = $req->fetch();
		$req->closeCursor();
		


		// si on n'obtient pas de réponse, le visiteur peut s'inscrire
		if ($data[0] == 0) {
			$req = $bdd->prepare('insert into user (nom, prenom, email,password,statut) values (?,?,?,?,?)');
                    
			$req->execute(array($nom,$prenom,$email,MD5($password),'membre'));

			session_start();
			$_SESSION['email'] = $email;
			$_SESSION['password']=MD5($password);
			header('Location: membre.php');
			exit();
		}
		else{
			$erreur= 'Un membre possède déjà ce mail.';
		}
	}
	else {
		$erreur = 'Au moins un des champs est vide.';
	}
	$bdd=null;		
}

?>

<?php
if (isset($erreur)) echo '<br />',$erreur;
?>
