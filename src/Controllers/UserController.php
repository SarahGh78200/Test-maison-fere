<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Licence;
use App\Models\User;

class UserController extends AbstractController
{
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

        require_once __DIR__ . "/../Views/User/profile.view.php";
    }

    public function mesLicences()
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user']) || !$_SESSION['user']['idRole']) {
            header('Location: /login'); // Rediriger vers la page de connexion
            exit();
        }

        // Récupérer l'utilisateur connecté
        $user = User::findByEmail($_SESSION['user']['email']);
        if (!$user) {
            die("Utilisateur non trouvé !");
        }

        // Récupérer les licences de l'utilisateur
        $licences = $user->getLicences();

        // Charger la vue
        require_once __DIR__ . "/../Views/User/licenceUser.views.php";
    }
    
}
