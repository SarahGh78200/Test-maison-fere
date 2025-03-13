<?php
// Inclusion des fichiers partiels
require_once(__DIR__ . '/../partials/head.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de <?= htmlspecialchars($user->getName()) ?></title>
    <link rel="stylesheet" href="/public/css/styleProfil.css">
</head>

<body>
    <h1>Profil de <?= htmlspecialchars($user->getName()) ?></h1>
    <div class="profil">
        <p><strong>Nomm :</strong> <?= htmlspecialchars($user->getSurname()) ?></p>
        <p><strong>Prénom :</strong> <?= htmlspecialchars($user->getName()) ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($user->getEmail()) ?></p>
        <p><strong>Date de naissance :</strong> <?= htmlspecialchars($user->getBirthDate()) ?></p>
    </div>

    <div class="buttonMyLicence">
      <a href="/licenceUser"> Mes Licences</a>
    </div>



</body>

</html>