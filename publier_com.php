<?php
require_once 'db.php';
if (isset($_POST['description'])) {
    $description = $_POST['description'];
    $requete = db()->prepare('INSERT INTO commentaires (id_contenu, id_utilisateur, message, date_publication) VALUES (:contenu, :user, :message, now())');
    $requete->execute(
        array(
            "contenu" => $_GET['contenu'],
            "user" => $_SESSION['id_user'],
            "message" => $_POST['description']
        )
    );
    $reponse = $requete->fetchAll(PDO::FETCH_ASSOC);
    header('Location: index.php?page=1');
} else {
    header('Location: create_com.php');
}
