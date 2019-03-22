<?php
echo "<meta name='author' content='AROUSSI Amal and MAJDOUBI Imen'>";
include "functions/connect_bdd.php";

if (isset($_GET['comment'])) {


    @session_start();
    $id_commentaire = $_GET['comment'];
    $sql = "SELECT * FROM commentaires";
    $arr = array($id_commentaire);
    $req = $pdo->prepare($sql);
    $req->execute(array());
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    #print_r($result);
    foreach ($result as $r) {
        if ($r['id_commentaire'] == $id_commentaire) {
            $id_user = $r['id_user'];
            $id_recette = $r['id_recette'];
        }
    }
    if ($_SESSION['statut'] == "admin" or $_SESSION['id_user'] == $result[0]['id_user']) {

        if ($_SESSION['statut'] != "blocked") {
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                switch ($action) {
                    case "supprimer" :
                        $sql = "DELETE FROM commentaires WHERE id_commentaire=?";
                        $req = $pdo->prepare($sql);
                        $req->execute(array($_GET['comment']));
                        function remove_utf8_bom($text)
                        {
                            $bom = pack('H*', 'EFBBBF');
                            $text = preg_replace("/^$bom/", '', $text);
                            return $text;
                        }

                        $source_file = "contenuRecette.php";
                        $str = preg_replace('/\x{FEFF}/u', '', $source_file);
                        header("Location:contenuRecette.php?id=" . $id_recette);
                        exit();
                        break;
                        }

                }

            }
        }
}


