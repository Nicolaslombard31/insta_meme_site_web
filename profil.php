<?php
require_once 'affichage.php';
require_once 'db.php';
$stmt = db()->prepare("SELECT * FROM contenus WHERE id_utilisateur= ?");
$stmt->execute([$_GET['user']]);
$contenus = $stmt->fetchAll();
$stmt = db()->prepare("SELECT * FROM contenus INNER JOIN commentaires ON commentaires.id_contenu = contenus.id order BY 'contenus.id'");
$stmt->execute();
$commentaires = $stmt->fetchAll();
$stmt = db()->prepare("SELECT id_contenu, COUNT(*) as nb_likes from likes GROUP BY id_contenu;");
$stmt->execute();
$nblikes = $stmt->fetchAll();
$like  = [];
echo pageHeader("Insta Même");
?>
<div class="grid grid-cols-3 gap-8">
    <?php
    foreach ($contenus as $contenu) {
        echo '<div class="flex flex-col justify-center items-center space-y-2" id="' . $contenu['id'] . '">'
            . '<div class="div">'
            . '<img src="' . 'images/' . $contenu['chemin_image'] . '" class="h-40" />'
            . '<br>';
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
                echo '<form class="formu" action="dislikes.php" method="POST">'
                    . '<button type="submit" id="submit"><img src="./images/like_plein.jpg"></button>'
                    . '<input type="hidden" name="id_contenu" value="' . $contenu['id'] . '">'
                    . '</form>';
            } else {
                echo '<form class="formu" action="likes.php" method="POST">'
                    . '<button type="submit" id="submit"><img src="./images/like_vide.jpg"></button>'
                    . '<input type="hidden" name="id_contenu" value="' . $contenu['id'] . '">'
                    . '</form>';
            }
        }
        echo '<br>'
            . 'description: '
            . $contenu['description']
            . '<br>'
            . 'commentaire: ';
        $nbComment = 0;
        foreach ($commentaires as $commentaire) {
            if ($commentaire['id_contenu'] == $contenu['id']) {
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