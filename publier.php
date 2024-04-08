<?php
require_once 'db.php';
$filename = time() . $_FILES['image']['name'];
$path = "images/" . $filename;
if (move_uploaded_file($_FILES["image"]["tmp_name"], $path)) {
    $description = $_POST['description'];
    $requete = db()->prepare('INSERT INTO contenus (id_utilisateur, chemin_image, description, date_publication) VALUES (:user, :img, :dscr, now())');
    $requete->execute(
        array(
            "user" => $_SESSION["id_user"],
            "img" => $filename,
            "dscr" => $description
        )
    );
    $reponse = $requete->fetchAll(PDO::FETCH_ASSOC);
    header('Location: index.php?page=1');
} else {
    header('Location: create.php?erreur=1');
}
