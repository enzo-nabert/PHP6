<?php
require_once File::build_path(array('model','ModelVoiture.php')); // chargement du modèle
class ControllerVoiture {
    public static function readAll() {
        $tab_v = ModelVoiture::getAllVoitures();
        $pagetitle = "Liste des Voitures";
        $controller = 'voiture';
        $view = 'list';
        require File::build_path(array('view','view.php'));
    }

    public static function read(){
        $v = ModelVoiture::getVoitureByImmat($_GET['immat']);
        $pagetitle = "Détail Voitures";
        $controller = 'voiture';
        if ($v != null){
            $view = 'detail';
        }else{
            $view = 'error';
            $error = "<p>Voiture inexistante</p>";
        }
        require File::build_path(array('view','view.php'));
    }

    public static function create(){
        $pagetitle = "Créer Voitures";
        $controller = 'voiture';
        $view = 'create';
        require File::build_path(array('view','view.php'));
    }

    public static function created(){
        $voiture = new ModelVoiture($_GET);
        if ($voiture->save() == false){
            self::error("voiture déjà créée");
        }else {
            require File::build_path(array('view','voiture','created.php'));
        }
    }

    public static function update(){
        $pagetitle = "Modifier Voitures";
        $controller = 'voiture';
        $view = 'update';
        require File::build_path(array('view','view.php'));
    }

    public static function updated(){
        $voiture = ModelVoiture::getVoitureByImmat($_GET['immatriculation']);
        $htmlSpecialMarque = htmlspecialchars($_GET['marque']);
        $htmlSpecialCouleur = htmlspecialchars($_GET['couleur']);
        $voiture->update($htmlSpecialMarque,$htmlSpecialCouleur);
        $pagetitle = "Modifier Voitures";
        $controller = 'voiture';
        $view = 'updated';
        require File::build_path(array('view','view.php'));
    }

    public static function delete(){
        if (isset($_GET["immat"])) {
            ModelVoiture::deleteByImmat($_GET["immat"]);
            $pagetitle = "Delete Voitures";
            $controller = 'voiture';
            $view = 'deleted';
            require File::build_path(array('view','view.php'));
        }else{
            self::error("immat non définie");
        }
    }

    public static function error($message){
        $error = $message;
        $pagetitle = "Erreur";
        $controller = 'voiture';
        $view = 'error';
        require File::build_path(array('view','view.php'));
    }
}
