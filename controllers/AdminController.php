<?php

require_once "models/UsersManager.class.php";


class AdminController
{
    private $userManager;


    // Constructeur de ma classe
    public function __construct()
    {
        $this->userManager = new UsersManager();
        
    }

   
    public function usersdashboard()
    {
        $membres = $this->userManager->get_all_members() ;
        require_once "views/admin/admin.php" ;
    
    }
   
    public function useradd()
    {
        require_once "views/admin/user-add.php" ;

    }


    public function deleteuser($id)
    {
        require_once "views/admin/dele-members.php"
    
    }

    public function add_new_user($id)
    {
        // récupérer les infos dans le post et créer l'utilisateur
    
    }

}
