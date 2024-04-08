<?php
require_once 'db.php';
if (isset($_POST['register'])) {
    if ($_POST['mot_de_passe'] == $_POST['mot_de_pass']) {
        $password = md5($_POST['mot_de_passe']);

        $requete = db()->prepare('INSERT INTO utilisateurs (pseudo, mot_de_passe, date_inscription) VALUES (:pseudo, :pass, now())');
        $requete->execute(
            array(
                "pseudo" => $_POST['pseudo'],
                "pass" => $password
            )
        );
        $reponse = $requete->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['pseudo'] = $pseudo;
        header('Location: index.php?page=1');
    } else {
        header('Location: inscription.php?erreur=1');
    }
}
