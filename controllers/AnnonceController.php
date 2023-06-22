<?php

require_once "models/AnnoncesManager.class.php";

class AnnonceController
{
    private $annonceManager;

    // Constructeur de la classe

    public function __construct()
    {
        $this->annonceManager= new AnnoncesManager();
    }

    //affiche toute les annonces
    public function annoncesdashboard()
    {
        $annonces=$this->annonceManager->get_all_annonces();
        require_once "views/admin/products.php";
    }

    // rajouter une annonce
    public function annonceadd()
    {
        require_once "views/admin/annonce-add.php";
    }

    //rajouter 
    public function add_new_annonce()
    {
        $annonce=$this->annonceManager->add_new_annonce();
        require_once "views/admin/annonce-add.php";
    }

    public function deleteAnnonce()
    {
        
    }
}