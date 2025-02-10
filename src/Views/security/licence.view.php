<?php
require_once(__DIR__ . '/partials/head.php'); 
 ?>

<body>
    <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                    if (isset($_SESSION['user'])) {
                        if ($_SESSION['user']['idRole'] == 2) {
                    ?>
                            <li class="nav-item">
                                <a class="nav-link" href="15551">Ajouter une licence</a>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">Déconnexion</a>
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
                </ul>
            </div>
</body>
