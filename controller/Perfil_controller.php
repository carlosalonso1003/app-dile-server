<?php
$baseDir = dirname(__DIR__);
$modelPath = $baseDir . '/Model/Perfil_model.php';

require_once $modelPath;

class PerfilController{

    public function BuscarPerfil($cuo_fija,$tea_interes,$monto_pre,$edad){
        $buscarPerfil=new Buscar_Perfil();
        $cuotaP=(ceil($cuo_fija/50))*50; 
        $montoP=(ceil($monto_pre/200))*200;
        $tea_pro=ceil($tea_interes);
        $edad_p=ceil($edad);
        $perfil=$buscarPerfil->BuscarPerfilIn($cuotaP,$tea_pro,$montoP,$edad_p);
        $response=json_decode($perfil,true);
        if($response[0]['riesgo']>0 && $response[0]['riesgo']<=0.25 ){
            $riesgo_t="BUENO";
            $list[]=array(
                "status"=>true,
                "riesgo"=>$riesgo_t
            );
        }else if($response[0]['riesgo']>0.25 && $response[0]['riesgo']<=0.5){
            $riesgo_t="REGULAR";
            $list[]=array(
                "status"=>true,
                "riesgo"=>$riesgo_t
            );
        }else{
            $riesgo_t="MALO";
            $list[]=array(
                "status"=>true,
                "riesgo"=>$riesgo_t
            );
        }
        
        return json_encode($list);
    }
}
?>
