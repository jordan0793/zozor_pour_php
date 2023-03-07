<nav>
    <ul>
        <li><a href="index.php">ACCUEIL</a></li>
        <li><a href="blog.php">BLOG</a></li>
        <li><a href="cv.php"> CV</a></li>
        <?php
        if (!isset($_SESSION["user"])) :
        ?>
            <li><a href="register.php"> INSCRIPTION</a></li>
            <li><a href="login.php"> CONNEXION</a></li>
        <?php else : ?>
            <li>Bonjour <?= $_SESSION["user"]["pseudo"] ?>
            </li>
            <li><a href="logout.php">DECONNEXION</a></li>
        <?php endif; ?>
    </ul>
</nav>