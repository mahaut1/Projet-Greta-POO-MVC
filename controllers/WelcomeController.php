<?php


class WelcomeController
{
   public function home()
   {
    require_once "views/frontoffice/home.php";
   }

   public function login()
   {
     require_once "views/frontoffice/login.php";
   }

   public function signup()
   {
    require_once "views/frontoffice/signup.php";
   }
   
  
}
