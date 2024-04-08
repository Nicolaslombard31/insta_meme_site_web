<?php
require_once 'db.php';
$contenu = $_POST['id_contenu'];
$user = $_SESSION['id_user'];
$requete = db()->prepare('DELETE FROM likes Where id_contenu=:contenu and id_utilisateur=:user');
$requete->execute(
    array(
        "contenu" => $contenu,
        "user" => $user
    )
);
header('Location: affich_image.php?contenu=' . $contenu);
