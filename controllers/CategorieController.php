<?php

class CategorieController
{
    private $categorieManager;

    public function __construct()
    {
        $this->categorieManager= new CategoriesManager();
    }

    public function categoriedashboard()
    {
        $categories=$this->categorieManager->getCategories();
        require_once "views/admin/categoriesadmin.php";
    }

    public function addNewCategorie()
    {
        $new_categorie=$this->categorieManager->addCategorie($nom_categorie);
        require_once "views/admin/categorie-add.php";
    }

    public function categorieAdd()
    {
        require_once "views/admin/categorie-add.php";
    }
}