<?php
// Inclusion des fichiers partiels
require_once(__DIR__ . '/../partials/head.php');
?>

<h1>Ajouter une licence</h1>

<!-- Affichage des messages de succès ou d'erreur -->
<?php if (!empty($errors)) { ?>
    <div class="alert alert-danger">
        <p>Le formulaire contient des erreurs. Veuillez les corriger avant de soumettre à nouveau.</p>
    </div>
<?php } ?>

<?php if (isset($_SESSION['successMessage'])) { ?>
    <div class="alert alert-success">
        <p><?= htmlspecialchars($_SESSION['successMessage']) ?></p>
    </div>
    <?php unset($_SESSION['successMessage']); // Supprimer le message après affichage ?>
<?php } ?>

<!-- Formulaire -->
<form method="POST" enctype="multipart/form-data">
    <div class="col-md-4 mx-auto d-block mt-5">
        <!-- Champ Titre -->
        <div class="mb-3">
            <label for="title" class="form-label">Titre de la licence</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($title) ?>" required>
            <?php if (isset($errors['title'])) { ?>
                <p class="text-danger"><?= htmlspecialchars($errors['title']) ?></p>
            <?php } ?>
        </div>

        <!-- Champ Disponibilité -->
        <div class="mb-3">
            <label for="availability" class="form-label">Disponibilité</label>
            <select class="form-select" id="availability" name="availability" required>
                <option value="disponible" <?= $availability === 1 ? 'selected' : '' ?>>Disponible</option>
                <option value="indisponible" <?= $availability === 0 ? 'selected' : '' ?>>Indisponible</option>
            </select>
            <?php if (isset($errors['availability'])) { ?>
                <p class="text-danger"><?= htmlspecialchars($errors['availability']) ?></p>
            <?php } ?>
        </div>

        <!-- Champ Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required><?= htmlspecialchars($description) ?></textarea>
            <?php if (isset($errors['description'])) { ?>
                <p class="text-danger"><?= htmlspecialchars($errors['description']) ?></p>
            <?php } ?>
        </div>

        <!-- Champ Image -->
        <div class="mb-3">
            <label for="picture" class="form-label">Image de la licence</label>
            <input type="file" class="form-control" id="picture" name="picture" accept="image/*" required>
            <?php if (isset($errors['picture'])) { ?>
                <p class="text-danger"><?= htmlspecialchars($errors['picture']) ?></p>
            <?php } ?>
        </div>

        <!-- Champ Prix -->
        <div class="mb-3">
            <label for="price" class="form-label">Prix</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= htmlspecialchars($price) ?>" required min="2" step="1">
            <?php if (isset($errors['price'])) { ?>
                <p class="text-danger"><?= htmlspecialchars($errors['price']) ?></p>
            <?php } ?>
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary mt-5 mb-5 text-center">Ajouter la licence</button>
    </div>
</form>

<?php
// Inclusion du pied de page
require_once(__DIR__ . '/../partials/footer.php');
?>