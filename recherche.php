<?php
require_once 'db.php';
if (isset($_POST['text'])) {
    $user = $_POST['text'];
    $stmt = db()->prepare("SELECT id FROM utilisateurs where pseudo = '" . $user . "'");
    $stmt->execute();
    $reponse = $stmt->fetchAll();
    if (count($reponse) != 0) {
        $_SESSION['id_user'] = $reponse[0]['id'];
        header('Location: profil.php?user=' . $_SESSION['id_user']);
    } else {
        echo "<p style='color:red'>Utilisateur non connue</p>"
            . '<a href="index.php?page=1">Retour page acceuil</a>';
    }
} else {
    echo "<p style='color:red'>Erreur</p>";
}
