<html>
<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>
<aside style="width: 25%;
    padding-left: .5rem;
    margin-left: .5rem;
    float: right;
    box-shadow: inset 5px 0 5px -5px #29627e;
    color: #29627e;"> <?php include('viewRecettes.php'); ?>
</aside>
<section style="margin-left:200px;
    color:#23272b;
">
    <h> Remplissez votre recette :</h><br/>Ingrédients<br/><br/>

    <form id="f" method="post" action=<?php echo "create_ingredients.php?id=".$_GET['id']?>>
        Number of ingredients :<input type="text" name="nbIng" onkeyup="BuildFormFields(parseInt(this.value, 10));">
        <div id ="FormField" style="margin: 20px 0px;"></div>
        <input type="submit" name="submit" value="Suivant"/>
    </form>
    <!-- l'utilisateur peut revenir à la liste des recettes -->
</section>
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
            $field.style = 'width:120px;';
            $item.appendChild($field);
            $field = document.createElement('input');
            $field.name='qte'+$i;
            $field.type='number';
            $field.value='0';
            $field.style = 'width:80px;';
            $item.appendChild($field);
            $field = document.createElement('input');
            $field.name = 'unit'+$i;
            $field.type = 'text';
            $field.style= 'width:80px;';
            $item.appendChild($field);
            $container.appendChild($item);
        }
    }
</script>
