<?php

require_once File::build_path(array('model','ModelUtilisateur.php'));
class ControllerUtilisateur
{
    protected static $object = "utilisateur";
    public static function readAll()
    {
        $tab_u = ModelUtilisateur::selectAll();
        $pagetitle = "Liste des Utilisateurs";
        $view = 'list';
        require File::build_path(array('view', 'view.php'));
    }

    public static function read(){
        $u = ModelUtilisateur::select($_GET['login']);
        $pagetitle = "Détail Utilisateur";
        if ($u != null){
            $view = 'detail';
        }else{
            self::error("Utilisateur inexistant");
        }
        require File::build_path(array('view','view.php'));
    }

    public static function delete(){
        if (isset($_GET["login"])) {
            ModelUtilisateur::delete($_GET["login"]);
            $pagetitle = "Delete Utilisateur";
            $view = 'deleted';
            require File::build_path(array('view','view.php'));
        }else{
            self::error("login non défini");
        }
    }

    public static function error($message){
        $pagetitle = "Delete Utilisateur";
        $view = 'error';
        require File::build_path(array('view','view.php'));
    }
}