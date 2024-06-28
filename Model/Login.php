<?php
$baseDir = dirname(__DIR__);
$modelPath = $baseDir . '/config/Conexion.php';
require_once $modelPath;

class LoginM extends Conexion{
    public function LoginUserM($user,$pass){
        try {
            $conexion=parent::conectar();
            $check_user=$conexion->user;
            $user_l=$check_user->findOne(['user'=>$user]);
            if($user_l){
                if(password_verify($pass,$user_l['pass'])){
                    $response=array('success' => true, 'message' => 'verificado');
                    http_response_code(200);
                }else{
                    $response=array('success' => false, 'message' => 'contraseña_incorrecta');
                    http_response_code(401);
                }

            }else{
                $response = array('success' => false, 'message' => 'Usuario no encontrado');
                http_response_code(404);
            }
        } catch (error $th) {
            //
        }
        header('Content-Type: application/json');
        return json_encode($response);
    }

    public function user_info($user){
        try {
            $conexion=parent::conectar();
            $user_info=$conexion->info_user;
            $datos=$user_info->findOne(['DNI'=>$user]);
            if($datos){
                return json_encode($datos);
            }
        } catch (\Throwable $th) {
            //
        }
        header('Content-Type: application/json');
    }

    public function cargar_menu($user){
        try {
            $conexion=parent::conectar();
            $menu_info=$conexion->info_menu;
            $menu=$menu_info->findOne(['user'=>$user]);
            if($menu){
                return json_encode($menu);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        header('Content-Type: application/json');
    }

    public function crearLogin($user,$fecha,$hora,$ip,$dispositivo){
        $conexion=parent::conectar();
        $create_login=$conexion->control_login;
        $crt_l=$create_login.insertOne([
            'user'=>$user,
            'fecha'=>$fecha,
            'hora'=>$hora,
            'ip'=>$ip,
            'dispositivo'=>$dispositivo]);
        if($crt_l){
            $response=array('success' => true, 'message' => 'insertado');
            http_response_code(200);
        }else{
            $response=array('success' => true, 'message' => 'no insertado');
            http_response_code(401);
        }
    }
}
?>