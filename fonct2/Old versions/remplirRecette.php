<html>
<h> Remplissez votre recette :</h><br/>Ingrédients<br/><br/>

<form id="f" method="post" action=<?php echo "remplirRecette.php?id=".$_GET['id']?>>
    Number of ingredients :<input type="text" name="nbIng" onkeyup="BuildFormFields(parseInt(this.value, 10));">
    <div id ="FormField" style="margin: 20px 0px;"></div>
    <input type="submit" name="submit" value="Suivant"/>
</form>

<br/><br/><a href="viewRecettes.php">Retour</a>
</html>
<script type="text/javascript">
    function BuildFormFields($amount)
    {
        var
            $container = document.getElementById('FormField'),
            $item, $field, $i;
        $container.innerHTML = '';
        for ($i = 0; $i < $amount; $i++) {
            $item = document.createElement('div');
            $item.style.margin = '3px';
            $field = document.createElement('input');
            $field.name = 'ingredient'+$i;
            $field.type = 'text';
            $field.value ='ingredient';
            $item.appendChild($field);
            $field = document.createElement('input');
            $field.name='qte'+$i;
            $field.type='number';
            $field.value='0';
            $item.appendChild($field);
            $field = document.createElement('input');
            $field.name = 'unit'+$i;
            $field.type = 'text';
            $item.appendChild($field);
            $container.appendChild($item);
        }
    }
</script>
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
    $nbIng=$_POST['nbIng'];
    $id=$_GET['id'];
    for ($i=0;$i<$nbIng;$i++){
        $ingredient=$_POST['ingredient'.$i];
        $qte=$_POST['qte'.$i];
        $unit=$_POST['unit'.$i];
        $sql="INSERT INTO listeingredients(`ID_recette`,`ingredient`,`qte`,`unit`) VALUES (?,?,?,?)";
        $req=$pdo->prepare($sql);
        $req->execute(array($id,$ingredient,$qte,$unit));
    }
    header('Location: remplirEtape.php?id='.$id.'&num=1');
}
?>