<?php
class User extends Model implements \JsonSerializable // le implements sert pour produire du JSON 
{
    private $id;
    private $username;
    private $email;
    private$password; 

    public function __construct($id, $username, $email, $password)
    {
        $this->id = $id ;
        $this->username = $username ;
        $this->email = $email ;
        $this->password = $password ;
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
}