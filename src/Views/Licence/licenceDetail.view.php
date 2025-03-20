
<?php
// Inclusion des fichiers partiels
require_once(__DIR__ . '/../partials/head.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la Licence</title>
    <link rel="stylesheet" href="/public/css/licenceDetail.css">
</head>
<body>
    <h1>Détails de la Licence</h1>
    
    <div class="licence-detail">
        <img src="<?= htmlspecialchars($myLicence->getPicturePath()) ?>" alt="<?= htmlspecialchars($myLicence->getTitle()) ?>" class="licence-detail-img">
        <h2><?= htmlspecialchars($myLicence->getTitle()) ?></h2>
        <p><?= htmlspecialchars($myLicence->getDescription()) ?></p>
        <p class="price">Prix: <?= htmlspecialchars($myLicence->getPrice()) ?> €</p>
        <p>Status: <?= $myLicence->getAvailability() ? 'Disponible' : 'Indisponible' ?></p>
        <p>Propriétaire: <?= htmlspecialchars($user->getName() ?? 'Inconnu') ?></p>

        <!-- Ajouter des détails supplémentaires si nécessaires -->
    </div>
</body>
</html>
