<?php
    foreach ($tab_v as $v){
        $immat = htmlspecialchars($v->getImmatriculation());
        $immatURL = rawurlencode($v->getImmatriculation());
        echo "<div class='listeDiv'><a class='immatListe' href='index.php?action=read&immat=$immatURL'> Immatriculation: $immat</a><a class='supprButton' href='index.php?action=delete&immat=$immatURL'>SUPPRIMER</a><a class='updateButton' href='index.php?action=update&immat=$immatURL'>MODIFIER</a></div>";
    }
?>