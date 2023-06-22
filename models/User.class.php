<?php
class User extends Model implements \JsonSerializable // le implements sert pour produire du JSON 
{
    private $id;
    private $username;
    private $email;
    private $password; 
    private $nom;
    private $prenom;
    private $date_naissance;
    private $adresse_postale;
    private $num_telephone;
    private $ville;
    private $codePostale;

    public function __construct($id, $username, $email, $password, $nom, $prenom, $date_naissance, $adresse_postale, $num_telephone, $ville, $code_postal)
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
        return $this->date_naissance;
    }
    public function setDateNaissance($date_naissance) : void
    {
        $this->dateNaissance=$date_naissance;
    }
    public function getAdressePostale()
    {
        return $this->adresse_postale;
    }
    public function setAdressePostale($adresse_postale) : void
    {
        $this->adresse_postale=$adresse_postale;
    }
    public function getNumTelephone()
    {
        return $this->num_telephone;
    }
    public function setNumTelephone($num_telephone) :void
    {
        $this->num_telephone=$num_telephone;
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
        return $this->code_postale;
    }
    public function setCodePostal()
    {
        $this->code_postal=$codePostal;
    }

}