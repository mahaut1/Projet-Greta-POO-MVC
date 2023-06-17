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
    private function getUserByEmail($email) {
        try {
            $sql = "SELECT * FROM $this->user WHERE email= :email";
            $req = $this->getDatabase()->prepare($sql);
            $req->execute(['email'=>$email]);
            if($req->rowCount()){
                return $req->fetch();
            }
            $req->closeCursor();
        } catch (Exception $e) {
            echo $e->getMessage();
        } 
        return false;
    }

    

    public function add_new_user() {
        $username = filter_var(htmlentities(ucfirst(strtolower($_POST["username"]))));
            $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
            $password = filter_var(htmlentities($_POST["password"]));
            $pwdhashed = password_hash($password, PASSWORD_DEFAULT);     

            // See if Email exists
            $emailExists = $this->getUserByEmail($email);
            if ($emailExists) {
            return "L'email existe déjà. Veuillez choisir une autre adresse e-mail.";
            } else {
                $sql = "INSERT INTO ".$this->users."(username, email, hash) VALUES(:username, :email, :password)";
                
                $req = $this->getDatabase()->prepare($sql);
                $req->execute(['username'=> $userName, 'Email'=> $email, 'password'=> $pwdhashed]);
                $req->closeCursor();
    }
}
public function signUp(){
    $username = filter_var(htmlentities(ucfirst(strtolower($_POST["username"]))));
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $password = filter_var(htmlentities($_POST["password"]));
    $pwdhashed = password_hash($password, PASSWORD_DEFAULT);
    $nom = filter_var(htmlentities(ucfirst(strtolower($_POST["nom"]))));
    $prenom = filter_var(htmlentities(ucfirst(strtolower($_POST["prenom"]))));
    $dateNaissance = filter_var(htmlentities($_POST["dateNaissance"])); 
    $numTel = htmlentities($_POST["numTel"]);
    $adressePostale = filter_var(htmlentities($_POST["adressePostale"]));
    $codePostale = filter_var($_POST["codePostale"]);
    $ville = filter_var(htmlentities(strtolower(ucfirst($_POST["ville"]))));
    $token = bin2hex(random_bytes(20));
   

    // on regarde si l'email existe
    $emailExists = $this->getUserByEmail($email);

    if ($emailExists){
        return array("error", "L'email existe déjà. Veuillez choisir une autre adresse e-mail.");
    } else {
        $sql = "INSERT INTO ".$this->userTable."(username, email, hash, nom, prenom, date_naissance, num_telephone, adresse_postale, code_postal, ville, token) VALUES(:username, :email, :pwdhashed, :nom, :prenom, :dateNaissance, :numTel, :adressePostale, :codePostaLe, :ville, :token)";
        
        $req = $this->getDatabase()->prepare($sql);
        $req->execute(['Username'=> $userName, 'Email'=> $email, 'hash'=> $pwdhashed, 'Nom'=> $nom, 'prenom'=> $prenom, 'dateNaissance'=>$dateNaissance, 'numTel'=>$numTel,'adressePostale'=>$adressePostale,'codePostaLe'=>$codePostale,'ville'=>$ville,'token'=>$token]);
        $req->closeCursor();

        if ($req->rowCount()){
            $to = $email;
            $subject = "Veuillez activer votre compte";
            $content="<p><a href='authentification.test?p=activation&t=$token'>Merci de cliquer sur ce lien pour activer votre compte</a></p>";
            $headers = array(
                'From'=> 'mwindal@hotmail.com',
                'MIME-Version' => '1.0',
                'Content-type' => 'text/html; charset=iso-8859-1',
                'X-Mailer' => 'PHP/' . phpversion()
            );
            mail($to,$subject, $content, $headers);
        }else array("error", "Problème lors de enregistrement");
        return array("success", "Inscription réussie");
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
           //return $users ;
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
