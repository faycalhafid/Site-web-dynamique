<html>
<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>
    <h> Remplissez votre recette :</h><br/>Ingrédients<br/><br/>

    <form id="f" method="post" action=<?php echo "remplirEtape.php?id=".$_GET['id']."&num=".$_GET['num'];?>>
        Etape <?php echo $_GET['num']; ?> :<br/>
        <input type="text" name="etape"/><br/>
        <input type="submit" value="Confirmer"/>
    </form>
    <?php
        @session_start();
        include ('functions/connect_bdd.php');
        if($_POST){
            $id=$_GET['id'];
            $numetape=$_GET['num'];
            print_r($_POST);
            extract($_POST);
            //print_r(var_dump($_POST));
            $etapes=$_POST['etape'];
            $sql="INSERT INTO listeetapes(`id_recette`,`num_etape`,`etape`) VALUES (?,?,?)";
            $arr=array($id,$numetape,$etapes);
            include ('functions/pass_to_bdd.php');
            $numetape=$numetape+1;
            header('Location: remplirEtape.php?id='.$id.'&num='.$numetape);
        }
    ?>
    <a href=<?php echo 'contenuRecette.php?id='.$_GET['id']; ?>>Fin</a>
    <br/>
    <br/>
</html>
