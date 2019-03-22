<html lang="zxx" class="no-js">
<?php
echo "<meta name='author' content='HAFID Fayçal and MAKOUR Kaci Islam'>";
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

                </div>
            </div>
        </div>

        <?php
        if($_SESSION['statut']=="admin"){
            include "functions/connect_bdd.php";
            $id=$_GET['id'];
            $sql="SELECT nom,prenom FROM users WHERE id_user=?";
            $arr=array($id);
            include "functions/select_from_bdd.php";
            echo "<section style=\"margin-left:200px;
    color:#23272b;\">";
            echo "<h4>Recettes publiées par ".$result[0]['nom']." ".$result[0]['prenom']."</h4><br/>";
            include("recettes_user - Copie.php");
            echo "</section>";
        }
        else {
            header('Location : index.php');
        }


        ?>
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






