

    <?php
    echo "<meta name='author' content='BOUCHAIRA Katrennada and MAACHOU Marouane'>";
//tuer la session en cours, et rediriger le visiteur vers le formulaire de connexion à l'espace membre
    session_start();
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
    ?>
