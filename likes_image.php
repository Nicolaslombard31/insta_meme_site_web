<?php
require_once 'db.php';
$contenu = $_POST['id_contenu'];
$user = $_SESSION['id_user'];
$requete = db()->prepare('INSERT INTO likes (id_contenu, id_utilisateur) VALUES (:contenu, :user)');
$requete->execute(
    array(
        "contenu" => $contenu,
        "user" => $user
    )
);
header('Location: affich_image.php?contenu=' . $contenu);
