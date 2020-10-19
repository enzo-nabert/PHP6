<?php

require_once File::build_path(array('controller','ControllerVoiture.php')) ;
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    ControllerVoiture::$action();
}else{
    ControllerVoiture::readAll();
}


