<?php
$baseDir = dirname(__DIR__);
$modelPath = $baseDir . '/Model/Login.php';

require_once $modelPath;

class LoginController{

    public function LoginUserC($user,$pass){
        $logged=new LoginM();
        $socio=$logged->LoginUserM($user,$pass);

        $response=json_decode($socio,true);
        if($response['message']=='verificado'){
            $info_user=$logged->user_info($user);
            $dec_inf_user=json_decode($info_user,true);
            //echo json_encode($dec_inf_user);
            if($dec_inf_user){
                $info_menu=$logged->cargar_menu($user);
                $dec_inf_menu=json_decode($info_menu,true);
                $datos[]=array(
                    "status"=>true,
                    "DNI"=>$dec_inf_user['DNI'],
                    "NOMBRE"=>$dec_inf_user['NOMBRE'],
                    "APE_PAT"=>$dec_inf_user['APE_PAT'],
                    "APE_MAT"=>$dec_inf_user['APE_MAT'],
                    "AGENCIA"=>$dec_inf_user['AGENCIA'],
                    "CARGO"=>$dec_inf_user['CARGO'],
                    "DEPARTAMENTO"=>$dec_inf_user['DEPARTAMENTO'],
                    "club_familia"=>$dec_inf_menu['menu'][0]['clubfamilia'],
                    "expediente"=>$dec_inf_menu['menu'][0]['expediente'],
                    "geo_dile"=>$dec_inf_menu['menu'][0]['geodile'],
                );
            }
            return json_encode($datos);
        }else if($response['message']=='contraseña_incorrecta'){
            $datos[]=array(
                "status"=>false,
                "message"=>"no_verificado"
            );
            return json_encode($datos);
        }
    }
}
?>