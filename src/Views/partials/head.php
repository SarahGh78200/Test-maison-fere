<!DOCTYPE html>
<html lang="fr">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Free Moove Driver
    </title>
    <script src="https://kit.fontawesome.com/f5a1d28d53.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/public/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg myNav">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="/public/img/logo.png" alt="Logo" width="50" height="50"> Free Moove Driver
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                    if (isset($_SESSION['user'])) {
                        if ($_SESSION['user']['idRole'] == 1 || $_SESSION['user']['idRole'] == 2) {
                    ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/addLicence">Ajouter une licence</a>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">Déconnexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/profil">Profil</a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Inscription</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Connexion</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                            <a class="nav-link" href="/licence">Licence</a>
                        </li>
                </ul>
            </div>
        </div>
    </nav>
  