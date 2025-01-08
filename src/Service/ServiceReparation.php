<?php
namespace Src\Service;

require_once '../Model/Reparation.php';

use Src\Model\Reparation;

class ServiceReparation {

    public function connect(): \mysqli {
        //lee la configuracion de la db de un archivo ini
        $db = parse_ini_file(__DIR__ . "/../../conf/db_config.ini");

        $mysqli = new \mysqli($db["host"], $db["user"], $db["pwd"], $db["db_name"]);

        if($mysqli->connect_errno) {
            throw new \Exception("Error connecting to database: " . $mysqli->connect_error);
        }

        return $mysqli;
    }

    
    public function getReparation($role, $idReparation): Reparation {
        $mysqli = $this->connect();

        //preparas el statement y se envia a la base de datos (con el positional placeholder ?)
        $stmt = $mysqli->prepare("SELECT * FROM Reparation WHERE reparationID = ?");

        try {
            if($stmt) { //compruebas que prepare() no haya fallado por sintaxis incorrecta
                $stmt->bind_param("i", $idReparation); //bind parameter values: asocias los placeholders (?)con los valores de los parametros
                $stmt->execute(); //los envias al servidor
                $result = $stmt->get_result(); //objeto mysqli_result que contiene las filas devueltas por la consulta

                if($result->num_rows > 0) {
                    $row = $result->fetch_assoc(); //array asociativo que representa la fila de la db
                    
                    $reparation = new Reparation($row['reparationID'], $row['workshopID'], $row['workshopName'], $row['registerDate'], $row['licensePlate']);
                    
                    //enmascarar imagen?
                    if($role == "client") {}

                    return $reparation;

                } else {
                    throw new \Exception("No reparation found with ID " . $idReparation);
                }

            } else {
                throw new \Exception("Error preparing the GET SQL statement");
            }

        } finally {
            if(isset($stmt)) {
                $stmt->close();
            }

            if(isset($mysqli)) {
                $mysqli->close();
            }
        }
    }


    public function insertReparation() {

    }
}