<?php
session_start();
require "vendor/autoload.php";

use App\Controllers\LicenceController;
use Config\Router;

$router = new Router();

/** j'utilise la méthode addRoute de mon controller pour ajouter des routes au controller
 *  cette méthode prend trois arguments : la route, le controller et la méthode exécutée
 */
// la page d'accueil
$router->addRoute('/', 'HomeController', 'index');
// La connexion/déconnexion et inscription:
$router->addRoute('/register', 'RegisterController', 'index');
$router->addRoute('/login', 'LoginController', 'index');
$router->addRoute('/logout', 'LogoutController', 'logout');
$router->addRoute('/404', 'ErrorController', 'notFound');
$router->addRoute('/profil', 'UserController', 'profil');
$router->addRoute('/licenceUser', 'UserController', 'mesLicences');



// Les licences:
$router->addRoute('/addLicence', 'LicenceController', 'addLicence');
$router->addRoute('/licence', 'LicenceController', 'readLicence');
$router->addRoute('/editLicence', 'LicenceController', 'editLicence');
$router->addRoute('/deleteLicence', 'LicenceController', 'deleteLicence');

// $router->addRoute('/deleteLicenceAndTodo', 'LicenceController', 'deleteLicenceAndTodo');
// $router->addRoute('/assignLicence', 'LicenceController', 'addKidLicence');
// $router->addRoute('/updateAssignLicence', 'LicenceController', 'updateTodoLicence');

$router->handleRequest();
