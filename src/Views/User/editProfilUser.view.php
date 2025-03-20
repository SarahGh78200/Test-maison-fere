<?php require_once(__DIR__ . '/../partials/head.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Licences</title>
    <link rel="stylesheet" href="/public/css/styleEditProfil.css">
</head>
<body>
    

<h2>Modifier mon profil</h2>

<?php if (isset($errorMessage)): ?>
    <p style="color: red;"><?= htmlspecialchars($errorMessage) ?></p>
<?php endif; ?>

<form action="/editProfilUser" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($user->getId()) ?>">

    <label for="surname">Nom :</label>
    <input type="text" id="surname" name="surname" value="<?= htmlspecialchars($user->getSurname()) ?>" required>

    <label for="name">Prénom :</label>
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($user->getName()) ?>" required>


    <label for="email">Email :</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>" required>


    <button type="submit">Enregistrer</button>
</form>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>