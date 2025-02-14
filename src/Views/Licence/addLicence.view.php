<?php
// Démarrage de la session
session_start();

// Inclusion du fichier de connexion 
require_once(__DIR__ . '../config/database.php'); // Assurez-vous que ce fichier existe et contient la connexion PDO

// Inclusion du fichier head.php
require_once(__DIR__ . '/../partials/head.php');

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user']) || !isset($_SESSION['user']['idRole'])) {
    header("Location: /login");
    exit();
}

// Récupération du rôle de l'utilisateur
$userRole = (int)$_SESSION['user']['idRole'];

// Vérifie si l'utilisateur a le bon rôle
if ($userRole !== 2) {
    echo "<p class='text-danger text-center'>Vous n'avez pas l'autorisation d'accéder à cette page.</p>";
    exit();
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $availability = $_POST['availability'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;
    $arrayError = [];

    if (empty($title)) $arrayError['title'] = "Le titre est obligatoire.";
    if (empty($availability)) $arrayError['availability'] = "La disponibilité est obligatoire.";
    if (empty($price) || $price <= 0) $arrayError['price'] = "Le prix doit être un nombre positif.";

    // Gestion de l'upload de l'image
    $picturePath = null;
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../public/imgUploadUser/';
        $maxFileSize = 2 * 1024 * 1024;
        
        if ($_FILES['picture']['size'] > $maxFileSize) {
            $arrayError['picture'] = "Le fichier est trop volumineux (max 2 Mo).";
        } else {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['picture']['type'], $allowedTypes)) {
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                
                $fileExtension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
                $fileName = uniqid('img_', true) . '.' . $fileExtension;
                $uploadFile = $uploadDir . $fileName;
                
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
                    $picturePath = '/public/imgUploadUser/' . $fileName;
                } else {
                    $arrayError['picture'] = "Erreur lors de l'upload de l'image.";
                }
            } else {
                $arrayError['picture'] = "Type de fichier non autorisé.";
            }
        }
    }

    // Si aucune erreur, enregistrement en base de données
    if (empty($arrayError)) {
        $sql = "INSERT INTO licence (title, availability, description, picture, price) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $availability, $description, $picturePath, $price]);

        header("Location: /src/Licence/listLicence.php"); // Redirection correcte
        exit();
    }
}
?>
