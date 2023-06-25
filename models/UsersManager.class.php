<?php
require_once "Model.class.php";
require_once "User.class.php";

class UsersManager extends Model
{ 
    private $users;
    // Ajout d'un user au tableau
    public function addUser($user) 
    {
        $this->users[]=$user;
    }

    
    public function get_all_users() {
        return $this->users;
    }

    public function getUsers()
    {
        $results=array();
        if (DB_MANAGER == PDO) {
            $req=$this->getDataBase()->prepare("SELECT * from membres LIMIT 10");
            $req->execute();
            $categories=$req->fetchall(PDO::FETCH_ASSOC);
            $req->closeCursor();
            return $categories;

        }
    }


    public function getUserById($id_membre){
        $results= array();
        try{
            $sql="SELECT * FROM membres WHERE id_membre= ?";
            $req=$this->getDatabase()->prepare($sql);
            $req->execute([$id_membre]);
            if ($query->rowCount()){
                return $query->fetch();
            } 
            $req->closeCursor();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return false;

            // On ajoute chaque utilisateur au manager après les avoir récupérés
            foreach ($users as $user) {
                $new_user = new User(
                    $user['id_membre'],
                    $user['username'],
                    $user['email'],
                    $user['hash'],
                    $user['nom'],
                    $user['prenom'],
                    $user['date_naissance'],
                    $user['num_telephone'],
                    $user['addresse_postale'],
                    $user['code_postal'],
                    $user['ville'],
                    $user['token'],
                );
                return $new_user;
            }
    }

    public function load_all_users() {
        $results = array();
        if (DB_MANAGER == PDO) // version PDO
        {
            $req = $this->getDatabase()->prepare("SELECT * from  membres LIMIT 10");
            $req->execute();
            $users = $req->fetchAll(PDO::FETCH_ASSOC);
            $req->closeCursor();
           //return $users ;
        }
        foreach ($users as $user) {
            $new_user = new User(
                $user['id_membre'],
                $user['username'],
                $user['email'],
                $user['hash'],
                $user['nom'],
                $user['prenom'],
                $user['date_naissance'],
                $user['num_telephone'],
                $user['addresse_postale'],
                $user['code_postal'],
                $user['ville'],
                $user['token'],
                $user['solde_cagnotte'],
            );
            $this->addUser($new_user);
        }
    }

    public function editUser($user)
    {
        $type=null;
        $message=null;
            try{
                $req=$this->getDatabase()->prepare ('UPDATE membres SET username, email, nom, prenom, date_naissance, num_telephone, adresse_postale, code_postal, ville, solde_cagnotte');
                $req->execute([
                    'username'=>$user->getUsername(),
                    'email'=>$user->getEmail(),
                    'nom'=>$user->getNom(),
                    'prenom'=>$user->getPrenom(),
                    'date_naissance'=>$user->getDateNaissance(),
                    'num_telephone'=>$user->getNumTelephone(),
                    'adresse_postale'=>$user->getAdressePostale(),
                    'code_postal'=>$user->getCodePostal(),
                    'ville'=>$user->getVille(),
                    'solde_cagnotte'=>$user->getSoldeCagnotte()
                ]);
                if ($req->rowCount()) {
                    // Une ligne a été mise à jour => message de succès
                    $type = 'success';
                    $message = 'Catégorie mise à jour';
                } else {
                    // Aucune ligne n'a été mise à jour => message d'erreur
                    $type = 'error';
                    $message = 'Catégorie non mise à jour';
                }
            } catch (Exception $e) {
                // Une exception a été lancée, récupération du message de l'exception
                $type = 'error';
                $message = 'Catégorie non mise à jour: ' . $e->getMessage();
            }
        
            $_SESSION['message'] = ['type' => $type, 'message' => $message];
    }

    private function getUserByEmail($email) {
        try {
            $sql = "SELECT * FROM $this->users WHERE email= ?";
            $req = $this->getDatabase()->prepare($sql);
            $req->execute([$email]);
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

    

    public function add_new_user($user) {
        $email = filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if (!$user->getUserByEmail($email)) {
            if ($_POST['password'] === $_POST['password2']) {
                if (preg_match("/^(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$/", $_POST['password'])) {
                    $token = bin2hex(random_bytes(16));
                    try {
                        $req = $this->getDatabase()->prepare('INSERT INTO membres (username, password, email, nom, prenom, num_telephone, date_naissance, addresse_postale, code_postal, ville, token) VALUES (:username, :password, :email, :nom, :prenom, :num_telephone, :date_naissance, :addresse_postale, :code_postal, :ville, :token)');
                        $req->execute([
                            'username' => $user->getUsername(),
                            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
                            'email' => $user->getEmail(),
                            'nom' => $user->getNom(),
                            'prenom' => $user->getPrenom(),
                            'num_telephone' => $user->getNumTelephone(),
                            'date_naissance' => $user->getDateNaissance(),
                            'addresse_postale' => $user->getAddressePostale(),
                            'code_postal' => $user->getCodePostal(),
                            'ville' => $user->getVille(),
                            'token' => $token

                        ]);

                        if ($req->rowCount()) {
                            $url = URL;
                            $content = "<p><a href='$url/validation/$token'>Merci de cliquer sur ce lien pour activer votre compte</a></p>";

                            // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                            $headers = array(
                                'MIME-Version' => '1.0',
                                'Content-type' => 'text/html; charset=iso-8859-1',
                                'X-Mailer' => 'PHP/' . phpversion()
                            );
                            mail($user->getEmail(), "Veuillez activer votre compte", $content, $headers);
                            $type = 'success';
                            $message = 'Inscription réussie. Vous allez recevoir un mail pour activer votre compte';
                            $_SESSION['message'] = ['type' => $type, 'message' => $message];
                            header("Location: " . URL . "index"); //redirection vers l'accueil en cas d'inscription réussie
                            exit();
                        } else {
                            $type = 'error';
                            $message = 'Problème lors de l\'enregistrement';
                        }
                    } catch (Exception $e) {
                        $type = 'error';
                        $message = 'Utilisateur non ajouté: ' . $e->getMessage();
                    }
                } else {
                    $type = 'error';
                    $message = 'Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractère spécial';
                }
            } else {
                $type = 'error';
                $message = 'Les deux mots de passe doivent être identiques';
            }
        } else {
            $type = 'error';
            $message = 'Un compte existe déjà pour cet email';
        }

        $_SESSION['message'] = ['type' => $type, 'message' => $message];
        header("Location: " . URL . "user_form"); //redirection vers le formulaire en cas d'erreur dans l'inscription
    }



    public function deleteUser($id_membre)
    {


        try {
            $req = $this->getDatabase()->prepare('DELETE FROM membres WHERE id_membre = :id_membre');
            $req->execute(['id_membre' => $user]);
            if ($req->rowCount()) {
                // Une ligne a été mise à jour => message de succès
                $type = 'success';
                $message = 'Utilisateur supprimé';
            } else {
                // Aucune ligne n'a été mise à jour => message d'erreur
                $type = 'error';
                $message = 'Utilisateur non supprimé';
            }
        } catch (Exception $e) {
            // Une exception a été lancée, récupération du message de l'exception
            $type = 'error';
            $message = 'Utilisateur non supprimé';
        }

        $_SESSION['message'] = ['type' => $type, 'message' => $message];
        header("Location: " . URL . "users");
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

    public function newCategorie($categorie)
  
    {
        $type=null;
        $message=null;
        try {
            $req=$this->getDatabase()->prepare('INSERT INTO categories (nom_categorie, description) VALUES (:nom_categorie, :description');
            $req->execute([
                'nom_categorie'=>$categorie->getNomCategorie(),
                'description'=>$categorie->getDescription()
            ]);
            if ($req->rowCount()) {
                // Une ligne a été mise à jour => message de succès
                $type = 'success';
                $message = 'Catégorie ajoutée';
            } else {
                // Aucune ligne n'a été mise à jour => message d'erreur
                $type = 'error';
                $message = 'Catégorie non ajoutée';
            }
        } catch (Exception $e) {
            // Une exception a été lancée, récupération du message de l'exception
            $type = 'error';
            $message = 'Catégorie non ajoutée: ' . $e->getMessage();
        }
        }

    public function addCategorie()
    {
        $this->categories[]=$categorie;
    }
    


    public function signUp(){
        $email = filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if (!$user>getUserByEmail($email)) {
            if ($_POST['password'] === $_POST['password2']) {
                if (preg_match("/^(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$/", $_POST['password'])) {
                    $token = bin2hex(random_bytes(16));
                    try {
                        $req = $this->getDatabase()->prepare('INSERT INTO membres (username, password, email, nom, prenom, num_telephone, date_naissance, addresse_postale, code_postal, ville, token) VALUES (:username, :password, :email, :nom, :prenom, :num_telephone, :date_naissance, :addresse_postale, :code_postal, :ville, :token)');
                        $req->execute([
                            'username' => $user->getUsername(),
                            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
                            'email' => $user->getEmail(),
                            'nom' => $user->getNom(),
                            'prenom' => $user->getPrenom(),
                            'num_telephone' => $user->getNumTelephone(),
                            'date_naissance' => $user->getDateNaissance(),
                            'addresse_postale' => $user->getAddressePostale(),
                            'code_postal' => $user->getCodePostal(),
                            'ville' => $user->getVille(),
                            'token' => $token
    
                        ]);
    
                        if ($req->rowCount()) {
                            $url = URL;
                            $content = "<p><a href='$url/validation/$token'>Merci de cliquer sur ce lien pour activer votre compte</a></p>";
    
                            // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                            $headers = array(
                                'MIME-Version' => '1.0',
                                'Content-type' => 'text/html; charset=iso-8859-1',
                                'X-Mailer' => 'PHP/' . phpversion()
                            );
                            mail($user->getEmail(), "Veuillez activer votre compte", $content, $headers);
                            $type = 'success';
                            $message = 'Inscription réussie. Vous allez recevoir un mail pour activer votre compte';
                            $_SESSION['message'] = ['type' => $type, 'message' => $message];
                            header("Location: " . URL . "index"); //redirection vers l'accueil en cas d'inscription réussie
                            exit();
                        } else {
                            $type = 'error';
                            $message = 'Problème lors de l\'enregistrement';
                        }
                    } catch (Exception $e) {
                        $type = 'error';
                        $message = 'Utilisateur non ajouté: ' . $e->getMessage();
                    }
                } else {
                    $type = 'error';
                    $message = 'Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractère spécial';
                }
            } else {
                $type = 'error';
                $message = 'Les deux mots de passe doivent être identiques';
            }
        } else {
            $type = 'error';
            $message = 'Un compte existe déjà pour cet email';
        }
    
        $_SESSION['message'] = ['type' => $type, 'message' => $message];
        header("Location: " . URL . "user_form"); //redirection vers le formulaire en cas d'erreur dans l'inscription
    }

   public function logUser() {
    $email = filter_var(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
    $user = new User(null, null, null, $email, null, null, null, null, null, null, null, null);
    $userInfos = $user->getUserByEmail($email);

    if ($userInfos) {
        if (password_verify($_POST['password'], $userInfos['password'])) {
            if ($userInfos['actif']) {
                $_SESSION['is_login']=true;
                $_SESSION['is_actif']=$userInfos['actif'];
                $_SESSION['isAdmin']=$userInfos['isAdmin'];
                $_SESSION['id']=$userInfos['id'];
                $_SESSION['username']=$userInfos['username'];
                $_SESSION['password']=$userInfos['password'];
                $_SESSION['email']=$userInfos['email'];
                $_SESSION['nom']=$userInfos['lastname'];
                $_SESSION['prenom']=$userInfos['firstname'];
                $_SESSION['num_telephone']=$userInfos['phone'];
                $_SESSION['date_naissance']=$userInfos['birthDate'];
                $_SESSION['addresse_postale']=$userInfos['address'];
                $_SESSION['code_postal']=$userInfos['postalCode'];
                $_SESSION['ville']=$userInfos['city'];
                $_SESSION['token']=$userInfos['token'];

                $type = 'success';
                $message = 'Connexion réussie';
            } else {
            $type = 'error';
            $message = 'Veuillez activer votre compte';
            }
        } else {
        $type = 'error';
        $message = 'Mot de passe incorrect';}
    } else {
    $type = 'error';
    $message = 'Cette adresse email n\'est liée à aucun compte existant';
}
$_SESSION['message'] = ['type' => $type, 'message' => $message];
header("Location: " . URL . "index");
}

function activUser($token) {

    if (DB_MANAGER == PDO) {
    
    $user = new User(null, null, null, null, null, null, null, null, null, null, null, $token);
    $userInfos = $user->getUserByToken($token);

    if($user){
        if(!$userInfos['actif']){
            try {
                $req = $this->getDatabase()->prepare('UPDATE users SET token = NULL, actif = 1 WHERE token= :token');
                
                    $req->execute(['token'=> $token]);
                    if ($req->rowCount()){
                         //return array("success", "Votre compte est activé, vous pouvez vous connecter"); 
                         $type = 'success';
                         $message = 'Votre compte a bien été activé, vous pouvez dès maintenant vous connecter en utilisant vos identifiants';

                    }else {
                    //return array("error", "Problème lors de l'activation"); 
                    $type = 'error';
                    $message = 'Problème lors de l\'activation';
                }
            } catch (Exception $e) {
                //return array("error",  $e->getMessage());
                $type = 'error';
                $message = 'Problème lors de l\'activation';
            }              
        }else {
        //return array("error", "Ce compte est déjà actif");
        $type = 'error';
        $message = 'Ce compte est déjà actif';
        }
    }else {
    //return array("error", "Lien invalide !");
    $type = 'error';
    $message = 'Lien invalide !';}
    
}
$_SESSION['message'] = ['type' => $type, 'message' => $message];
header("Location: " . URL . "index");
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
                            if ($_POST['password']===$_POST['password2']){
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
        


  
