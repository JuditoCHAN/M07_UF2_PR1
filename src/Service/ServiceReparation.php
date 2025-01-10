<?php
namespace Src\Service;

require_once '../Model/Reparation.php';
require_once '../../vendor/autoload.php'; //carga automáticamente las clases de las bibliotecas instaladas con Composer

use Src\Model\Reparation;
use Ramsey\Uuid\Uuid;


if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

class ServiceReparation {

    public function connect(): \mysqli {
        //lee la configuracion de la db de un archivo ini
        $db = parse_ini_file(__DIR__ . "/../../conf/db_config.ini");

        //creamos conexion con la base de datos
        $mysqli = new \mysqli($db["host"], $db["user"], $db["pwd"], $db["db_name"]);

        if($mysqli->connect_errno) {
            //die();
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
                $stmt->bind_param("s", $idReparation); //bind parameter values: asocias los placeholders (?)con los valores de los parametros
                $stmt->execute(); //los envias al servidor
                $result = $stmt->get_result(); //objeto mysqli_result que contiene las filas devueltas por la consulta

                if($result->num_rows > 0) {
                    $row = $result->fetch_assoc(); //array asociativo que representa la fila de la db
                    
                    $reparation = new Reparation($row['reparationID'], $row['workshopID'], $row['workshopName'], $row['registerDate'], $row['licensePlate']);
                    
                    //enmascarar imagen
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


    public function insertReparation($workshopID, $workshopName, $registerDate, $licensePlate) {
        $reparationID = Uuid::uuid4();

        //estblecemos la conexión y realizamos la query mediante prepared statement
        $mysqli = $this->connect();

        try {
            $stmt = $mysqli->prepare("INSERT INTO Reparation (reparationID, workshopID, workshopName, registerDate, licensePlate) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sisss", $reparationID, $workshopID, $workshopName, $registerDate, $licensePlate);
            $stmt->execute();

            return $reparationID;
            //return "Reparation added successfully!";

        } catch (\Exception $e) {
            //return "Error adding reparation";

        } finally {
            if(isset($stmt)) {
                $stmt->close();
            }

            if(isset($mysqli)) {
                $mysqli->close();
            }
        }
    }
}