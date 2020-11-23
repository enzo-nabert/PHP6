<?php

require_once File::build_path(array('controller','ControllerVoiture.php')) ;
if (isset($_GET['action'])) {
    $controller_class = "controller" . ucfirst($_GET['controller']);
    if (class_exists($controller_class)) {
        if (in_array($_GET['action'],get_class_methods('ControllerVoiture'))) {
            $action = $_GET['action'];
            $controller_class::$action();

        }else{
            ControllerVoiture::error("action non définie");
        }
    }else{
        ControllerVoiture::error("class doesn't exist");
    }
}else{
    ControllerVoiture::readAll();
}


