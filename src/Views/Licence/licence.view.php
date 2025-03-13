<?php   

// Inclusion des fichiers partiels
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
    <h1>Liste des licences</h1>

    <!-- Formulaire de recherche -->
    <div class="search-bar">
        <form action="/recherche" method="GET">
            <label for="ville">Rechercher par ville :</label>
            <input type="text" id="ville" name="ville" placeholder="Rechercher par ville" value="<?= isset($_GET['ville']) ? htmlspecialchars($_GET['ville']) : '' ?>">
            <button type="submit">Rechercher</button>
        </form>
    </div>
    
    <?php if (isset($_SESSION['user']) && ($_SESSION['user']['idRole'] == 1 || $_SESSION['user']['idRole'] == 2)): ?>
        <div class="newLicence">
            <a class="button-add" href="/addLicence">Ajouter une licence</a>
        </div>
    <?php endif; ?>

    <!-- Affichage des cartes -->
    <?php if (!empty($licences)): ?>
        <div class="licence-cards">
            <?php foreach ($licences as $licence): ?>
                <div class="card">
                    <img src="<?= htmlspecialchars($licence->getPicturePath()) ?>" alt="<?= htmlspecialchars($licence->getTitle()) ?>">
                    <h2><?= htmlspecialchars($licence->getTitle()) ?></h2>
                    <p><?= htmlspecialchars($licence->getDescription()) ?></p>
                    <p class="price">Prix: <?= htmlspecialchars($licence->getPrice()) ?> €</p>
                    <p><?= $licence->getAvailability() ? 'Disponible' : 'Indisponible' ?></p>  
                </div>
            <?php endforeach; ?>
            <form action="/deleteTaskAndTodo" method="POST">
                        <input type="hidden" name="id" id="id" value="<?= $task->getId() ?>">
                        <button type="submit">Suprimer la tâche</button>
                    </form>
        </div>
    <?php else: ?>
        <p>Aucune licence disponible.</p>
    <?php endif; ?>
</body>
</html>
