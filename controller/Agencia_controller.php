<?php
$baseDir=dirname(__DIR__);
$modelPath=$baseDir .'/model/Agencia_model.php';

require_once $modelPath;

class AgenciaController{

    public function listAgencias(){
        $listage=new Crud_Agencia();
        $agencia=$listage->mostrarAgencia();

        $response=json_decode($agencia,true);
        echo json_encode($response);
    }

}

?>