<html>
<h> Remplissez votre recette :</h><br/>Ingrédients<br/><br/>

<form id="f" method="post" action=<?php echo "remplirEtape.php?id=".$_GET['id']."&num=".$_GET['num'];?>>
    Etape <?php echo $_GET['num']; ?> :<br/>
    <input type="text" name="etape"/><br/>
    <input type="submit" value="Confirmer"/>
</form>
<?php
$server="localhost";
$user="root";
$password='';
$bd="bddrecettes";
//connexion
try{
    $pdo=new PDO("mysql:host=$server;dbname=$bd",$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}
catch (PDOException $e){
    die("Error : ".$e->getMessage());
}
if($_POST){
    $id=$_GET['id'];
    $numetape=$_GET['num'];
    print_r($_POST);
    extract($_POST);
    print_r(var_dump($_POST));
    $etapes=$_POST['etape'];
    $sql="INSERT INTO listeetapes(`ID_recette`,`num_etape`,`etape`) VALUES (?,?,?)";
    $req=$pdo->prepare($sql);
    $req->execute(array($id,$numetape,$etapes));
    $numetape=$numetape+1;
    header('Location: remplirEtape.php?id='.$id.'&num='.$numetape);
}
?>
<a href=<?php echo 'contenuRecette.php?id='.$_GET['id']; ?>>Fin</a>

<br/><br/><a href="viewRecettes.php">Retour</a>
</html>
