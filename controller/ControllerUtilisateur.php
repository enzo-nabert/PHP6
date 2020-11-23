<?php

require_once File::build_path(array('model','ModelUtilisateur.php'));
class ControllerUtilisateur
{
    public static function readAll()
    {
        $tab_u = ModelUtilisateur::getAllUtilisateurs();
        $pagetitle = "Liste des Utilisateurs";
        $controller = 'utilisateur';
        $view = 'list';
        require File::build_path(array('view', 'view.php'));
    }
}