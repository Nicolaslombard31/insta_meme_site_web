<?php
require_once 'db.php';
if (isset($_POST['description'])) {
    $description = $_POST['description'];
    $requete = db()->prepare('INSERT INTO contenus (id_utilisateur, chemin_image, description, date_publication) VALUES (:user, :img, :dscr, now())');
    $requete->execute(
        array(
            "user" => $_SESSION["id_user"],
            "img" => $_GET['contenu'],
            "dscr" => $description
        )
    );
    $reponse = $requete->fetchAll(PDO::FETCH_ASSOC);
    header('Location: index.php?page=1');
} else {
    header('Location: partage.php?contenu=' . $_GET['contenu']);
}
