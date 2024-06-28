<?php
$baseDir = dirname(__DIR__);
$modelPath = $baseDir . '/config/Conexion.php';
require_once $modelPath;

class Buscar_Perfil extends Conexion{

    public function BuscarPerfilIn($cuo_fija,$tea_interes,$monto_pre,$edad){
        try {
            $conexion=parent::conectar();
            $collections=$conexion->perfiles_riesgo;
            $datos=$collections->find(['CUOTA_FIJA'=>$cuo_fija,'MONTO_PRESTAMO'=>$monto_pre,'TEA_INTERES'=>$tea_interes,'EDAD'=>$edad])->toArray();
            header('Content-Type: application/json');
            return json_encode($datos);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
?>