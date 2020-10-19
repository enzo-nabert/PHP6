<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pagetitle; ?></title>
    <link rel="stylesheet" type="text/css" href=view/view.css>
</head>
<body>
    <header>
        <nav>
            <a href="index.php?action=readAll">Liste Voiture</a>
            <a href="index.php?action=readAll&controller=utilisateur">Accueil Utilisateur</a>
            <a href="index.php?action=readAll&controller=trajet">Accueil Trajet</a>
            <a href="index.php?action=create">Créer Voiture</a>
        </nav>
    </header>
    <main>
        <?php
            $filepath = File::build_path(array("view", $controller, "$view.php"));
            require $filepath;
        ?>
    </main>
    <footer>
        <p>
            Site de covoiturage de ...
        </p>
    </footer>

</body>
</html>