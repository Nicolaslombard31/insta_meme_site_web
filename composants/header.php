<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="./css/insta_meme.css?t=<?php echo time(); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header>
        <nav>
            <a href="index.php?page=1"><img src="images/Instameme - Logo.png" alt="InstaMeme" width="300" class="image"></a>
            <a href="index.php?page=1" class="texte">Accueil</a>
            <form action="recherche.php" method="POST">
                <input type="text" name="text" class="search" placeholder="Rechercher">
                <input type="submit" name="submit" class="submit" value="search">
            </form>
            <?php
            if (isset($_SESSION['pseudo'])) {
                echo '<a href="create.php" class="texte_crate">Créer</a>'
                    . '<a href="profil.php?user=' . $_SESSION['id_user'] . '" class="texte_profile">Profil</a>'
                    . '<a href="disconnect.php" class="texte_profile">Deconnexion</a>';
            } else {
                echo '<a href="connect.php" class="texte_create">connexion</a>'
                    . '<a href="inscription.php" class="texte_profil">Inscription</a>';
            }
            ?>
        </nav>
    </header>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>