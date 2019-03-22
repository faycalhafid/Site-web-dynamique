<link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<section class="login-block">
    <div class="container">
	<div class="row">
		<div class="col-md-4 login-sec">
		    <h2 class="text-center">Connexion à l'espace membre:</h2>
<form id='form' class="login-form" action="index.php" method="post">
 <div class="form-group">
 <label for="exampleInputEmail1" class="text-uppercase">Email :</label><input type="text" name="email"  class="form-control" placeholder=""><br/> 
 </div>
<div class="form-group">
    <label for="exampleInputPassword1" class="text-uppercase">
Password : <input type="password" class="form-control" placeholder="" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>"><br/>
  </div>
</form>
    <div class="form-check">
   
    <input type="submit" name="connexion" value="connexion" class="btn btn-login float-right">
  </div>
  
</form>
<div class="copy-text">Created with <i class="fa fa-heart"></i> by <a href="http://grafreez.com">Grafreez.com</a></div>
		</div>
		<div class="col-md-8 banner-sec">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                 <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
            <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        	
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        
    </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="https://images.pexels.com/photos/872957/pexels-photo-872957.jpeg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        
    </div>
  </div>
            </div>	   
		    
		</div>
	</div>
</div>
</section>


<?php
// connexion à la base de données
include ('test_connexion.php');
$bdd = connectbdd();

//on teste si le visiteur a soumis le formulaire de connexion
if(isset($_POST['connexion']) && $_POST['connexion'] == 'connexion'){

	//on teste l'existence de nos variables. on teste également si elles ne sont pas vides
	if ((isset ($_POST['email']) && !empty($_POST['email'])) && (isset ($_POST['password'])&& !empty($_POST['password']))) {
		$email=$_POST['email'];
		$password=$_POST['password'];

		//on teste si une entrée de la base contient cet email
		$req = $bdd->prepare('select count(*) from user where email=? and statut!="bloque"');
		$req->execute(array($email));
		$data = $req->fetch();
		$req->closeCursor();
		

		//si on obtient une réponse, alors le visiteur est un membre
		if ($data[0] == 1) {
			if ($email!='katrennada.bouchaira@supcom.tn') {	
				session_start();
				$_SESSION['email'] = $email;
				$_SESSION['password']=$password;
				header('Location: membre.php');
				exit();	
			}
			else {
				session_start();
				$_SESSION['email'] = $email;
				$_SESSION['password']=$password;
				header('Location: admin.php');
				exit();
			}
		}

		//si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
		elseif ($data[0] == 0) {
		$req = $bdd->prepare('select count(*) from user where statut="bloque"');
		$req->execute(array());
		$data = $req->fetch();
		$req->closeCursor();
			if ($data[0] ==1){
			$erreur= 'Cet utilisateur est bolque';
			}
			else {
			$erreur= 'Ce compte est inexistant.';
			}
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

