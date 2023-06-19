<?php


class WelcomeController
{
   public function home()
   {
    require_once "views/frontoffice/templates/header.php";
    require_once "views/frontoffice/home.php";
    require_once "views/frontoffice/templates/footer.php";
   }

   public function login()
   {
    require_once "views/frontoffice/templates/header.php";
     require_once "views/frontoffice/login.php";
     require_once "views/frontoffice/templates/footer.php";
   }

   public function signup()
   {
    require_once "views/frontoffice/templates/header.php";
    require_once "views/frontoffice/signup.php";
    require_once "views/frontoffice/templates/footer.php";
   }
   
     public function membres()
   {
    require_once "views/frontoffice/templates/header.php";
    require_once "views/frontoffice/espace-membre.php";
    require_once "views/frontoffice/templates/footer.php";
   }

    public function new_annonce()
   {
    require_once "views/frontoffice/templates/header.php";
    require_once "views/frontoffice/FormulaireCreaAnnonce.php";
    require_once "views/frontoffice/templates/footer.php";
   }

      public function products()
   {
    // A CODER
    //$annonces_manager = new AnnoncesManager() ;
    //$annonces = $annonces_manager->getAllAnnonces();
    require_once "views/frontoffice/templates/header.php";
    require_once "views/frontoffice/products.php";
    require_once "views/frontoffice/templates/footer.php";
   }

   public function categories()
   {
      require_once "views/frontoffice/templates/header.php";
      require_once "views/frontoffice/categories.php";
      require_once "views/frontoffice/templates/footer.php";
   }

   public function contact()
   {
      require_once "views/frontoffice/templates/header.php";
      require_once "views/frontoffice/contact.php";
      require_once "views/frontoffice/templates/footer.php";
   }
}
