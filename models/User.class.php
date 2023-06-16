<?php
class User extends Model implements \JsonSerializable // le implements sert pour produire du JSON 
{
    private $id;
    private $username;
    private $email;
    private $password; 
    private $nom;
    private $prenom;
    private $dateNaissance;
    private $adressePostale;
    private $numTel;
    private $ville;
    private $codePostale;

    public function __construct($id, $username, $email, $password, $nom, $prenom, $dateNaissance, $adressePostale, $numTel, $ville, $codePostale)
    {
        $this->id = $id ;
        $this->username = $username ;
        $this->email = $email ;
        $this->password = $password ;
        $this->nom= $nom;
        $this->prenom= $prenom;
        $this->dateNaissance=$dateNaissance;
        $this->adressePostale=$adressePostale;
        $this->numTel=$numTel;
        $this->ville=$ville;
        $this->codePostal=$codePostal;
    }

    // cette méthode est pratique pour le JSON uniquement !!!
    public function jsonSerialize() : array
    {
        $vars = get_object_vars($this);
        return $vars;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->Username;
    }

    public function setUsername($username): void
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom) :void
    {
        $this->nom=$nom;
    }
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($prenom) :void
    {
        $this->prenom=$prenom;
    }
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }
    public function setDateNaissance($dateNaissance) : void
    {
        $this->dateNaissance=$dateNaissance;
    }
    public function getAdressePostale()
    {
        return $this->adressePostale;
    }
    public function setAdressePostale($adressePostale) : void
    {
        $this->adressePostale=$adressePostale;
    }
    public function getNumTel()
    {
        return $this->numTel;
    }
    public function setNumTel($numTel) :void
    {
        $this->numTel=$numTel;
    }
    public function getVille()
    {
        return $this->ville;
    }
    public function setVille($ville) :void
    {
        $this->ville=$ville;
    }
    public function getCodePostal()
    {
        return $this->codePostale;
    }
    public function setCodePostal()
    {
        $this->codePostal=$codePostal;
    }

}