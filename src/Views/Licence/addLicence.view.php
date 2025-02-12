<?php
session_start(); // Démarrer la session
require_once(__DIR__ . '/../partials/head.php'); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une licence</title>
    <link rel="stylesheet" href="/public/css/style.css"> 
</head>
<body>

<?php


if (isset($_SESSION['user']) && isset($_SESSION['user']['idRole'])) {
    $userRole = (int)$_SESSION['user']['idRole'];

    if (in_array($userRole, [1, 2])) {
?>
    <div class="container">
        <h1>Ajouter une licence</h1>
        <form action="/addLicence" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Titre de la licence</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="availability" class="form-label">Disponibilité</label>
                <select class="form-select" id="availability" name="availability" required>
                    <option value="disponible">Disponible</option>
                    <option value="indisponible">Indisponible</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label for="picture" class="form-label">Image de la licence</label>
                <input type="file" class="form-control" id="picture" name="picture" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Prix</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter la licence</button>
        </form>
    </div>
<?php
    } else {
        echo "<p class='text-danger text-center'>Vous n'avez pas l'autorisation d'accéder à cette page.</p>";
    }
} else {
    echo "<p class='text-danger text-center'>Veuillez vous connecter pour accéder à cette page.</p>";
}
?>

</body>
</html>
