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
            
        }
    }

    public function add_new_annonce() {
            $titre = filter_var(htmlentities($_POST["titre"]));
            $description= filter_var(htmlentities($_POST["description"]));
            $prix_vente = filter_var(htmlentities($_POST["prix_vente"]));
           
            // on regarde si l'annonce existe
            $emailExists = $this->getAnnonceById($id_annonce);
            if ($emailExists) {
            return "Cette annonce existe déja. Veuillez saisir une autre annonce.";
            } else {
                $sql = "INSERT INTO ".$this->annonces."(titre, description, prix_vente) VALUES(:titre, :description, :prix_vente)";
                
                $req = $this->getDatabase()->prepare($sql);
                $req->execute(['titre'=> $titre, 'description'=> $description, 'prix_vente'=> $prix_vente]);
                $req->closeCursor();
    }

}
}