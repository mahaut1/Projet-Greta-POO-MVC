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
define("PDO", 1) ; // connexion par PDO
define("MEDOO", 0) ; // Connexion par Medoo
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
// inclusion des controllers 
require_once "controllers/AdminController.php";
require_once "controllers/WelcomeController.php";

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

get('/admin/categories', function(){
    $controller=new AdminController();
    $controller->getCategories();
});

get('/', function(){
    $controller=new WelcomeController();
    $controller->home();
});

get('/login', function(){
    $controller=new WelcomeController();
    $controller->login();
});

get('/signup', function(){
    $controller=new WelcomeController();
    $controller->signup();
});

get('/membres', function(){
    $controller=new WelcomeController();
    $controller->membres();
});

get('/new-annonce', function(){
    $controller=new WelcomeController();
    $controller->new_annonce();
});

get('/products', function(){
    $controller=new WelcomeController();
    $controller->products();
});
get('/categories',function(){
    $controller=new WelcomeController();
    $controller->categories();
}
);
get('/contact', function(){
    $controller=new WelcomeController();
    $controller->contact();
}
);
get('/annonce', function(){
    $controller= new AnnonceController;
}

);