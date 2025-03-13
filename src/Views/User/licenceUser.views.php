<?php
// Inclusion des fichiers partiels
require_once(__DIR__ . '/../partials/head.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Licences</title>
</head>
<body>
    <div class="container">
        <h1>Mes Licences</h1>

        <?php if (empty($licences)) : ?>
            <p>Aucune licence ajoutée.</p>
        <?php else : ?>
            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Disponibilité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($licences as $licence) : ?>
                        <tr>
                            <td><?= htmlspecialchars($licence->getTitle()) ?></td>
                            <td><?= htmlspecialchars($licence->getDescription()) ?></td>
                            <td><?= htmlspecialchars($licence->getPrice()) ?> €</td>
                            <td><?= $licence->getAvailability() ? 'Disponible' : 'Indisponible' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
