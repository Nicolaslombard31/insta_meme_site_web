<?php
require_once 'db.php';
if (isset($_POST['pseudo']) && isset($_POST['mot_de_passe'])) {
    // connexion à la base de données
    $username = $_POST['pseudo'];
    $password = md5($_POST['mot_de_passe']);
    $stmt = db()->prepare("SELECT id FROM utilisateurs where pseudo = :user and mot_de_passe = :password");
    $stmt->execute(
        array(
            'user' => $username,
            'password' => $password
        )
    );
    $reponse = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = $reponse['count(*)'];
    if (count($reponse) != 0) // nom d'utilisateur et mot de passe correctes
    {
        $_SESSION['id_user'] = $reponse[0]['id'];
        $_SESSION['pseudo'] = $username;
        header('Location: index.php?connect=1');
    } else {
        header('Location: connect.php?erreur=1'); // utilisateur ou mot de passe incorrect
    }
} else {
    header('Location: connect.php?erreur=2'); // utilisateur ou mot de passe vide
}
mysqli_close($db); // fermer la connexion
