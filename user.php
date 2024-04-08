<?php
require_once 'affichage.php';
require_once 'db.php';

$stmt = db()->prepare("SELECT * FROM contenus");
$stmt->execute();
$contenus = $stmt->fetchAll();
$stmt = db()->prepare("SELECT COUNT(*) as nb_contenus FROM contenus;");
$stmt->execute();
$nbcontenus = $stmt->fetch();
?>

<?php
echo pageHeader("Insta Même");
?>

<div class="grid grid-cols-4 gap-10">
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

    $sql = 'SELECT * FROM `contenus` Inner join utilisateurs ON utilisateurs.id = contenus.id_utilisateur ORDER BY `date_publication` DESC LIMIT :premier, :parpage;';
    $query = db()->prepare($sql);
    $query->bindValue(':premier', $premier, PDO::PARAM_INT);
    $query->bindValue(':parpage', $parPage, PDO::PARAM_INT);
    $query->execute();
    $contenus = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($contenus as $contenu) {
        echo '<div class="flex flex-col justify-center items-center space-y-2" id="' . $contenu['id'] . '">'
            . '<img src="' . 'images/' . $contenu['chemin_image'] . '" class="h-40" />'
            . $contenu['description']
            . '</div>';
    }
    ?>
</div>
<?php echo pageFooter(); ?>