<?php
require_once "Model.class.php";
require_once "Annonce.class.php";

class AnnoncesManager extends Model
{
    private $annonces;

    public function addAnnonce($annonce) 
    {
        $this->annonces[]=$annonce;
    }

    public function getAllAnnonces()
    {
        return $this->annonces;
    }

    public function getAnnonces()
    { 
        $result=array();
        if (DB_MANAGER == PDO) {
            $req=$this->getDataBase()->prepare("SELECT * from annonces LIMIT 10");
            $req->execute();
            $categories=$req->fetchall(PDO::FETCH_ASSOC);
            $req->closeCursor();
            
        }
    }

    private function getAnnonceById($id_annonce)
    {
        $result=array();
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

    public function loadAllAnnonces()
    {
        $req=$this->getDatabase()->prepare("SELECT * FROM annonces LIMIT 10");
        $req->execute();
        $annonces=$req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        //On ajoute les annonces récupérées à leur manager
        foreach ($annonces as $annonce){
            $newAnnonce=new Annonce(
                $annonce['titre'],
                $annonce['description'],
                $annonce['prix_vente']
            );
            $this->addAnnonce($newAnnonce);
        }
    }

    public function editAnnonce($id_annonce)
    {
        $type=null;
        $message=null;

            try{
                $req=$this->getDatabase()->prepare('UPDATE annonces SET titre= :titre, description= :description, prix_vente= :prix_vente WHERE id_annonce= :id_annonce');
                $req->execute([
                    'id_annonce'=>$annonce->getIdAnnonce(),
                    'titre'=>$annonce->getTitre(),
                    'prix_vente'=>$annonce->getPrixVente()
                ]);
                if ($req->rowCount()) {
                    // Une ligne a été mise à jour => message de succès
                    $type = 'success';
                    $message = 'Annonce mise à jour';
                } else {
                    // Aucune ligne n'a été mise à jour => message d'erreur
                    $type = 'error';
                    $message = 'Annonce non mise à jour';
                }
            } catch (Exception $e) {
                // Une exception a été lancée, récupération du message de l'exception
                $type = 'error';
                $message = 'Annonce non mise à jour: ' . $e->getMessage();
            }
        
        $_SESSION['message'] = ['type' => $type, 'message' => $message];
           
    }
   
   

    public function newAnnonce($annonce)
    {
        try {
            $req=$this->getDatabase()->prepare('INSERT INTO annonces (titre, description, prix_vente) VALUES (:titre, :description, :prix_vente');
            $req->execute([
                'titre'=>$annonce->getTitre(),
                'description'=>$annonce->getDescription(),
                'prix_vente'=>$annonce->getPrixVente()
            ]);
            if ($req->rowCount()) {
                // Une ligne a été mise à jour => message de succès
                $type = 'success';
                $message = 'Annonce ajoutée';
            } else {
                // Aucune ligne n'a été mise à jour => message d'erreur
                $type = 'error';
                $message = 'Anonce non ajoutée';
            }
        } catch (Exception $e) {
            // Une exception a été lancée, récupération du message de l'exception
            $type = 'error';
            $message = 'Annonce non ajoutée: ' . $e->getMessage();
        }
    }      

        

    
    public function delete_annonce($id_annonce)
    {
        if(!isAdmin()){
            $sql= " AND id_membre = ".$_SESSION['idmembre'];
        } else {
            $sql = '';
        }
        try {
           
            $req = $this->getDatabase()->prepare('DELETE FROM annonces WHERE id_annonce = :id_annonce'.$sql);
            $req->execute(['id_annonce' => $id_annonce]);
            if ($req->rowCount()) {
                // Une ligne a été mise à jour => message de succès
                $type = 'success';
                $message = 'Annonce supprimé';
            } else {
                // Aucune ligne n'a été mise à jour => message d'erreur
                $type = 'error';
                $message = 'Annonce non supprimé';
            }
        } catch (Exception $e) {
            // Une exception a été lancée, récupération du message de l'exception
            $type = 'error';
            $message = 'Annonce non supprimé';
        }

        $_SESSION['message'] = ['type' => $type, 'message' => $message];
        header("Location: " . URL . "users");
    }
}