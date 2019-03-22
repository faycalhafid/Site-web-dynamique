<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])){
	$email=$_SESSION['email'];
	$password=$_SESSION['password'];
}
include ('test_connexion.php');
$bdd = connectbdd();

if(isset($_POST['Modification']) && $_POST['Modification'] == 'Modification'){
//on teste l'existence de nos variables. on teste également si elles ne sont pas vides
	if ((isset($_POST['nouveau_nom']) && isset ($_POST['nouveau_prenom']) && isset ($_POST['nouveau_email']) && isset ($_POST['nouveau_password'])) && (!empty($_POST['nouveau_nom'])  || !empty($_POST['nouveau_prenom']) || !empty($_POST['nouveau_email']) || !empty($_POST['nouveau_password']))){
		if (!empty($_POST['nouveau_nom'])) {
			$nouveau_nom=$_POST['nouveau_nom'];
			$req = $bdd->prepare("update user set nom ='$nouveau_nom' where email=?");
			$req->execute(array($email));
			$data = $req->fetch();
			$req->closeCursor();
			$erreur = 'Modification effectuée avec succès';
		}

		if (!empty($_POST['nouveau_prenom'])) {
			$nouveau_prenom=$_POST['nouveau_prenom'];
			$req = $bdd->prepare("update user set prenom ='$nouveau_prenom' where email=?");
			$req->execute(array($email));
			$data = $req->fetch();
			$req->closeCursor();
			$erreur = 'Modification effectuée avec succès';
		}

		if (!empty($_POST['nouveau_password'])) {
			$nouveau_password=$_POST['nouveau_password'];
			$req = $bdd->prepare("update user set password ='MD5($nouveau_password)' where email=?");
			$req->execute(array($email));
			$data = $req->fetch();
			$req->closeCursor();
			$erreur = 'Modification effectuée avec succès';
		}

		if (!empty($_POST['nouveau_email'])) {
			$nouveau_email=$_POST['nouveau_email'];
			$req = $bdd->prepare('select count(*) from user where email=?');
			$req->execute(array($nouveau_email));
			$data = $req->fetch();
			$req->closeCursor();
			if ($data[0] == 0) {
				$req = $bdd->prepare("update user set email ='$nouveau_email' where email=?");
				$req->execute(array($email));
				$data = $req->fetch();
				$req->closeCursor();
				$erreur = 'Modification effectuée avec succès';
			}
			else{
				$erreur = 'Ce mail existe déjà';
			}			
		}
	}
	else{
		$erreur = 'Saisir les informations à modifer';
	}
}



?>

<?php
if (isset($erreur)) echo '<br />',$erreur;
?>
