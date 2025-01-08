<?php

namespace Src\View;

session_start();

if(isset($_POST["role"])) {
    
    $_SESSION["role"] = $_POST["role"];
} else {
    //redirect index.php?
}


class ViewReparation {
    public function render($reparation) {
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>ID de la reparación: </strong>' . $reparation->getReparationID() . '</li>
                <li class="list-group-item"><strong>ID del taller: </strong>' . $reparation->getWorkshopID() . '</li>
                <li class="list-group-item"><strong>Nombre del taller: </strong>' . $reparation->getWorkshopName() . '</li>
                <li class="list-group-item"><strong>Fecha de registro: </strong>' . $reparation->getRegisterDate() . '</li>
                <li class="list-group-item"><strong>Número de matrícula: </strong>' . $reparation->getLicensePlate() . '</li>
            </ul>';
    }
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <h1 class="mx-3 my-3">Car Workshop Reparation Menu</h1>

    <h2 class="mx-3 my-3">Search car reparation</h2>

    <form action="../Controller/ControllerReparation.php" method="POST" class="mx-3">
        <label for="uuid" class="form-label">ID reparation number: </label>

        <input type="text" name="uuid" id="uuid" class="form-control">
        
        <button type="submit" name="getReparation" class="btn btn-primary my-3">Search</button>
    </form>

    <br>
    <div id="getReparationResult"></div>

    <?php
    //SI ES EMPLEADO PUEDE REGISTRAR REPARACIONES
    if(isset($_SESSION["role"])) {
        if($_SESSION["role"] == "employee") {
            ?>
            <h2 class="mx-3 my-3">Register car reparation</h2>

            <form action="../Controller/ControllerReparation.php" method="POST" class="mx-3">
                <label for="workshopID" class="form-label">Workshop ID: </label>
                <input type="number" name="workshopID" id="workshopID" class="form-control" min="0" max="9999" required>
                
                <label for="workshopName" class="form-label">Name of the workshop: </label>
                <input type="text" name="workshopName" id="workshopName" class="form-control" maxlength="12" required>

                <label for="registerDate" class="form-label">Register date: </label>
                <input type="date" name="registerDate" id="registerDate" class="form-control" required>

                <label for="licensePlate" class="form-label">License plate: </label>
                <input type="text" name="licensePlate" pattern="^\d{4}[- ]?[A-Za-z]{3}$" title="La matrícula debe tener formato 1234-ABC o 1234 ABC" id="licensePlate" class="form-control" maxlength="8" required>

                <button type="submit" name="insertReparation" class="btn btn-primary my-3">Register</button>
            </form>

            <?php
        }
    }

    ?>
</body>
</html>