<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Licence;
use App\Models\User;

class LicenceController extends AbstractController
{
    public function index()
    {
        if ($_GET['id']) {
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

    public function createLicence()
    {
        $this->addLicence();
    }

    public function addLicence()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['idRole']) {
            if (isset($_POST['title'])) {
                $this->check('title', $_POST['title']);
                $this->check('availability', $_POST['availability']);
                $this->check('picture', $_FILES['picture'] ?? null);

                if (empty($this->arrayError)) {
                    $title = htmlspecialchars($_POST['title']);
                    $availability = htmlspecialchars($_POST['availability']);
                    $picture = htmlspecialchars($_POST['picture']);
                    $price = htmlspecialchars($_POST['price']);
                    $description = htmlspecialchars($_POST['description']);
                    $creation_date = date('Y-m-d H:i:s');
                    $id_user = $_SESSION['user']['idUser'];

                    $licence = new Licence($title, $description, $creation_date, $availability, $picture, $price, $id_user);
                    $licence->addLicence();
                    $this->redirectToRoute('/');
                }
            }
            require_once(__DIR__ . '/../Views/Licence/addLicence.view.php');
        } else {
            $this->redirectToRoute('/');
        }
    }
}
