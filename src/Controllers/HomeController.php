<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Licence;

class HomeController extends AbstractController
{
    public function index()
    {
        $licences = [];

        if (isset($_SESSION['user'])) {
            // Récupération de l'utilisateur connecté
            $userId = $_SESSION['user']['id'];

            // Instanciation de la classe Licence pour récupérer les données
            $pdo = \Config\DataBase::getConnection();
            $sql = "SELECT * FROM `licence` WHERE id_user=?";
            $statement = $pdo->prepare($sql);
            $statement->execute([$userId]);

            while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
                // On utilise le constructeur existant pour mapper chaque licence
                $licences[] = new Licence(
                    $row['id'],
                    $row['title'],
                    $row['description'],
                    $row['price'],
                    $row['availability'],
                    $row['picture'],
                    $row['id_user']
                );
            }
        }

        require_once(__DIR__ . '/../Views/home.view.php');
    }
}
