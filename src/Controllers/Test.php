<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Licence;
use App\Models\User;

class UserController extends AbstractController
{
    // Affiche la liste des utilisateurs
    public function profil()
    {
      
        
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $user = User::findByEmail($_SESSION['user']['email']);

        if (!$user) {
            die("Utilisateur non trouvé !");
        }

        $viewPath = realpath(__DIR__ . "/../Views/User/profile.view.php");
        if (!$viewPath || !file_exists($viewPath)) {
            die("Erreur : fichier introuvable à l'emplacement attendu - " . __DIR__ . "/../Views/User/profile.view.php");
        }
        require_once $viewPath;
        
    }
}
