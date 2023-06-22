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

    public function addCategorie()
    {
        $newcategorie=$this->categorieManager->newCategorie($categorie);
    }
}