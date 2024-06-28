<?php
$baseDir = dirname(__DIR__);
$modelPath = $baseDir . '/config/Conexion.php';
require_once $modelPath;

class Crud_Agencia extends Conexion{

    public function mostrarAgencia(){
        try {
            $conexion=parent::conectar();
            $collections=$conexion->agencias;
            $datos=$collections->find()->toArray();
            header('Content-Type: application/json');
            return json_encode($datos);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function SeleccionarAgencia(){
        
    }
}
?>