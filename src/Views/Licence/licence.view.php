<?php   
require_once(__DIR__ . '/../partials/head.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des licences</title>
    <link rel="stylesheet" href="/public/css/styleLicence.css">
</head>
<body>
    <h1>Annonces Licences</h1>

    <!-- Affichage des cartes -->
    <?php if (!empty($licences)): ?>
        <div class="licence-cards">
            <?php foreach ($licences as $licence): ?>
                <?php if ($licence->getAvailability()): // Vérifie si la licence est disponible ?>
                    <a href="/licenceDetail?id=<?= $licence->getId(); ?>" class="card">
                        <img src="<?= htmlspecialchars($licence->getPicturePath()) ?>" alt="<?= htmlspecialchars($licence->getTitle()) ?>">
                        <h2><?= htmlspecialchars($licence->getTitle()) ?></h2>
                        <p><?= htmlspecialchars($licence->getDescription()) ?></p>
                        <p class="price">Prix: <?= htmlspecialchars($licence->getPrice()) ?> €</p>
                        <p>Disponible</p>  
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucune licence disponible.</p>
    <?php endif; ?>

</body>
</html>
