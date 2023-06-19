<?php
require_once "Model.class.php";
require_once "Annonce.class.php";

class AnnoncesManager extends Model
{
    private $annonces;

    public function addAnnonce($annonce) {
        $this->annonces[]=$annonce;
    }

    private function getAnnonceById($id_annonce) {
        try {
            $sql = "SELECT * FROM $this->annonces WHERE id_annonce= :id_annonce";
            $req = $this->getDatabase()->prepare($sql);
            $req->execute(['id_annonce'=>$id_annonce]);
            if($req->rowCount()){
                return $req->fetchall(PDO::FETCH_ASSOC);;
            }
            $req->closeCursor();
        } catch (Exception $e) {
            echo $e->getMessage();
        } 
        return false;
    }
    
    public function get_all_annonces()
    { 
        if (DB_MANAGER == PDO) {
            $req=$this->getDataBase()->prepare("SELECT * from annonces");
            $req->execute();
            $categories=$req->fetchall(PDO::FETCH_ASSOC);
            $req->closeCursor();
            return $categories;   
        }
    }

    

}