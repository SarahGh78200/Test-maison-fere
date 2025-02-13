<?php
// Démarrage de la session
session_start();

// Inclusion du fichier head.php
require_once(__DIR__ . '/../partials/head.php');

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user']) || !isset($_SESSION['user']['idRole'])) {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: /login");
    exit();
}

// Récupération du rôle de l'utilisateur
$userRole = (int)$_SESSION['user']['idRole'];

// Vérifie si l'utilisateur a le bon rôle (ajuste en fonction de ton projet)
if ($userRole !== 2) { // Exemple : 2 = rôle autorisé
    echo "<p class='text-danger text-center'>Vous n'avez pas l'autorisation d'accéder à cette page.</p>";
    exit();
}

// Traitement du formulaire après soumission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $title = $_POST['title'] ?? '';
    $availability = $_POST['availability'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;

    // Validation des données (exemple simple)
    $arrayError = [];
    if (empty($title)) {
        $arrayError['title'] = "Le titre est obligatoire.";
    }
    if (empty($availability)) {
        $arrayError['availability'] = "La disponibilité est obligatoire.";
    }
    if (empty($price) || $price <= 0) {
        $arrayError['price'] = "Le prix doit être un nombre positif.";
    }

    // Gestion de l'upload de l'image
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../public/imgUploadUser/'; // Répertoire de stockage des images
        $maxFileSize = 2 * 1024 * 1024; // 2 Mo

        // Vérification de la taille du fichier
        if ($_FILES['picture']['size'] > $maxFileSize) {
            $arrayError['picture'] = "Le fichier est trop volumineux (max 2 Mo).";
        } else {
            // Vérification du type de fichier (exemple : seulement des images)
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['picture']['type'], $allowedTypes)) {
                // Crée le dossier imgUploadUser si nécessaire
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Renommer le fichier pour éviter les conflits
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
    } else {
        $arrayError['picture'] = "Aucune image n'a été téléchargée.";
    }

    // Si aucune erreur, enregistrement des données (exemple : en base de données)
    if (empty($arrayError)) {
        // Exemple : insertion en base de données
        // $sql = "INSERT INTO licences (title, availability, description, picture, price) VALUES (?, ?, ?, ?, ?)";
        // $stmt = $pdo->prepare($sql);
        // $stmt->execute([$title, $availability, $description, $picturePath, $price]);

        // Redirection vers une page de succès ou affichage d'un message
        header("src/Licence/addLicence.views.php"); // Redirection vers la liste des licences
        exit();
    }
}
?>

<h1>Ajouter une licence</h1>
<?php if (!empty($arrayError)) { ?>
    <div class="alert alert-danger">
        <p>Le formulaire contient des erreurs. Veuillez les corriger avant de soumettre à nouveau.</p>
    </div>
<?php } ?>
<form method="POST" enctype="multipart/form-data">
    <div class="col-md-4 mx-auto d-block mt-5">
        <div class="mb-3">
            <label for="title" class="form-label">Titre de la licence</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($title ?? '') ?>" required>
            <?php if (isset($arrayError['title'])) { ?>
                <p class="text-danger"><?= htmlspecialchars($arrayError['title']) ?></p>
            <?php } ?>
        </div>

        <div class="mb-3">
            <label for="availability" class="form-label">Disponibilité</label>
            <select class="form-select" id="availability" name="availability" required>
                <option value="disponible" <?= isset($availability) && $availability === 'disponible' ? 'selected' : '' ?>>Disponible</option>
                <option value="indisponible" <?= isset($availability) && $availability === 'indisponible' ? 'selected' : '' ?>>Indisponible</option>
            </select>
            <?php if (isset($arrayError['availability'])) { ?>
                <p class="text-danger"><?= htmlspecialchars($arrayError['availability']) ?></p>
            <?php } ?>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($description ?? '') ?></textarea>
            <?php if (isset($arrayError['description'])) { ?>
                <p class="text-danger"><?= htmlspecialchars($arrayError['description']) ?></p>
            <?php } ?>
        </div>

        <div class="mb-3">
            <label for="picture" class="form-label">Image de la licence</label>
            <input type="file" class="form-control" id="picture" name="picture" accept="image/*" required>
            <?php if (isset($arrayError['picture'])) { ?>
                <p class="text-danger"><?= htmlspecialchars($arrayError['picture']) ?></p>
            <?php } ?>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prix</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= htmlspecialchars($price ?? '') ?>" required>
            <?php if (isset($arrayError['price'])) { ?>
                <p class="text-danger"><?= htmlspecialchars($arrayError['price']) ?></p>
            <?php } ?>
        </div>

        <button type="submit" class="btn btn-primary mt-5 mb-5">Ajouter la licence</button>
    </div>
</form>

<?php
// Inclusion du fichier footer.php
require_once(__DIR__ . '/../partials/footer.php');
?>