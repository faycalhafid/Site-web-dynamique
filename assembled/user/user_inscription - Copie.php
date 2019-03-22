<?php
// connexion à la base de données
echo "<meta name='author' content='BOUCHAIRA Katrennada and MAACHOU Marouane'>";
include ('../../fonct2/functions/connect_bdd.php');

//on teste si le visiteur a soumis le formulaire d'inscription
if(isset($_POST['Inscription']) && $_POST['Inscription'] == 'Inscription'){
	//on teste l'existence de nos variables. on teste également si elles ne sont pas vides
	if (isset($_POST)) {
		$nom=$_POST['nom'];
		$prenom=$_POST['prenom'];
		$email=$_POST['email'];
		$password=$_POST['password'];

		//on teste si une entrée de la base contient cet email
		$req = $bdd->prepare('select count(*) from users where email=?');
		$req->execute(array($email));
		$data = $req->fetch();
		$req->closeCursor();
		

		// si on n'obtient pas de réponse, le visiteur peut s'inscrire
		if ($data[0] == 0) {
			$req = $bdd->prepare('insert into users (nom,prenom,email,pword,statut) values (?,?,?,?,?)');
			$req->execute(array($nom,$prenom,$email,MD5($password),'membre'));
			session_start();
			$_SESSION['email'] = $email;
			$_SESSION['password']=MD5($password);
			$sql="SELECT id_user FROM users WHERE email=?";
			$arr=array($email);
            include ('../../fonct2/functions/select_from_bdd.php');
            $_SESSION['id_user']=$result[0] ['id_user'];
            $_SESSION['statut']="membre";
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
