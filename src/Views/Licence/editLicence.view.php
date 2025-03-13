<!-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Licence</title>
</head>
<body>
    <h2>Modifier la Licence</h2>
    <form method="POST">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($licence['titre'] ?? '') ?>" required><br>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($licence['description'] ?? '') ?></textarea><br>

        <label for="prix">Prix :</label>
        <input type="number" id="prix" name="prix" value="<?= htmlspecialchars($licence['prix'] ?? '') ?>" required><br>

        <label for="disponibilite">Disponibilité :</label>
        <select id="disponibilite" name="disponibilite" required>
            <option value="1" <?= isset($licence['disponibilite']) && $licence['disponibilite'] == 1 ? 'selected' : '' ?>>Disponible</option>
            <option value="0" <?= isset($licence['disponibilite']) && $licence['disponibilite'] == 0 ? 'selected' : '' ?>>Indisponible</option>
        </select><br>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html> -->
