<!-- footer.php -->
<footer>
    <?php
    $stmt = db()->prepare("SELECT COUNT(*) as nb_contenus FROM contenus;");
    $stmt->execute();
    $nbcontenus = $stmt->fetch();
    $nbContenu = (int) $nbcontenus['nb_contenus'];
    $parPage = 9;
    $pages = ceil($nbContenu / $parPage);
    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $curentPage = (int) strip_tags($_GET['page']);
    } else {
        $curentPage = 2;
    }
    $url = str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
    if ($curentPage != 1) {
        $page = $url . '?page=' . $curentPage - 1;
        echo '<a href="' . $page . '" class="footer">Page précédente</a>';
    }
    if ($curentPage != $pages) {
        $page = $url . '?page=' . $curentPage + 1;
        echo '<a href="' . $page . '" class="footer">Page suivante</a>';
    }
    ?>
</footer>
</body>

</html>