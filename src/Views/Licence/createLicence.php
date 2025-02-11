<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une licence</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css"> <!-- Assure-toi de lier ton fichier CSS -->
</head>
<body>

    <div class="container">
        <h1>Ajouter une licence</h1>
        <form action="/addLicence" method="POST" enctype="multipart/form-data">
            <!-- Titre de la licence -->
            <div class="mb-3">
                <label for="title" class="form-label">Titre de la licence</label>
                <input type="text" class="form-control" id="title" name="title" required>
                <?php if (isset($this->arrayError['title'])) { ?>
                    <p class="text-danger"><?= $this->arrayError['title'] ?></p>
                <?php } ?>
            </div>

            <!-- Disponibilité -->
            <div class="mb-3">
                <label for="availability" class="form-label">Disponibilité</label>
                <select class="form-select" id="availability" name="availability" required>
                    <option value="disponible">Disponible</option>
                    <option value="indisponible">Indisponible</option>
                </select>
                <?php if (isset($this->arrayError['availability'])) { ?>
                    <p class="text-danger"><?= $this->arrayError['availability'] ?></p>
                <?php } ?>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                <?php if (isset($this->arrayError['description'])) { ?>
                    <p class="text-danger"><?= $this->arrayError['description'] ?></p>
                <?php } ?>
            </div>

            <!-- Image -->
            <div class="mb-3">
                <label for="picture" class="form-label">Image de la licence</label>
                <input type="file" class="form-control" id="picture" name="picture" accept=".jpg,.jpeg,.png,.webp">
                <?php if (isset($this->arrayError['picture'])) { ?>
                    <p class="text-danger"><?= $this->arrayError['picture'] ?></p>
                <?php } ?>
            </div>

            <!-- Prix -->
            <div class="mb-3">
                <label for="price" class="form-label">Prix</label>
                <input type="number" class="form-control" id="price" name="price" required>
                <?php if (isset($this->arrayError['price'])) { ?>
                    <p class="text-danger"><?= $this->arrayError['price'] ?></p>
                <?php } ?>
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="btn btn-primary">Ajouter la licence</button>
        </form>
    </div>

    <script src="path/to/your/js/scripts.js"></script> <!-- Assure-toi de lier ton fichier JS si nécessaire -->
</body>
</html>
