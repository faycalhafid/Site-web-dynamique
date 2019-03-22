<?php
echo "<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>";
@session_start();
if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
	header ('Location: index.php');
    	exit();
}
else {
    include ('../../fonct2/functions/connect_bdd.php');
	$email=$_SESSION['email'];
	$password=$_SESSION['password'];
	$req = $bdd->prepare('select prenom,id_user from users where email=?');
	$req->execute(array($email));
	$data = $req->fetch();
	$req->closeCursor();
	$_SESSION['id_user']=$data['id_user'];
	$bdd=null;
}
?>

<html>
	<head>
		<title>Espace membre</title>
		<!--<link rel="stylesheet" type="text/css" href="style.css">-->
	</head>
	<body id='first'>
    <aside style="width: 25%;
    padding-left: .5rem;
    margin-left: .5rem;
    float: right;
    box-shadow: inset 5px 0 5px -5px #29627e;
    color: #29627e;"> <?php include('viewRecettes.php'); ?>
    </aside>
    <section style="width:50%;
    float:left;
">Bienvenue <?php echo $data['prenom']; ?> !<br/>
        <a href="modif.php">Modifiez les informations de votre compte</a> <br/>
    </section>

    		<a href="deconnexion.php">Déconnexion</a>
 	</body>
</html>
