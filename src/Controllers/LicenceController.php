<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Licence;
use App\Models\User;

class LicenceController extends AbstractController
{
    public function index()
    {
        if( isset($_GET['id'])) {
            $idLicence = $_GET['id'];
            $licence = new Licence($idLicence, null, null, null, null, null, null, null, null, null, null);
            $myLicence = $licence->getLicenceById();

            if (!$licence) {
                $this->redirectToRoute('/');
            }
            $idUser = $myLicence->getIdUser();
            $user = new User($idUser, null, null, null, null, null,null);
            require_once(__DIR__ . "/../Views/licence/licence.view.php");
        } else {
            $this->redirectToRoute('/');
        }
    }


    public function addLicence()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['idRole']) {
            if (isset($_POST['title'])) {
                // Récupération et sécurisation des données
                $title = htmlspecialchars($_POST['title']);
                $availability = htmlspecialchars($_POST['availability']);
                $price = htmlspecialchars($_POST['price']);
                $description = htmlspecialchars($_POST['description']);
                $picture = $_FILES['picture'] ?? null;
                $creation_date = date('Y-m-d H:i:s');
                $id_user = $_SESSION['user']['idUser'];
    
                // Vérification des formats
                $this->checkFormat('title', $title);
                $this->checkFormat('availability', $availability);
                $this->checkFormat('price', $price);
                $this->checkFormat('description', $description);
                $this->checkFormat('picture', $picture);
    
                if (empty($this->arrayError)) {
                    // Instanciation de l'objet Licence
                    $licence = new Licence(null, $title, $description, $creation_date, $availability, $picture, $price, $id_user);
                    $licence->addLicence();
    
                    // Redirection après l'ajout
                    $this->redirectToRoute('/');
                }
            }
    
            // Inclusion de la vue pour afficher le formulaire
            require_once(__DIR__ . '/../Views/Licence/addLicence.view.php');
        } else {
            $this->redirectToRoute('/');
        }
    }
    
}
