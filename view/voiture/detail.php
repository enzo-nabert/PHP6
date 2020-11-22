<?php
    $htmlspecialImmat = htmlspecialchars("{$v->getImmatriculation()}");
    $htmlspecialMarque = htmlspecialchars("{$v->getMarque()}");
    $htmlspecialCouleur = htmlspecialchars("{$v->getCouleur()}");
    echo "<div class='listeDiv'>Immatriculation: $htmlspecialImmat , Marque: $htmlspecialMarque , Couleur: $htmlspecialCouleur<a class='supprButton' href='index.php?action=delete&immat=$htmlspecialImmat'>SUPPRIMER</a></div>";
?>