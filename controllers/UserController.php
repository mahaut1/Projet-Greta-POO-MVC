<?php

// Signup 
if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(!empty($_POST["action"])){

        if($_POST["action"]== "signup"){
            if(!empty($_POST["prenom"])){
                if(!empty($_POST["nom"])){
                    if(!empty($_POST["username"])){
                        if(!empty($_POST["dateNaissance"])){
                            if(!empty($_POST["email"])){
                                if(!empty($_POST["password"])){
                                    if(!empty($_POST["adressePostale"])){
                                        if(!empty($_POST["numTel"])){
                                            if(!empty($_POST["ville"])){
                                                if(!empty($_POST["codePostal"])){
                                                    $user = new UserManager();
                                                    $message = $user->register();
                                                    if($message[0]== "success"){
                                                        header('Location:?p=signupNotication');
                                                    }else{}
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

//Login
    if($_POST["action"]== "login"){
        if(!empty($_POST["email"])){
            if(!empty($_POST["password"])){
                $user = new UserManager();
                $notification = $user->login();
                if($notification[0]== "success"){
                    header('Location:?p=logged'); 
                }else{}
            }
        }
    }


//WaitReset
    if($_POST["action"]== "waitReset"){
        if(!empty($_POST["email"])){
            $user = new UserManager();
            $notification = $user->waitReset();
            if($notification[0]== "success"){
                header('Location:?p=resetPass'); 
            }else{}
        }
    }
}
}


