<?php

namespace Src\Controller;

require_once '../Service/ServiceReparation.php';
require_once '../View/ViewReparation.php';
use Src\Service\ServiceReparation;
use Src\View\ViewReparation;

session_start();

if(!isset($_SESSION["role"])) {
    //session_start();
    //redireccionar a index.php
    header("Location: " . __DIR__ . "/../index.php");
    exit();
}

$contr = new ControllerReparation();

if(isset($_POST["getReparation"])) {
    try {
        $contr->getReparation();
    } catch(\Exception $e) {
        echo '<p class="mx-3">' . $e->getMessage() . '</p>';
    }
    
    //poner $_POST a null?
}

if(isset($_POST["insertReparation"])) {
    $contr->insertReparation();
}

class ControllerReparation {
    function getReparation() {
        $role = $_SESSION["role"];
        $idReparation = $_POST["uuid"];

        $serviceReparation = new ServiceReparation();
        $reparation = $serviceReparation->getReparation($role, $idReparation);

        $view = new ViewReparation();
        $view->render($reparation);
    }


    function insertReparation() {
        echo "prueba";
    }
}

