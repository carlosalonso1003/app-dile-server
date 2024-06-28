<?php
$baseDir = dirname(__DIR__);
$modelPath = $baseDir . '/Model/Personal_model.php';

require_once $modelPath;

class PersonalController{

    public function BuscarPersonalC($dni,$ape_pat){
        $buscarPersonal=new Buscar_Personal();
        $ape_pat_M=strtoupper($ape_pat);
        $personal=$buscarPersonal->BuscarPersonalM($dni,$ape_pat_M);
        $response=json_decode($personal,true);
        if($response){
            $info_u[]=array(
                "status"=>true,
                "message"=>'correcto'
            );
        }else{
            $info_u[]=array(
                "status"=>false,
                "message"=>'incorrecto'
            );
        }
        return json_encode($info_u);
    }
}
?>
