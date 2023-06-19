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
            $sql = "SELECT * FROM $this->users WHERE email= :email";
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

    public function getUserByToken($token){
        try{
            $sql="SELECT * FROM membres WHERE token= :token";
            $req=$this->getDatabase()->prepare($sql);
            $req->execute(['token'=>$token]);
            if ($query->rowCount()){
                return $query->fetch();
            } 
            $req->closeCursor();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function getUserById($id_membre){
        try{
            $sql="SELECT * FROM membres WHERE id_membre= :id_membre";
            $req=$this->getDatabase()->prepare($sql);
            $req->execute(['id_membre'=>$id_membre]);
            if ($query->rowCount()){
                return $query->fetch();
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
                $req->execute(['username'=> $username, 'email'=> $email, 'password'=> $pwdhashed]);
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

    public function get_all_users() {
        return $this->users;
    }

    public function load_all_users() {
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

    public function getCategories(){
        $results=array();
        if (DB_MANAGER == PDO) {
            $req=$this->getDataBase()->prepare("SELECT * from categories");
            $req->execute();
            $categories=$req->fetchall(PDO::FETCH_ASSOC);
            $req->closeCursor();
            return $categories;

        }
    }

   public function logUser() {
        $email=filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        $user=getUserByEmail($email);
        if($user){
            if(password_verify($_POST['pwd'], $user['password'])){
                if($user['actif']){
                    $_SESSION['is_login']=true;// si il est connecté
                    $_SESSION['is_actif']=$user['actif'];// si il est actif
                    $_SESSION['id']=$user['id'];
                   return array("success", "Connexion réussie :)");               
                }else return array("error", "Veuillez activer votre compte");
            }else return array("error", "Mauvais identifiants");
        }else return array("error", "Mauvais identifiants");
    }

    public function activUser() {
        $token=htmlspecialschars($_GET['t']); // je me protège des injections.
        $user=getUserByToken($token); // je récupère l'utilisateur avec son token.
        if ($user) {
            if(!$user['actif']){
                try{
                    $req=$this->getDataBase()->prepare("UPDATE membres SET token = NULL, actif = 1 WHERE token= :token");
                    $req->execute(['token'=>$token]);
                    if ($req->rowCount()){// je verifie que ça a ete fait
                        return array("success", "Votre compte est activé, vous pouvez vous connecter"); 
                   }else return array("error", "Problème lors de l'activation"); 
           } catch (Exception $e) {
               return array("error",  $e->getMessage());
           }              
       }else return array("error", "Ce compte est déjà actif");
   }else return array("error", "Lien invalide !");

                }
     
    public function waitReset() {// en cas oubli de mot de passe
                    $email=filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
                    if(getUserByEmail($email)){// S'il existe dans la base de donnée
                        $token=bin2hex(random_bytes(16));// je crée un token
                        $perim=time()+1200;// avec une date de péremption (20 minutes)
                        try {
                            $req=$this->getDataBase()->prepare('UPDATE membres SET token = :token, perim = :perim WHERE email = :email');// J'update l'utilisateur avec le nvx token et la date de peremption
                            $req->execute(['email'=> $email, 'perim'=> $perim , 'token'=> $token]);// j'execute avec l'email le perim et le token
                            if ($req->rowCount()){
                                $content="<p><a href='authentification.test?p=reset&t=$token'>Merci de cliquer sur ce lien pour réinitialiser votre mot de passe</a></p>";// Je prépare le mail avec le token en paramètre d'url
                                // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                                $headers = array(
                                    'MIME-Version' => '1.0',
                                    'Content-type' => 'text/html; charset=iso-8859-1',
                                    'X-Mailer' => 'PHP/' . phpversion()
                                );
                                mail($email,"Réinitialisation de mot de passe", $content, $headers);
                                return array("success", "Vous allez recevoir un mail pour réinitialiser votre mot de passe".$content);
                            }else array("error", "Problème lors du process de réinitialisation");
                        } catch (Exception $e) {
                            return array("error",  $e->getMessage());
                        }
                    }else array("error", "Aucun compte ne correspond à cet email.");// S'il n'a pas réussi a trouver d'utilisateur avec cet email
                }           
    
     
     
    public function resetPwd() { $token=htmlspecialchars($_POST['token']);
                $user=getUserByToken($token);
                    if($user){
                        if (time()<$user['perim']){
                            if ($_POST['pwd']===$_POST['pwd2']){
                                if(preg_match("/^(?=.\d)(?=.[0-9])(?=.[a-z])(?=.[A-Z])(?=.*[\W]).{8,}$/", $_POST['pwd'])){                  $pwd=password_hash($_POST['pwd'], PASSWORD_DEFAULT);
                                    try {
                                        $req=$this->getDataBase()->prepare('UPDATE users SET token = NULL, password = :pwd, actif = 1 WHERE token= :token');
                                        $req->execute(['pwd'=> $pwd, 'token'=> $token]);
                                        if ($req->rowCount()){
                                            $content="<p>Votre mot de passe a été réinitialisé</p>";
                                            $headers = array(
                                                'MIME-Version' => '1.0',
                                                'Content-type' => 'text/html; charset=iso-8859-1',
                                                'X-Mailer' => 'PHP/' . phpversion()
                                            );
                                            mail($user['email'],"Réinitialisation de mot de passe", $content, $headers);
                                            return array("success", "Votre mot de passe a bien été réinitialisé");
                                        }else return array("error", "Problème lors de la réinitialisation");
                                    } catch (Exception $e) {
                                        return array("error",  $e->getMessage());
                                    } 
                                }else return array("error", "Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractère spécial");
                            }else return array("error", "Les 2 saisies de mot de passe doivent être identiques.");
                        }else return array("error", "Le lien n'est plus valide ! Veuillez <a href='?p=forgot'>recommencer</a>");
                    }else return array("error", "Les données ont été corrompues ! Veuillez <a href='?p=forgot'>recommencer</a>");
                }
           

}    
        


  
