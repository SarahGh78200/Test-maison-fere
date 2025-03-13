<?php
require_once(__DIR__ . "/../partials/head.php");
?>

<div class="myBodyRegister">
    <h1>Inscription</h1>

    <form class="formulaire1" method='POST'>
        <div>
            <label for="surname">Nom</label>
            <input type="text" name='surname'>
            <?php if (isset($this->arrayError['surname'])) { ?>
                <p class='text-danger'><?= $this->arrayError['surname'] ?></p>
            <?php } ?>
        </div>
        <div>
            <label for="name">Prénom</label>
            <input type="text" name='name'>
            <?php if (isset($this->arrayError['name'])) { ?>
                <p class='text-danger'><?= $this->arrayError['name'] ?></p>
            <?php } ?>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name='email'>
            <!-- Affichage de l'erreur si l'email existe déjà -->
            <?php if (!empty($this->errors['email'])) { ?>
                <p class="text-danger"><?= htmlspecialchars($this->errors['email']) ?></p>
            <?php } ?>
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name='password'>
            <?php if (isset($this->arrayError['password'])) { ?>
                <p class='text-danger'><?= $this->arrayError['password'] ?></p>
            <?php } ?>
        </div>
        <div>
            <label for="birth_date">Date de naissance</label>
            <input type="date" name='birth_date'>
            <?php if (!empty($errors['birth_date'])) { ?>
                <p class='text-danger'><?= htmlspecialchars($errors['birth_date']) ?></p>
            <?php } ?>
        </div>
        <!-- Pas de sélection de rôle, l'utilisateur sera toujours un "Client" sauf si spécifié dans le code -->
        <input type="hidden" name="idRole" value="2"> <!-- 2 pour "Client" par défaut -->

        <button class="boutons" type="submit">Inscription</button>
    </form>
</div>

<?php
require_once(__DIR__ . "/../partials/footer.php");
?>