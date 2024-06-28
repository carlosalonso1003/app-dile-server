<?php
$baseDir = dirname(__DIR__);
$modelPath = $baseDir . '/config/Conexion.php';
require_once $modelPath;

class Buscar_Personal extends Conexion{

    public function BuscarPersonalM($dni,$ape_pat){
        try {
            $conexion=parent::conectar();
            $collections=$conexion->info_user;
            $datos=$collections->find(['DNI'=>$dni,'APE_PAT'=>$ape_pat])->toArray();
            header('Content-Type: application/json');
            return json_encode($datos);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
?>