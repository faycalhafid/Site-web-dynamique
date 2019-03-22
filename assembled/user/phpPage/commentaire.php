<?php
session_start();
$id_recette = $_GET['idrecette'];

include ('test_connexion.php');
if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
	header ('Location: ../index.php');
    	exit();
}
else {
	
	$bdd = connectbdd();
	$email=$_SESSION['email'];
	$password=$_SESSION['password'];
	$req = $bdd->prepare('select prenom from user where email=?');
	$req->execute(array($email));
	$data = $req->fetch();
	$req->closeCursor();
	
}
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
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="../img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="codepixer">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Restaurant</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="../css/linearicons.css">
			<link rel="stylesheet" href="../css/font-awesome.min.css">
			<link rel="stylesheet" href="../css/bootstrap.css">
			<link rel="stylesheet" href="../css/magnific-popup.css">
			<link rel="stylesheet" href="../css/nice-select.css">					
			<link rel="stylesheet" href="../css/animate.min.css">
			<link rel="stylesheet" href="../css/owl.carousel.css">
			<link rel="stylesheet" href="../css/main.css">
		</head>
		<body>

			  <header id="header" id="home">
			    <div class="container">
			    	<div class="row align-items-center justify-content-between d-flex">
				      <div id="logo">
				        <a href="index.html"><img src="../img/logo.png" alt="" title="" /></a>
				      </div>
				      <nav id="nav-menu-container">
				        <ul class="nav-menu">
				          <li class="menu-active"><a href="#home">Home</a></li>
				          <li><a href="#dish">Dish</a></li>
				          <li><a href="#chefs">Chefs</a></li>
				          <li><a href="#blog">Blog</a></li>
				          <li><a href="#contact">Contact</a></li>
				          <li class="menu-has-children"><a href="">Pages</a>
				            <ul>
				              <li><a href="generic.html">Generic</a></li>
				              <li><a href="elements.html">Elements</a></li>
				            </ul>
				          </li>
                                         <li>
 					<button class="btn btn-danger" data-toggle="modal" data-target="#modifier_new_record_modal">Espace membre</button>
				        </li>
					<li>
					<a href="deconnexion.php">Déconnexion</a>
					</li>
					</ul>
				      </nav><!-- #nav-menu-container -->		    		
			    	</div>
			    </div>
			  </header><!-- #header -->

			<!-- Modal - modifier User -->
			<div class="modal fade" id="modifier_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			    <div class="modal-dialog" role="document">
				<div class="modal-content">
				    <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Modifier ses informations:</h4>
				    </div>
				    <div class="modal-body">
			<form id='form' name="Ajouter" action="membre.php" method="post"> 
					<div class="form-group">
					    <label for="nouveau_nom">Nouveau nom :</label>
					    <input type="text" name="nouveau_nom" size="20" "<?php if (isset($_POST['nouveau_nom'])) echo $_POST['nouveau_nom']; ?>" class="form-control"/>
					</div>
			 
					<div class="form-group">
					    <label for="nouveau_prenom">Nouveau prenom</label>
					  <input type="text" name="nouveau_prenom" size="20" "<?php if (isset($_POST['nouveau_prenom'])) echo $_POST['nouveau_prenom']; ?>" class="form-control">
					    
					</div>
                                        <div class="form-group">
					    <label for="nouveau_email">Nouveau email</label>
					  <input type="text" name="nouveau_email" size="20" "<?php if (isset($_POST['nouveau_email'])) echo $_POST['nouveau_email']; ?>" class="form-control">  
					</div>
                                        <div class="form-group">
					    <label for="nouveau_password">Nouveau password</label>
					  <input type="password" name="nouveau_password" size="20" "<?php if (isset($_POST['nouveau_password'])) echo $_POST['nouveau_password']; ?>"class="form-control">  
					</div>
			 
				    </div>
				    <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<input type="submit" value="Modification" name="Modification" class="btn btn-primary" ">
					

				    </div>
				</div>
			    </div>
			</div>
<!-- // Modal -->


<?php
if (isset($erreur)) echo '<br />',$erreur;
?>


