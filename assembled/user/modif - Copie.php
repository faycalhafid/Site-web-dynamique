<html>
<head>
	<!--<link rel="stylesheet" type="text/css" href="style.css">-->
<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>
</head>
<body id='first'>
<aside style="width: 40%;
    padding-left: .5rem;
    margin-left: .5rem;
    float: right;
    box-shadow: inset 5px 0 5px -5px #29627e;
    color: #29627e;"> <?php include('viewRecettes.php'); ?>
</aside>
<!--
<form name="Ajouter" action="modif.php" method="post">
<P>Modifier ses informations:</P>
<p>Nouveau nom:<input type="text" name="nouveau_nom" size="20" "<?php if (isset($_POST['nouveau_nom'])) echo $_POST['nouveau_nom']; ?>"><br /></p>
<p>Nouveau prenom:<input type="text" name="nouveau_prenom" size="20" "<?php if (isset($_POST['nouveau_prenom'])) echo $_POST['nouveau_prenom']; ?>"><br /></p>
<p>Nouveau email:<input type="text" name="nouveau_email" size="20" "<?php if (isset($_POST['nouveau_email'])) echo $_POST['nouveau_email']; ?>"><br /></p>
<p>Nouveau password:<input type="text" name="nouveau_password" size="20" "<?php if (isset($_POST['nouveau_password'])) echo $_POST['nouveau_password']; ?>"><br /></p>
<input type="submit" value="Modification" name="Modification">
</form>-->
<p> Les informations de votre compte : </p><br/>

</body>
</html>
<?php
@session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])){
	$email=$_SESSION['email'];
	$password=$_SESSION['password'];
	$id_user=$_SESSION['id_user'];
}
include ('../../fonct2/functions/connect_bdd.php');
$sql="SELECT * FROM users WHERE id_user=?";
$arr=array($id_user);
include ('../../fonct2/functions/select_from_bdd.php');
echo "\n<br/><br/>\n";
$r=$result[0];
    if (isset($_SESSION['failed_mail'])){
        if ($_SESSION['failed_mail']==1){
            echo " Erreur, le nouveau mail que vous avez rentré est déjà existant.<br/> ";
            $_SESSION['failed_mail']=0;
        }
    }
    echo "<table>
            <tr><th>Adresse mail : </th><td>".$r['email']."</td><td><a href=\"modifierInfo.php?obj=mail\">Modifier</a></td></tr>
            <tr><th>Nom :  </th><td>".$r['nom']."  </td><td><a href=\"modifierInfo.php?obj=nom\">Modifier</a></td></tr>
            <tr><th>Prenom : </th><td>".$r['prenom']."  </td><td><a href=\"modifierInfo.php?obj=prenom\">Modifier</a></td></tr>
            <tr><td><a href=\"modifierInfo.php?obj=mdp\">Changer le mot de passe </a><td/><tr/>
          </table>";


echo "<br/><br/><a id='buttons' href=\"deconnexion.php\">Déconnexion</a>";
?>

<?php
if (isset($erreur)) echo '<br />',$erreur;
?>
