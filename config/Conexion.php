<?php
$baseDir = dirname(__DIR__);
$modelPath = $baseDir . '/vendor/autoload.php';
require_once $modelPath;

class Conexion {
    public function conectar() {
        try {
            $SERVER = "127.0.0.1";
            $USER = "AdminMongito";
            $PASSWORD = "pass";
            $DATABASE = "app-dile";
            $PORT = "27017";

            $cadenaC = "mongodb://" . $USER . ":" . $PASSWORD . "@" . $SERVER . ":" . $PORT . "/?authSource=" . $DATABASE;

            // Crear una nueva instancia del cliente MongoDB
            $client = new MongoDB\Client($cadenaC);

            // Seleccionar la base de datos
            $db = $client->selectDatabase($DATABASE);
            return $db;
        } catch (MongoDB\Driver\Exception\Exception $e) {
            // Capturar excepciones específicas de MongoDB
            return "Error de MongoDB: " . $e->getMessage();
        } catch (\Throwable $th) {
            // Capturar cualquier otra excepción
            return "Error general: " . $th->getMessage();
        }
    }
}

?>