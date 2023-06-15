<?php
session_start();
/***** REQUIRES/INCLUDES *****/
// Chargement du framework Medoo
include_once ("./librairies/medoo/Medoo.php");
// Chargement du framework de routage PHP Router
require_once __DIR__.'/librairies/phprouter/router.php';



/***** SETTINGS/CONSTANTES *****/
define("ROOT_DIR", "mvc-mahaut") ; // répertoire racine TODO à définir selon le nom de votre projet (dossier qui suit "localhost")
// On définit les différents modes d'accès aux données
define("PDO", 0) ; // connexion par PDO
define("MEDOO", 1) ; // Connexion par Medoo
// Choix du mode de connexion
define("DB_MANAGER", PDO); // TODO choisissez entre PDO ou MEDOO
// Création de deux constantes URL et FULL_URL qui pourront servir dans les controlleurs et/ou vues
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
define("FULL_URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]/{$_SERVER['REQUEST_URI']}"));


/******** HELPERS *********/
// inclusion des helpers contenant des fonctions utilisables dans toutes les vues
require_once "helpers/string_helper.php";

/******** CONTROLLERS *********/
// inclusion des controllers (ici je n'utilise qu'un seul controler pour les 4 routes)
require_once "controllers/AdminController.php";


/****** ROUTING *********/
// Réalisation du système de routage
// le fichier .htccess effectue une redirection automatique depuis l'url /nom_de_la_route vers index.php
// On utilise ensuite le micro-framework PHP Router pour gérer les routes


get('/admin', function(){
    $controller = new AdminController();
    $controller->usersdashboard();
});


get('/admin/user-add', function(){
    $controller = new AdminController();
    $controller->useradd();
});

post('/admin/user-add', function(){
    $controller = new AdminController();
    $controller->add_new_user();
});


get('/admin/del/$id', function($id){
    $controller = new AdminController();
    $controller->deleteuser($id);
});

get('/admin/categories'), function(){
    $controller=newAdminController();
    $controller=getCategories()
}
