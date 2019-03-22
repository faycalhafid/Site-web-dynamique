<html lang="zxx" class="no-js">
<?php
echo "<meta name='author' content='BOOUCHAIRA Katrennada and MAACHOU Marouane'>";
include("head.php");
echo "<body>\n";
include ("header.php");
//<!-- start banner Area -->
include("banner.php");
//<!-- End banner Area -->
?>

<!-- Start recettes -->

<section class="related-area section-gap">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-60 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Rejoignez nous !</h1>

                </div>
            </div>
        </div>
        <div id="content" name="content">
            <form id='form' name="Ajouter" action="index2 - Copie.php" method="post">
                <P>Connexion à l'espace membre:</P>

                <form id='form' action="index2 - Copie.php" method="post">
                    <table>
                        <tr><th>Email :</th> <td><input type="text" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></td></tr>
                        <tr><th>Password :</th> <td><input type="password" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>"></td></tr>
                        <tr><td></td><td><input type="submit" name="connexion" value="connexion"></td></tr>
                    </table>
                </form>
                <a id='buttons' href="user_inscription.php">Vous inscrire</a>

            </form>
        </div>

    </div>

</section>
<!-- End related Area -->







<script src="js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
<script src="js/easing.min.js"></script>
<script src="js/hoverIntent.js"></script>
<script src="js/superfish.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/parallax.min.js"></script>
<script src="js/mail-script.js"></script>
<script src="js/main.js"></script>
<!-- Jquery JS file -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>


<!-- Custom JS file -->
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>






