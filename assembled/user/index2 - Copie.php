<?php
// connexion à la base de données
echo "<meta name='author' content='BOUCHAIRA Katrennada and MAACHOU Marouane'>";
include ('../../fonct2/functions/connect_bdd.php');
$bdd = $pdo;

//on teste si le visiteur a soumis le formulaire de connexion
if(isset($_POST['connexion']) && $_POST['connexion'] == 'connexion'){

	//on teste l'existence de nos variables. on teste également si elles ne sont pas vides
	if ((isset ($_POST['email']) && !empty($_POST['email'])) && (isset ($_POST['password']) 	&& !empty($_POST['password']))) {
		$email=$_POST['email'];
		$password=$_POST['password'];

		//on teste si une entrée de la base contient cet email
		$req = $bdd->prepare('select * from users where email=?');
		$req->execute(array($email));
		$data = $req->fetch();
		$req->closeCursor();
		$bdd=null;

		//si on obtient une réponse, alors le visiteur est un membre
		if ($data[0]) {
			if ($email!='admin@gmail.com') {
				session_start();
				$_SESSION['email'] = $email;
				$_SESSION['password']=$password;
				$_SESSION['id_user']=$data['id_user'];
				$statut=$data['statut'];
				$_SESSION['statut']=$statut;
				if ($statut!="blocked"){
                    header('Location: membre.php');
                    exit();
				}
				else{
					echo "Votre compte a été bloqué par un administrateur :(";
				}

			}
			else {
				session_start();
				$_SESSION['email'] = $email;
				$_SESSION['password']=$password;
                $_SESSION['id_user']=$data['id_user'];
                $_SESSION['statut']="admin";
				header('Location: admin.php');
				exit();
			}
		}

		//si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
		elseif ($data[0] == 0) {
			$erreur= 'Ce compte est inexistant.';
		}
		//sinon, prob au niveau bd
		else {
			$erreur = 'Problème dans la base données.';
		}
	}
	else {
		$erreur = 'Au moins un des champs est vide.';		
	}

}
?>

<?php
if (isset($erreur)) echo '<br/><br/>',$erreur;
?>

