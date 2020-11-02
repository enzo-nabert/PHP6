<?php

require_once File::build_path(array('controller','ControllerVoiture.php')) ;
if (isset($_GET['action'])) {
    if (in_array($_GET['action'],get_class_methods('ControllerVoiture'))) {
        $action = $_GET['action'];
        ControllerVoiture::$action();
    }else{
        $error = "action non définie";
        $controller = 'voiture';
        $view = 'error';
        $pageTitle = 'Erreur';
        require File::build_path(array('view','view.php'));
    }
}else{
    ControllerVoiture::readAll();
}


