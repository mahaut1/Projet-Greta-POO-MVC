<?php
class Annonce extends Model
{
    private $titre;
    private $description;
    private $prixVente;

    public function_construct($titre,$description,$prixVente)
    {
        $this->titre=$titre;
        $this->description=$description;
        $this->prixVente=$prixVente;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre): void
    {
        $this->titre=$titre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description=$description;
    }

    public function getPrixVente()
    {
        return $this->prixVente;
    }
    
    public function setPrixVente($prixVente)
    {
        $this->prixVente=$prixVente;
    }
}