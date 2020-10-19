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
            $error = "Voiture déjà créée";
            $pagetitle = "Erreur";
            $controller = 'voiture';
            $view = 'error';
            require File::build_path(array('view','view.php'));
        }else {
            require File::build_path(array('view','voiture','created.php'));
            ControllerVoiture::readAll();
        }
    }

    public static function delete(){
        $voiture = ModelVoiture::getVoitureByImmat($_GET['immat']);
        $voiture->delete();
        self::readAll();
    }
}
