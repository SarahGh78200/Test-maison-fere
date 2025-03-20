<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Licence;
use App\Models\User;

class LicenceController extends AbstractController
{
    public function index()
    {
        if (isset($_GET['id'])) {
            $idLicence = htmlspecialchars($_GET['id']);
            $licence = new Licence($idLicence, null, null, null, null, null, null);
            $myLicence = $licence->getLicenceById();

            if (!$myLicence) {
                $this->redirectToRoute('/');
            }

            $idUser = $myLicence->getIdUser();
            $user = new User($idUser, null, null, null, null, null, null);

            require_once(__DIR__ . "/../Views/licence/licence.view.php");
        } else {
            $this->redirectToRoute('/');
        }
    }

    public function addLicence()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']['idRole']) {
            $this->redirectToRoute('/');
        }
    
        $errors = [];
        $title = '';
        $availability = '';
        $description = '';
        $price = '';
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars(trim($_POST['title'] ?? ''));
            $availability = isset($_POST['availability']) && $_POST['availability'] === 'disponible' ? 1 : 0;
            $description = htmlspecialchars(trim($_POST['description'] ?? ''));
            $price = htmlspecialchars(trim($_POST['price'] ?? ''));
            $picture = $_FILES['picture'] ?? null;
            $id_user = $_SESSION['user']['idUser'];
    
            // Validation des champs
            if (empty($title) || strlen($title) < 4 || strlen($title) > 100) {
                $errors['title'] = "Le titre doit avoir entre 4 et 100 caractères.";
            }
            if (!in_array($availability, [0, 1], true)) {
                $errors['availability'] = "Disponibilité invalide.";
            }
            if (empty($description) || strlen($description) < 4 || strlen($description) > 500) {
                $errors['description'] = "La description doit avoir entre 4 et 500 caractères.";
            }
            if (!is_numeric($price) || $price < 2) {
                $errors['price'] = "Le prix doit être un nombre supérieur ou égal à 2.";
            }
    
            // Validation du fichier image
            if (empty($picture['name'])) {
                $errors['picture'] = "L'image est obligatoire.";
            } else {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $maxFileSize = 2 * 1024 * 1024; // 2 Mo
    
                if (!in_array($picture['type'], $allowedTypes)) {
                    $errors['picture'] = "Le fichier doit être une image (JPEG, PNG ou GIF).";
                } elseif ($picture['size'] > $maxFileSize) {
                    $errors['picture'] = "Le fichier ne doit pas dépasser 2 Mo.";
                } else {
                    $uploadDir = __DIR__ . '/../../public/imgUpload/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
    
                    // Générer un nom de fichier unique
                    $pictureName = uniqid() . '_' . basename($picture['name']);
                    $uploadFile = $uploadDir . $pictureName;
    
                    // Déplacer le fichier téléversé
                    if (move_uploaded_file($picture['tmp_name'], $uploadFile)) {
                        $picture = $pictureName; // Stocker le nom du fichier
                    } else {
                        $errors['picture'] = "Erreur lors du téléversement de l'image.";
                    }
                }
            }
    
            // Si aucune erreur, ajouter la licence
            if (empty($errors)) {
                $licence = new Licence(null, $title, $description, $availability, $picture, $price, $id_user);
                if ($licence->addLicence()) {
                    $_SESSION['successMessage'] = "Licence ajoutée avec succès !";
                    $this->redirectToRoute('/licence');
                } else {
                    $errors['database'] = "Une erreur est survenue lors de l'ajout de la licence.";
                }
            }
        }
    
        require_once(__DIR__ . '/../Views/Licence/addLicence.view.php');
    }

    public function readLicence()
    {
        $licences = Licence::readLicence();
        $isLoggedIn = isset($_SESSION['user']);

        require_once(__DIR__ . '/../Views/licence/licence.view.php');
    }

    public function deleteLicence()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']['idRole']) {
            echo "<script>var permissionMessage = 'Vous n\'avez pas les permissions pour supprimer cette licence.';</script>";
            return;
        }

        if (isset($_POST['id'])) {
            $idLicence = htmlspecialchars($_POST['id']);
            $licence = new Licence($idLicence, null, null, null, null, null, null);
            $licence->deleteLicence();
            $_SESSION['successMessage'] = "Licence supprimée avec succès.";
            $this->redirectToRoute('/licence');
        }
    }
      

    public function showLicence()
{
    if (!isset($_GET['id'])) {
        $this->redirectToRoute('/licence');
        return;
    }

    $idLicence = htmlspecialchars($_GET['id']);
    $licence = new Licence($idLicence, null, null, null, null, null, null);
    $myLicence = $licence->getLicenceById();

    if (!$myLicence) {
        $_SESSION['errorMessage'] = "Licence introuvable.";
        $this->redirectToRoute('/licence');
        return;
    }

    require_once(__DIR__ . "/../Views/licence/detailLicence.view.php");
}
public function viewLicenceDetail()
{
    if (isset($_GET['id'])) {
        $idLicence = htmlspecialchars($_GET['id']);
        $licence = new Licence($idLicence, null, null, null, null, null, null);
        $myLicence = $licence->getLicenceById();

        if (!$myLicence) {
            $this->redirectToRoute('/404');  // Page 404 si licence non trouvée
        }

        // Récupérer l'utilisateur associé à la licence
        $idUser = $myLicence->getIdUser();
        $user = new User($idUser, null, null, null, null, null, null);

        require_once(__DIR__ . "/../Views/licence/licenceDetail.view.php");
    } else {
        $this->redirectToRoute('/404');  // Si l'ID n'est pas présent, redirection vers 404
    }
}

}
