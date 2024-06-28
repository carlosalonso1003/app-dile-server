<?php
$baseDir = dirname(__DIR__);
$modelPath = $baseDir . '/Model/Cargo_model.php';

require_once $modelPath;

class CargoController{

    public function listCargos(){
        $listcargo=new Crud_Cargo();
        $cargo=$listcargo->mostrarCargos();
        $response=json_decode($cargo,true);
        echo json_encode($response);
    }
}
?>