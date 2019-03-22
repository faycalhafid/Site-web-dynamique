<?php
session_start();
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
 					<button class="btn btn-danger" data-toggle="modal" data-target="#add_new_record_modal">Espace membre</button>
				        </li>
	                                <li>
 					<a href="adminUsers.php">USERS</a>
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
			<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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

			<!-- Start top-dish Area -->
			<section class="top-dish-area section-gap" id="dish">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">Our Top Rated Dishes</h1>
								<p>Who are in extremely love with eco friendly system.</p>
							</div>
						</div>
					</div>						
					<div class="row">
						<div class="single-dish col-lg-4">
							<div class="thumb">
								<img class="img-fluid"  src="img/d1.jpg" alt="">
							</div>
							<h4 class="text-uppercase pt-20 pb-20">Bread Fruit Cheese Sandwich</h4>
							<p>
								inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct women face higher conduct.
							</p>
						</div>
						<div class="single-dish col-lg-4">
							<div class="thumb">
								<img class="img-fluid"  src="img/d2.jpg" alt="">
							</div>
							<h4 class="text-uppercase pt-20 pb-20">Beef Cutlet with Spring Onion</h4>
							<p>
								inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct women face higher conduct.
							</p>
						</div>
						<div class="single-dish col-lg-4">
							<div class="thumb">
								<img class="img-fluid"  src="../img/d3.jpg" alt="">
							</div>
							<h4 class="text-uppercase pt-20 pb-20">Meat with sauce & Vegetables</h4>
							<p>
								inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct women face higher conduct.
							</p>
						</div>												
					</div>
				</div>	
			</section>
			<!-- End top-dish Area -->
			
			<!-- Start video Area -->
			<section class="video-area">
				<div class="container">
					<div class="row justify-content-center align-items-center flex-column">
						<a class="play-btn" href="http://www.youtube.com/watch?v=0O2aH4XLbto">
							<img src="../img/play-btn.png" alt="">
						</a>
						<h3 class="pt-20 pb-20 text-white">We Always serve the vaping hot and delicious foods</h3>
						<p class="text-white">Youtube video will appear in popover</p>
					</div>
				</div>	
			</section>
			<!-- End video Area -->
			

			<!-- Start features Area -->
			<section class="features-area pt-100" id="feature">
				<div class="container">
					<div class="feature-section">
						<div class="row">
							<div class="single-feature col-lg-3 col-md-6">
								<img src="../img/f1.png" alt="">
								<h4 class="pt-20 pb-20">Refreshing Breakfast</h4>
								<p>
									Lorem ipsum dolor sit ametcons ecteturadipis icing elit.
								</p>
							</div>
							<div class="single-feature col-lg-3 col-md-6">
								<img src="../img/f2.png" alt="">
								<h4 class="pt-20 pb-20">Awesome Lunch</h4>
								<p>
									Lorem ipsum dolor sit ametcons ecteturadipis icing elit.
								</p>
							</div>
							<div class="single-feature col-lg-3 col-md-6">
								<img src="../img/f3.png" alt="">
								<h4 class="pt-20 pb-20">Soothing Dinner</h4>
								<p>
									Lorem ipsum dolor sit ametcons ecteturadipis icing elit.
								</p>
							</div>
							<div class="single-feature col-lg-3 col-md-6">
								<img src="../img/f4.png" alt="">
								<h4 class="pt-20 pb-20">Rich Quality Buffet</h4>
								<p>
									Lorem ipsum dolor sit ametcons ecteturadipis icing elit.
								</p>
							</div>														
						</div>											
					</div>
				</div>	
			</section>
			<!-- End features Area -->


			<!-- Start related Area -->











			<section class="related-area section-gap">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">Les recettes</h1>
								
							</div>
						</div>
					</div>

						<?php

                                                 $db = connectbdd();
						$query = $db->prepare("SELECT * FROM recettes");
							$query->execute();
							$recettes = array();
							while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
							    $recettes[] = $row;}	
						// Design initial table header
						$data = '<div class="active-realated-carusel">';

						if (count($recettes ) > 0) {

						    foreach ($recettes as $recette) {
							$data .= '<div class="item row align-items-center">
								<div class="col-lg-6 rel-left">
								   <h3>' . $recette ['titre'] . '</h3>
								   <p class="pt-30 pb-30">' . $recette ['datecreation'] . '</p>
									<a href="#" class="primary-btn header-btn text-uppercase">voir menu</a>								   
								</div>
								<div class="col-lg-6">
									<img class="img-fluid" src="../img/slider1.jpg" alt="">
								</div>
							</div>';
							
						    }
						} else {
						    // records not found
						    $data .= '<tr><td colspan="6">Comments not found!</td></tr>';
						}

						$data .= '</div>';

						echo $data;

						?>









						</div>
					</div>
					
			</section>
			<!-- End related Area -->	

			<!-- Start team Area -->
			<section class="team-area section-gap" id="chefs">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-70 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">Meet Our Qualified Chefs</h1>
								<p>Who are in extremely love with eco friendly system.</p>
							</div>
						</div>
					</div>						
					<div class="row justify-content-center d-flex align-items-center">
						<div class="col-md-3 single-team">
						    <div class="thumb">
						        <img class="img-fluid" src="../img/t1.jpg" alt="">
						        <div class="align-items-center justify-content-center d-flex">
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
									<a href="#"><i class="fa fa-linkedin"></i></a>
						        </div>
						    </div>
						    <div class="meta-text mt-30 text-center">
							    <h4>Ethel Davis</h4>
							    <p>Managing Director (Sales)</p>									    	
						    </div>
						</div>
						<div class="col-md-3 single-team">
						    <div class="thumb">
						        <img class="img-fluid" src="../img/t2.jpg" alt="">
						        <div class="align-items-center justify-content-center d-flex">
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
									<a href="#"><i class="fa fa-linkedin"></i></a>
						        </div>
						    </div>
						    <div class="meta-text mt-30 text-center">
							    <h4>Rodney Cooper</h4>
							    <p>Creative Art Director (Project)</p>			    	
						    </div>
						</div>	
						<div class="col-md-3 single-team">
						    <div class="thumb">
						        <img class="img-fluid" src="../img/t3.jpg" alt="">
						        <div class="align-items-center justify-content-center d-flex">
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
									<a href="#"><i class="fa fa-linkedin"></i></a>
						        </div>
						    </div>
						    <div class="meta-text mt-30 text-center">
							    <h4>Dora Walker</h4>
							    <p>Senior Core Developer</p>			    	
						    </div>
						</div>	
						<div class="col-md-3 single-team">
						    <div class="thumb">
						        <img class="img-fluid" src="../img/t4.jpg" alt="">
						        <div class="align-items-center justify-content-center d-flex">
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
									<a href="#"><i class="fa fa-linkedin"></i></a>
						        </div>
						    </div>
						    <div class="meta-text mt-30 text-center">
							    <h4>Lena Keller</h4>
							    <p>Creative Content Developer</p>			    	
						    </div>
						</div>																		
					</div>
				</div>	
			</section>
			<!-- End team Area -->			

			<!-- start blog Area -->		
			<section class="blog-area section-gap" id="blog">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-70 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">Latest From Our Blog</h1>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.</p>
							</div>
						</div>
					</div>					
					<div class="row">
						<div class="col-lg-3 col-md-6 single-blog">
							<div class="thumb">
								<img class="img-fluid" src="../img/b1.jpg" alt="">
							</div>
							<p class="date">10 Jan 2018</p>
							<a href="#"><h4>Cooking Perfect Fried Rice
							in minutes</h4></a>
							<p>
								inappropriate behavior ipsum dolor sit amet, consectetur.
							</p>
							<div class="meta-bottom d-flex justify-content-between">
								<p><span class="lnr lnr-heart"></span> 15 Likes</p>
								<p><span class="lnr lnr-bubble"></span> 02 Comments</p>
							</div>									
						</div>
						<div class="col-lg-3 col-md-6 single-blog">
							<div class="thumb">
								<img class="img-fluid" src="../img/b2.jpg" alt="">
							</div>
							<p class="date">10 Jan 2018</p>
							<a href="#"><h4>Secret of making Heart 
							Shaped eggs</h4></a>
							<p>
								inappropriate behavior ipsum dolor sit amet, consectetur.
							</p>
							<div class="meta-bottom d-flex justify-content-between">
								<p><span class="lnr lnr-heart"></span> 15 Likes</p>
								<p><span class="lnr lnr-bubble"></span> 02 Comments</p>
							</div>									
						</div>
						<div class="col-lg-3 col-md-6 single-blog">
							<div class="thumb">
								<img class="img-fluid" src="../img/b3.jpg" alt="">
							</div>
							<p class="date">10 Jan 2018</p>
							<a href="#"><h4>How to check steak if 
							it is tender or not</h4></a>
							<p>
								inappropriate behavior ipsum dolor sit amet, consectetur.
							</p>
							<div class="meta-bottom d-flex justify-content-between">
								<p><span class="lnr lnr-heart"></span> 15 Likes</p>
								<p><span class="lnr lnr-bubble"></span> 02 Comments</p>
							</div>									
						</div>
						<div class="col-lg-3 col-md-6 single-blog">
							<div class="thumb">
								<img class="img-fluid" src="../img/b4.jpg" alt="">
							</div>
							<p class="date">10 Jan 2018</p>
							<a href="#"><h4>Addiction When Gambling
							Becomes A Problem</h4></a>
							<p>
								inappropriate behavior ipsum dolor sit amet, consectetur.
							</p>
							<div class="meta-bottom d-flex justify-content-between">
								<p><span class="lnr lnr-heart"></span> 15 Likes</p>
								<p><span class="lnr lnr-bubble"></span> 02 Comments</p>
							</div>									
						</div>						
					</div>
				</div>	
			</section>
			<!-- end blog Area -->	
	
			

			<script src="../js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
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
					</body>
	</html>






