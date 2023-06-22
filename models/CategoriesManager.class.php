<?php
require_once "Model.class.php";
require_once "Categorie.Class.php";

class CategorieManager extends Model
{
    private $categories;

    public function addCategorie($nomCategorie)
    {
        $this->categories[]=$categorie;
    }
    
    // retourne un tableau
    public function getAllCategories()
    {
        return $this->categories;
    }

    public function getCategories()
    {
        $results=array();
        if (DB_MANAGER == PDO) {
            $req=$this->getDataBase()->prepare("SELECT * from categories LIMIT 10");
            $req->execute();
            $categories=$req->fetchall(PDO::FETCH_ASSOC);
            $req->closeCursor();
            return $categories;

        }
    }

    public function getCategorieById($id_categorie)
    {
        $result= array();
        
            $req=$this->getDatabase()->prepare("SELECT * FROM categories WHERE id_categorie= ? LIMIT 10");
            $req->execute([$id_categorie]);
            $categories=$req->fetchAll(PDO::FETCH_ASSOC);
            $req->closeCursor();

        foreach ($categories as $categorie){
            $new_categorie= new Categorie(
                $categorie['id_categorie'],
                $categorie['nom_categorie'],
                $categorie['description'],
            );
            return $new_categorie;
        }
    }

    public function loadAllCategories()
    {
        $req= $this->getDatabase()->prepare("SELECT * FROM categories LIMIT 10");
        $req->execute();
        $categories= $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        // On ajoute les catégories récupérées a leur manager
        foreach ($categories as $categorie){
            $new_categorie=new Categorie(
                $categorie['id_categorie'],
                $categorie['nom_categorie'],
                $categorie['description']
            );
            $this->addCategorie($new_categorie);
        }
    }

    public function editCategorie($categorie)
    {
        $type=null;
        $message=null;
            try{
                $req=$this->getDatabase()->prepare('UPDATE categories SET nom_categorie = :nom_categorie, description = :description WHERE id_categorie= :id_categorie');
                $req->execute([
                    'id_categorie'=>$categorie->getIdCategorie(),
                    'nom_categorie'=>$categorie->getNomCategorie(),
                    'description'=>$categorie->getDescription()
                ]);
                if ($req->rowCount()) {
                    // Une ligne a été mise à jour => message de succès
                    $type = 'success';
                    $message = 'Catégorie mise à jour';
                } else {
                    // Aucune ligne n'a été mise à jour => message d'erreur
                    $type = 'error';
                    $message = 'Catégorie non mise à jour';
                }
            } catch (Exception $e) {
                // Une exception a été lancée, récupération du message de l'exception
                $type = 'error';
                $message = 'Catégorie non mise à jour: ' . $e->getMessage();
            }
        
        $_SESSION['message'] = ['type' => $type, 'message' => $message];
        header("Location: " . URL . "categories");
    }
           
    
    public function newCategorie($categorie)
    $type=null;
    $message=null;
    {
        try {
            $req=$this->getDatabase()->prepare('INSERT INTO categories (nom_categorie, description) VALUES (:nom_categorie, :description');
            $req->execute([
                'nom_categorie'=>$categorie->getNomCategorie(),
                'description'=>$categorie->getDescription()
            ]);
            if ($req->rowCount()) {
                // Une ligne a été mise à jour => message de succès
                $type = 'success';
                $message = 'Catégorie ajoutée';
            } else {
                // Aucune ligne n'a été mise à jour => message d'erreur
                $type = 'error';
                $message = 'Catégorie non ajoutée';
            }
        } catch (Exception $e) {
            // Une exception a été lancée, récupération du message de l'exception
            $type = 'error';
            $message = 'Catégorie non ajoutée: ' . $e->getMessage();
        }
        }
   
    
    public function deleteCategorie($id_categorie)
    {
        $type=null;
        $message=null;
        
        try {
            $req = $this->getDatabase()->prepare('DELETE FROM categories WHERE id = :id LIMIT 10');
            $req->execute(['id_categorie' => $categorie]);
            if ($req->rowCount()) {
                // Une ligne a été mise à jour => message de succès
                $type = 'success';
                $message = 'Catégorie supprimée';
            } else {
                // Aucune ligne n'a été mise à jour => message d'erreur
                $type = 'error';
                $message = 'Catégorie non supprimée';
            }
        } catch (Exception $e) {
            // Une exception a été lancée, récupération du message de l'exception
            $type = 'error';
            $message = 'Catégorie non supprimée: ' . $e->getMessage();
        
    }
    $_SESSION['message'] = ['type' => $type, 'message' => $message];
    header("Location: " . URL . "categories");
}
 } 
