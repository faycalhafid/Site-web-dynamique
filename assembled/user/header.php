<?php
//echo "<meta name='author' content='AROUSSI Amal and MAJDOUBI Imen'>";
echo "<header id=\"header\" id=\"home\">
    <div class=\"container\">
        <div class=\"row align-items-center justify-content-between d-flex\">
            <div id=\"logo\">
                <a href=\"index.html\"><img src=\"img/logo.png\" alt=\"\" title=\"\" /></a>
            </div>
            <nav id=\"nav-menu-container\">
                <ul class=\"nav-menu\">
                    <li class=\"menu-active\"><a href=\"index.php\">Home</a></li>";
                    @session_start();
                    if ($_SESSION){
                        if ($_SESSION['statut']!="visiteur")
                        {
                            if($_SESSION['id_user']==1){
                                echo "
                            <li><a href=\"admin2.php\">Liste des utilisateurs</a></li>
                            <li><a href=\"modif.php\">Mon compte</a></li>
                            <li><a href=\"deconnexion.php\">Deconnexion</a></li>";
                            }
                            else {
                                echo "
                    <li><a href=\"modif.php\">Mon compte</a></li>
                    <li><a href=\"deconnexion.php\">Deconnexion</a></li>";
                            }

                        }
                        else {
                            echo "
                       <li><a href=\"index2.php\">Connexion</a></li>
                       <li><a href=\"user_inscription.php\">Inscription</a></li>";
                        }
                        }
                    else {
                        echo "
                       <li><a href=\"index2.php\">Connexion</a></li>
                       <li><a href=\"user_inscription.php\">Inscription</a></li>";
                    }

                    echo "
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </div>
</header><!-- #header -->";
?>
