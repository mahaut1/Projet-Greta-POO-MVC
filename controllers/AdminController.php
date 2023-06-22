<?php

require_once "models/Model.class.php";
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
        $users = $this->userManager->get_all_users() ;
        require_once "views/admin/admin.php" ;
    
    }
   
    public function useradd()
    {
        require_once "views/admin/user-add.php" ;

    }


    public function deleteuser($id)
    {
        require_once "views/admin/dele-members.php";
    
    }

    public function add_new_user()
    {
        $user=$this->userManager->add_new_user($user);
        require_once "views/admin/user-add.php";
    
    }

    public function categories()
    {
        $categories=$this->userManager->getCategories();
        require_once "views/admin/categoriesadmin.php";
    }
    
    public function annonces()
    {
        $annonces=$this->annoncesManager->get_all_annonces();
        require_once "views/admin/productsadmin.php";
    }

    

}
