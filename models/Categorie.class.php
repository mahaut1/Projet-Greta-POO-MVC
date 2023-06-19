<?php
class Categorie extends Model
{
    private $nom_categorie;
    private $description;

    public function __construct($nom_categorie,$description)
    {
        $this->nom_categorie=$nom_categorie;
        $this->description=$description;
    }

    public function getNomCategorie()
    {
        return $this->nom_categorie;
    }

    public function setNomCategorie($nom_categorie): void
    {
        $this->nom_categorie=$nom_categorie;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description=$description;
    }
}