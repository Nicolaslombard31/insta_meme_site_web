<?php
require_once 'affichage.php';
require_once 'db.php';
echo pageHeader("Insta Même");
?>
<div class="container">
    <form action="publier.php" method="POST" class="form" enctype="multipart/form-data">
        <input type="file" name="image" class="image_lien" placeholder="Lien de l'image" require>
        <textarea type="text" name="description" class="description" placeholder="Champ de Description" require></textarea>
        <input type="submit" name="valider" class="bouton" value="Valider">
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