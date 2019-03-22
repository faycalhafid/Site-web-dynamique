<html>
<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>";
<aside style="width: 25%;
    padding-left: .5rem;
    margin-left: .5rem;
    float: right;
    box-shadow: inset 5px 0 5px -5px #29627e;
    color: #29627e;"> <?php include('viewRecettes.php'); ?>

</aside>

<section style="margin-left:200px;
    color:#23272b;
"><h style="color:#23272b"> Création d'une recette !</h>
    <br/>
    <br/>
    <form method="post" action="create.php">
        <li/>Titre :<br/> <input type="text" name="titre" placeholder="Titre de la recette"/><br/>
        <li/>Catégorie de la recette : <br/>
        <input type="radio" name="categorie" value="entree"/>  Entrée<br/>
        <input type="radio" name="categorie" value="plat"/>  Plat<br/>
        <input type="radio" name="categorie" value="dessert"/>  Dessert<br/><br/>
        <input type="submit" name="submit" value="Créer"><br/>
    </form>
</section>
</html>

