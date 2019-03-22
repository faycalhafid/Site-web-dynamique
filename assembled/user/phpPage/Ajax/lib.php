<?php
// connexion à la base de données
include ('test_connexion.php');
class CRUD
{
 
    protected $db;
 
    function __construct()
    {
        $this->db = connectbdd();
    }
 
    function __destruct()
    {
        $this->db = null;
    }
 
    /*
     * Add new Record
     *
     * @param $Auteur
     * @param $date
     * @param $commentaire
     * @return $mixed
     * */
    public function Create($Auteur,$commentaire, $recette)
    {    
        $now = date_create('now')->format('Y-m-d H:i:s');
        $query = $this->db->prepare("INSERT INTO commentaire(Commentaire,date,ID_recette, ID_user) VALUES (:commentaire,:date,:recette,:user)");
        $query->bindParam("commentaire", $commentaire, PDO::PARAM_STR);
        $query->bindParam("date", $now, PDO::PARAM_STR);
	$query->bindParam("recette", $recette, PDO::PARAM_STR);
	$query->bindParam("user", $Auteur, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
    }
 
    /*
     * Read all records
     *
     * @return $mixed
     * */
    public function Read($id_recette)
    {
        $query = $this->db->prepare("SELECT * FROM commentaire where ID_recette = :recette");
	$query->bindParam("recette", $id_recette, PDO::PARAM_STR);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
 
    /*
     * Delete Record
     *
     * @param $user_id
     * */
    public function Delete($user_id)
    {
        $query = $this->db->prepare("DELETE FROM commentaire WHERE ID = :id");
        $query->bindParam("id", $user_id, PDO::PARAM_STR);
        $query->execute();
    }
 
    /*
     * Update Record
     *
     * @param $first_name
     * @param $last_name
     * @param $email
     * @return $mixed
     * */
    public function Update($new_comment,$comment_id)
    {
        $now = date_create('now')->format('Y-m-d H:i:s');
        $query = $this->db->prepare("UPDATE commentaire SET Commentaire = :new_comment, date = :date  WHERE ID = :id");
        $query->bindParam("new_comment", $new_comment, PDO::PARAM_STR);
        $query->bindParam("date", $now, PDO::PARAM_STR);
        $query->bindParam("id", $comment_id, PDO::PARAM_STR);
        $query->execute();
    }
 
    /*
     * Get Details
     */
    public function Details($comment_id)
    {
        $query = $this->db->prepare("SELECT * FROM commentaire WHERE ID = :id");
        $query->bindParam("id", $comment_id, PDO::PARAM_STR);
        $query->execute();
        return json_encode($query->fetch(PDO::FETCH_ASSOC));
    }
}


?>





