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
            //on met l'id de la tache dans une variable
            $idLicence = $_GET['id'];
            //on instancie une nouvelle tache avec l'id de la tache
            $licence = new Licence($idLicence, null, null, null, null, null, null, null, null, null, null);
            //on appelle la méthode pour aller chercher la tache dans la BDD on met le resulat dans la variable
            $myLicence = $licence->getLicenceById();

            //Si la tache n'existe pas dans la base de donnée alors on redirige vers /home
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
        if (isset($_SESSION['user']) && $_SESSION['user']['idRole'] == 2) {

            if (isset($_POST['title'])) {
                $this->check('title', $_POST['title']);
                $this->check('availability', $_POST['availability']);
                $this->check('picture', $_POST['picture']);
                $this->check('price', $_POST['price']);

                if (empty($this->arrayError)) {
                    $title = htmlspecialchars($_POST['title']);
                    $availability = htmlspecialchars($_POST['availability']);
                    $picture = htmlspecialchars($_POST['picture']);
                    $price = htmlspecialchars($_POST['price']);
                    $description = htmlspecialchars($_POST['description']);
                    $creation_date = date('Y-m-d H:i:s');
                    $id_user = $_SESSION['user']['idUser'];

                    $licence = new Licence($title, $description, $creation_date, $availability, $picture, $price, $id_user,);

                    $licence->addLicence();
                    $this->redirectToRoute('/');
                }
            }

            require_once(__DIR__ . '/../Views/licence/createLicence.view.php');
        } else {
            $this->redirectToRoute('/');
        }
    }

    public function editLicence()
    {
        if ($_GET['id']) {
            //on met l'id de la tache dans une variable
            $idLicence = $_GET['id'];
            //on instancie une nouvelle tache avec l'id de la tache
            $licence = new Licence($idLicence, null, null, null, null, null, null, null, null, null, null);
            //on appelle la méthode pour aller chercher la tache dans la BDD on met le resulat dans la variable
            $Licence = $licence->getLicenceById();


            //Si la tache n'existe pas dans la base de donnée alors on redirige vers /home
            if (!$licence) {
                $this->redirectToRoute('/');
            }

            if (isset($_POST['title'])) {
                $this->check('title', $_POST['title']);
                $this->check('availability', $_POST['availability']);
                $this->check('picture', $_POST['picture']);
                $this->check('price', $_POST['price']);

                if (empty($this->arrayError)) {
                    $title = htmlspecialchars($_POST['title']);
                    $availability = htmlspecialchars($_POST['availability']);
                    $picture = htmlspecialchars($_POST['picture']);
                    $price = htmlspecialchars($_POST['price']);
                    $description = htmlspecialchars($_POST['description']);

                    $licence = new Licence($idLicence, $title, $description, null, $availability, $picture, $price, null, null, null, null);

                    $licence->updateLicence();
                    $this->redirectToRoute('/');
                }
            }

            require_once(__DIR__ . '/../Views/licence/editLicence.view.php');
        } else {
            $this->redirectToRoute('/');
        }
    }

    public function deleteLicence()
    {
        if (isset($_POST['id'])) {
            $idLicence = htmlspecialchars($_POST['id']);
            $licence = new Licence($idLicence, null, null, null, null, null, null, null, null, null, null);
            $licence->deleteLicence();
            $this->redirectToRoute('/');
        }
    }


    public function addClientLicence()
    {
        if ($_GET['id']) {
            //on met l'id de la tache dans une variable
            $idLicence = $_GET['id'];
            //on instancie une nouvelle tache avec l'id de la tache
            $licence = new Licence($idLicence, null, null, null, null, null, null, null, null, null, null);
            //on appelle la méthode pour aller chercher la tache dans la BDD on met le resulat dans la variable
            $myLicence = $licence->getLicenceById();

            $user = new User(null, null, null, null, null, null,null);
            $myClients = $user->getClients();

            if (!$myLicence) {
                $this->redirectToRoute('/');
            }

            if (isset($_POST['client'])) {
                $idClient = htmlspecialchars($_POST['client']);
                $status = htmlspecialchars($_POST['status']);

                $this->checkFormat('client', $idClient);
                $this->checkFormat('status', $status);

                if (empty($this->arrayError)) {
                    $licence = new Licence($idLicence, null, null, null, null, null, null, null, $status, null, $idClient);
                    $licence->addLicence();
                    $this->redirectToRoute('/');
                }
            }

            require_once(__DIR__ . "/../Views/licence/addClientLicence.view.php");
        } else {
            $this->redirectToRoute('/');
        }
    }

    public function updateTodoLicence()
    {
        if ($_GET['id']) {
            //on met l'id de la tache dans une variable
            $idLicence = $_GET['id'];
            //on instancie une nouvelle tache avec l'id de la tache
            $licence = new Licence($idLicence, null, null, null, null, null, null, null, null, null, null);
            //on appelle la méthode pour aller chercher la tache dans la BDD on met le resulat dans la variable
            $myLicence = $licence->getLicenceById();

            $user = new User(null, null, null, null, null, null,null);
            $myClients = $user->getClients();

            if (!$myLicence) {
                $this->redirectToRoute('/');
            }

            if (isset($_POST['client'])) {
                $idClient = htmlspecialchars($_POST['client']);
                $status = htmlspecialchars($_POST['avalability']);

                $this->checkFormat('client', $idClient);
                $this->checkFormat('availability', $availability);

                if (empty($this->arrayError)) {
                    $licence = new Licence($idLicence, null, null, null, null,  $availability, null, $idClient);
                    $licence->updateLicence();
                    $this->redirectToRoute('/');
                }
            }

            require_once(__DIR__ . "/../Views/licence/addClientLicence.view.php");
        } else {
            $this->redirectToRoute('/');
        }
    }
}