<!-- start banner Area -->
			<section class="banner-area relative" id="home">
				<div class="container">
					<div class="row fullscreen d-flex align-items-center justify-content-start">
						<div class="banner-content col-lg-8 col-md-12">
							<h1 class="text-white text-uppercase">Bienvenue
							 <?php   $bdd = connectbdd();
								$email=$_SESSION['email'];
								$password=$_SESSION['password'];
								$req = $bdd->prepare('select prenom from user where email=?');
								$req->execute(array($email));
								$data = $req->fetch(); 
							       echo $data['prenom']; ?> !</h1>
						</div>												
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start related Area -->

			<section class="related-area section-gap">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">La recette</h1>
								
							</div>
						</div> 
					</div>
								<div class="item row align-items-center">
								<div class="col-lg-6 rel-left">
								   <h3><?php   $bdd = connectbdd();							
								$query = $bdd->prepare("SELECT * FROM recettes where ID =?");
								$query->execute(array($_GET['idrecette']));
								$data = $query->fetch(); 
							       echo $data['titre']; ?></h3>
								   <p class="pt-30 pb-30"><?php   $bdd = connectbdd();							
								$query = $bdd->prepare("SELECT * FROM recettes where ID =?");
								$query->execute(array($_GET['idrecette']));
								$data = $query->fetch(); 
							       echo $data['datecreation']; ?> </p>
									<div class="pull-right">
               							 
								<!-- Trigger the modal with a button -->
								<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Ecrire un commentaire</button>

            								</div>
								</div>
								<div class="col-lg-6">
									<img class="img-fluid" src="../img/slider1.jpg" alt="">
								</div>
								<br> <br> 
								 <div class="row">
									<div class="col-md-12">
									    <h3>Commentaires:</h3>
								 
									    <div class="comment_content"></div>
									</div>
								    </div>

							</div>



<!-- Modal - Add New comment-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Postuler commentaire </h4>
      </div>
      <div class="modal-body">
        <label for="last_name">Commentaire</label>
        <input type="text" size="128" id="commentaire" class="form-control"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       <button type="button" class="btn btn-primary" onclick="addComment1()">Ajout commentaire</button>
      </div>
    </div>

  </div>
</div>


<!--  Modal  update commentaire-->
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="update_Commentaire">Commentaire</label>
                    <input type="text" size="128" id="update_Commentaire" class="form-control"/>
                </div>
 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()" >Save Changes</button>
                <input type="hidden" id="hidden_user_id">
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->



						</div>
					</div>
					
			</section>
			<!-- End related Area -->	

			
			

			<script src="../js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 				crossorigin="anonymous"></script>
			<script src="../js/vendor/bootstrap.min.js"></script>			
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="../js/easing.min.js"></script>			
			<script src="../js/hoverIntent.js"></script>
			<script src="../js/superfish.min.js"></script>	
			<script src="../js/jquery.ajaxchimp.min.js"></script>
			<script src="../js/jquery.magnific-popup.min.js"></script>	
			<script src="../js/owl.carousel.min.js"></script>			
			<script src="../js/jquery.sticky.js"></script>
			<script src="../js/jquery.nice-select.min.js"></script>			
			<script src="../js/parallax.min.js"></script>	
			<script src="../js/mail-script.js"></script>	
			<script src="../js/main.js"></script>
			<!-- Jquery JS file -->
			<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
			
			 
			<!-- Custom JS file -->
			<script type="text/javascript" src="../js/script.js"></script>	

			<script type ="text/javascript">
			$(document).ready(function () {
			
			    // READ records on page load
			    var ID_recette= <?php echo json_encode($_GET['idrecette']); ?>; // calling function 
			
                           $.ajax({
			    type: "POST",
			    url: 'Ajax/read.php',
			    data: {ID_recette: ID_recette},
			    success: function(data){ 
                                                    $(".comment_content").html(data);
							    
			    }
			});
                         });
			function addComment1(){
			
                         var commentaire = $("#commentaire").val();
			    commentaire = commentaire.trim();
                           
                              var ID_user = <?php   $bdd = connectbdd();
								$email=$_SESSION['email'];
								$password=$_SESSION['password'];
								$req = $bdd->prepare('select * from user where email=?');
								$req->execute(array($email));
								$data = $req->fetch(); 
							       echo json_encode($data['ID_user']); ?>;
                                 var ID_recette = <?php echo json_encode($_GET['idrecette']); ?>;

				
			    if (commentaire == "") {
				alert("write the comment!");
			    }
			    else {
			$.ajax({
			    type: "POST",
			    url: 'Ajax/create.php',
			    data: {ID_recette: ID_recette, ID_user: ID_user, commentaire: commentaire},
			    success: function(data){ 
                                                    
                                                    $("#commentaire").val("");
						            // close the popup
							  
							    // read records again

						    $.ajax({
						    type: "POST",
						    url: 'Ajax/read.php',
						    data: {ID_recette: ID_recette},
						    success: function(data){ 
                                                    $(".comment_content").html(data);
							    
			    }
			});

                      					$("#myModal").modal("hide");

							  
							    // clear fields from the popup
							    
			    }
			});

			    }			 
                           }



			</script>
			<script type ="text/javascript">
			function DeleteUser1(id){
			var ID_recette= <?php echo json_encode($_GET['idrecette']); ?>;
                          var conf = confirm("Are you sure, do you really want to delete User?");
             if (conf == true) {
				$.ajax({
			    type: "POST",
			    url: 'Ajax/delete.php',
			    data: {id: id},
			    success: function(data){ 
                                                   
						    $.ajax({
						    type: "POST",
						    url: 'Ajax/read.php',
						    data: {ID_recette: ID_recette},
						    success: function(data){ 
                                                    $(".comment_content").html(data);
							    
			    }
			});
							    
			    }
			});
                      }

                     }
			   
</script>
			</body>
			</html>






