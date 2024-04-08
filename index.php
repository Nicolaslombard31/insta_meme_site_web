<?php
require_once 'affichage.php';
require_once 'db.php';
$stmt = db()->prepare("SELECT contenus.*, pseudo FROM contenus INNER JOIN utilisateurs ON utilisateurs.id = contenus.id_utilisateur order BY 'id' LIMIT 0, 9;");
$stmt->execute();
$contenus = $stmt->fetchAll();
$stmt = db()->prepare("SELECT COUNT(*) as nb_contenus FROM contenus;");
$stmt->execute();
$nbcontenus = $stmt->fetch();
$stmt = db()->prepare("SELECT * FROM contenus INNER JOIN commentaires ON commentaires.id_contenu = contenus.id order BY 'contenus.id'");
$stmt->execute();
$commentaires = $stmt->fetchAll();
$stmt = db()->prepare("SELECT id_contenu, COUNT(*) as nb_likes from likes GROUP BY id_contenu;");
$stmt->execute();
$nblikes = $stmt->fetchAll();
$like  = [];
if (isset($_SESSION['pseudo'])) {
    $stmt = db()->prepare("SELECT id_contenu from likes WHERE id_utilisateur = :user;");
    $stmt->bindValue(':user', $_SESSION['id_user'], PDO::PARAM_INT);
    $stmt->execute();
    foreach ($stmt->fetchAll() as $row) {
        $like[] = $row['id_contenu'];
    }
} else {
    $like = 0;
}
echo pageHeader("Insta Même");
?>
<div class="grid grid-cols-3 gap-8">
    <?php
    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $currentPage = (int) strip_tags($_GET['page']);
    } else {
        $currentPage = 1;
    }
    $nbContenu = (int) $nbcontenus['nb_contenus'];
    $parPage = 9;
    $pages = ceil($nbContenu / $parPage);
    $premier = ($currentPage * $parPage) - $parPage;
    $sql = 'SELECT contenus.*, pseudo FROM `contenus` Inner join utilisateurs ON utilisateurs.id = contenus.id_utilisateur ORDER BY `date_publication` DESC LIMIT :premier, :parpage;';
    $query = db()->prepare($sql);
    $query->bindValue(':premier', $premier, PDO::PARAM_INT);
    $query->bindValue(':parpage', $parPage, PDO::PARAM_INT);
    $query->execute();
    $contenus = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($contenus as $contenu) {
        echo '<div class="flex flex-col justify-center items-center space-y-2" id="' . $contenu['id'] . '">'
            . '<div class="div">'
            . '<a href="profil.php?user=' . $contenu['id_utilisateur'] . '" class="pseudo">' . $contenu['pseudo'] . '</a>'
            . '<br>'
            . '<a href="affich_image.php?contenu=' . $contenu['id'] . '"><img src="' . 'images/' . $contenu['chemin_image'] . '" class="h-40" /></a>'
            . '<br>'
            . '<div class="flex">';
        foreach ($nblikes as $nblike) {
            if ($nblike['id_contenu'] === $contenu['id']) {
                echo $nblike['nb_likes']
                    . ' likes';
            }
        }
        if ($like === 0) {
            echo '<a href="connect.php" class="formu"><img src="./images/like_vide.jpg"></a>';
        } else {
            if (in_array($contenu['id'], $like)) {
                echo '<form class="formu" action="dislikes.php?page=' . $currentPage . '" method="POST">'
                    . '<button type="submit" id="submit"><img src="./images/like_plein.jpg"></button>'
                    . '<input type="hidden" name="id_contenu" value="' . $contenu['id'] . '">'
                    . '</form>';
            } else {
                echo '<form class="formu" action="likes.php?page=' . $currentPage . '" method="POST">'
                    . '<button type="submit" id="submit"><img src="./images/like_vide.jpg"></button>'
                    . '<input type="hidden" name="id_contenu" value="' . $contenu['id'] . '">'
                    . '</form>';
            }
        }
        echo '</div>'
            . '<br>'
            . 'description: '
            . $contenu['description']
            . '<br>'
            . 'commentaire: ';
        $nbComment = 0;
        foreach ($commentaires as $commentaire) {
            if ($commentaire['id_contenu'] === $contenu['id']) {
                if ($nbComment <= 2) {
                    echo $commentaire['message']
                        . '<br>';
                    $nbComment++;
                } else {
                    echo '...';
                    break;
                }
            }
        }
        echo '</div>'
            . '</div>';
    }
    ?>
</div>
<?php
echo pageFooter();
?>