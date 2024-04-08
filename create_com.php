<?php
require_once 'affichage.php';
require_once 'db.php';
echo pageHeader("Insta Même");
?>
<div class="container">
    <form action="publier_com.php?contenu= <?php echo $_GET['contenu']; ?>" method="POST" class="form">
        <textarea type="text" name="description" class="description_com" placeholder="Champ de Description" require></textarea>
        <input type="submit" name="valider" class="bouton" value="Valider">
    </form>
</div>