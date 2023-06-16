<?php
require_once "Model.class.php";
require_once "User.class.php";

class UsersManager extends Model
{ 
    private $users;
    // Ajout d'un user au tableau
    public function addUser($user) {
        $this->users[]=$user;
    }

    public function add_new_user() {
        $userName = filter_var(htmlentities(ucfirst(strtolower($_POST["username"]))));
            $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
            $password = filter_var(htmlentities($_POST["password"]));
            $pwdhashed = password_hash($password, PASSWORD_DEFAULT);     

            // See if Email exists
            $emailExists = $this->checkEmailExists($email);
            if ($emailExists) {
            return "L'email existe déjà. Veuillez choisir une autre adresse e-mail.";
            } else {
                $sql = "INSERT INTO ".$this->users."(username, email, hash) VALUES(:username, :Email, :password)";
                
                $req = $this->getDatabase()->prepare($sql);
                $req->execute(['username'=> $userName, 'Email'=> $email, 'password'=> $pwdhashed]);
                $req->closeCursor();
    }
}

    public function get_all_members() {
        return $this->users;
    }

    public function load_all_members() {
       // $results = array();
        if (DB_MANAGER == PDO) // version PDO
        {
            $req = $this->getDatabase()->prepare("SELECT * from  membres");
            $req->execute();
            $users = $req->fetchAll(PDO::FETCH_ASSOC);
            $req->closeCursor();
           // return $users ;
        }
        foreach ($users as $user) {
            $new_user= new User (
                $user['id'],
                $user['username'],
                $user['email'],
                $user['password']
            );
            $this->addUser($new_user);
        }
    }


    public function deleteuser($id_membre){
        if (DB_MANAGER == PDO) {
            $req=$this->getDataBase()->prepare("DELETE * from membres where id_membre=:id_membre");
            $req->execute();
            $req->closeCursor();
        
        }
    }

    public function get_all_categories(){
        $results=array();
        if (DB_MANAGER == PDO) {
            $req=$this->getDataBase()->prepare("SELECT * from categories");
            $req->execute();
            $categories=$req->fetchall(PDO::FETCH_ASSOC);
            $req->closeCursor();
            return $categories;

        }
    }

    
}
