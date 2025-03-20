
<?php
// Inclusion des fichiers partiels
require_once(__DIR__ . '/../partials/head.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Licence</title>
    <link rel="stylesheet" href="/public/css/style.css"> <!-- Ajuste le chemin selon ton projet -->
</head>
<body>
    <h1>Détails de la Licence</h1>

    <?php if (isset($myLicence)): ?>
        <p><strong>Titre :</strong> <?= htmlspecialchars($myLicence->getTitle()); ?></p>
        <p><strong>Description :</strong> <?= htmlspecialchars($myLicence->getDescription()); ?></p>
        <p><strong>Prix :</strong> <?= number_format($myLicence->getPrice(), 2, ',', ' ') . " €"; ?></p>
        <p><strong>Disponibilité :</strong> <?= $myLicence->getAvailability() ? "Disponible" : "Non disponible"; ?></p>
        <p><strong>Utilisateur :</strong> <?= $myLicence->getIdUser(); ?></p>
        <p><strong>Image :</strong></p>
        <img src="<?= $myLicence->getPicturePath(); ?>" alt="Image de la licence" width="200">

        <br><a href="/licence">Retour à la liste</a>
    <?php else: ?>
        <p>Licence introuvable.</p>
    <?php endif; ?>

</body>
</html>
