<?php
$baseDir = dirname(__DIR__);
$modelPath = $baseDir . '/config/Conexion.php';
require_once $modelPath;

class Crud_Departamento extends Conexion{

    public function mostrarDepartamentos(){
        try {
            $conexion=parent::conectar();
            $collections=$conexion->departamentos;
            $datos=$collections->find()->toArray();
            header('Content-Type: application/json');
            return json_encode($datos);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}

?>