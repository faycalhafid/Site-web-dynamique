<?php
include('functions/connect_bdd.php');
echo "<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>";
if($_POST){
    @session_start();
    $nbIng=$_POST['nbIng'];
    $id=$_GET['id'];
    for ($i=0;$i<$nbIng;$i++) {
        $ingredient = $_POST['ingredient' . $i];
        $qte = $_POST['qte' . $i];
        $unit = $_POST['unit' . $i];
        $sql = "INSERT INTO listeingredients(`id_recette`,`ingredient`,`qte`,`unit`) VALUES (?,?,?,?)";
        $arr = array($id, $ingredient, $qte, $unit);
        include('functions/pass_to_bdd.php');
    }
    // redirection vers la page remplir etape
    header('Location: remplirEtape.php?id='.$id.'&num=1');
}
?>