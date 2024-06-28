<?php
$baseDir = dirname(__DIR__);
$modelPath = $baseDir . '/config/Conexion.php';
require_once $modelPath;

class Crud_Cargo extends Conexion{

    public function mostrarCargos(){
        try {
            $conexion=parent::conectar();
            $collections=$conexion->cargo;
            $datos=$collections->find()->toArray();
            header('Content-Type: application/json');
            return json_encode($datos);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
?>