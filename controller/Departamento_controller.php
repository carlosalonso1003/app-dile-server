<?php
$baseDir = dirname(__DIR__);
$modelPath = $baseDir . '/Model/Departamento_model.php';

require_once $modelPath;

class DepartamentoController{

    public function listDepartamentos(){
        $listdep=new Crud_Departamento();
        $dpto=$listdep->mostrarDepartamentos();
        $response=json_decode($dpto,true);
        echo json_encode($response);
    }
}
?>