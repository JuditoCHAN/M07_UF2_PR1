<?php

namespace Src\Controller;

require_once '../Service/ServiceReparation.php';
require_once '../View/ViewReparation.php';

use Src\Service\ServiceReparation;
use Src\View\ViewReparation;


if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

$contr = new ControllerReparation();
if(isset($_POST["getReparation"])) {
    $contr->getReparation();
}

if(isset($_POST["insertReparation"])) {
    $contr->insertReparation();
}

class ControllerReparation {
    function getReparation() {
        try {
            $role = $_SESSION["role"];
            $idReparation = $_POST["uuid"];

            $serviceReparation = new ServiceReparation();
            $reparation = $serviceReparation->getReparation($role, $idReparation);

            $view = new ViewReparation();
            $view->render($reparation);
        }catch(\Exception $e) {
            $viewError = new ViewReparation();
            $viewError->getReparationMessageError();
        }
    }


    function insertReparation() {
        try {
            $workshopID = $_POST["workshopID"];
            $workshopName = $_POST["workshopName"];
            $registerDate = $_POST["registerDate"];
            $licensePlate = $_POST["licensePlate"];

            $serviceReparation = new ServiceReparation();
            $uuid = $serviceReparation->insertReparation($workshopID, $workshopName, $registerDate,$licensePlate);

            $viewError = new ViewReparation();
            $viewError->insertReparationResult($uuid);
        } catch (\Exception $e) {
            $viewError = new ViewReparation();
            //$viewError->getReparationMessageError();
        }
    }
}

