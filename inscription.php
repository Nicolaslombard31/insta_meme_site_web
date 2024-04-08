<?php
require_once 'affichage.php';
require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="./css/insta_meme.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div id="container">
        <!-- zone de connexion -->

        <form class="form" action="verification_inscrip.php" method="POST">
            <h1>Inscription</h1>

            <label><b>Nom d'utilisateur</b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="pseudo" required>

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="mot_de_passe" required>

            <label><b>Remettre le mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="mot_de_pass" required>

            <input class="input" type="submit" id='submit' value='REGISTER' name="register">
            <a href="./index.php" class="revenir">Revenir</a>
            <a href="./connect.php" class="revenir">Connexion</a>
            <?php
            if (isset($_POST['erreur'])) {
                $err = $_POST['erreur'];
                if ($err == 1) {
                    echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
            }
            ?>
        </form>
    </div>
</body>

</html>