<?php
$baseDir = dirname(__DIR__);
$modelPath = $baseDir . '/config/Conexion.php';
require_once $modelPath;
class Crud_User extends Conexion{

    public function listUser(){
        try {
            $conexion=parent::conectar();
            $collections=$conexion->user;
            $datos=$collections->find()->toArray();;
            header('Content-Type: application/json');
            return json_encode($datos);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function listInfo_Menu(){
        try {
            $conexion=parent::conectar();
            $collections=$conexion->info_menu;
            $datos=$collections->find()->toArray();;
            header('Content-Type: application/json');
            return json_encode($datos);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function listInfo_User(){
        try {
            $conexion=parent::conectar();
            $collections=$conexion->info_user;
            $datos=$collections->find()->toArray();;
            header('Content-Type: application/json');
            return json_encode($datos);
        } catch (\Throwable $th) {
            //throw $th;
        }
    } 

    public function ValidarUserM($dni){
        try {
            $conexion=parent::conectar();
            $collections=$conexion->user;
            $datos=$collections->findOne(['user'=>$dni]);
            $response = isset($datos) 
            ? array('success' => false, 'message' => 'existe') 
            : array('success' => true, 'message' => 'no_existe');

            header('Content-Type: application/json');
            return json_encode($response);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function AddUserM($dni,$pass){
        try {
            $conexion=parent::conectar();
            $collections=$conexion->user;

            date_default_timezone_set('America/Lima');
            $fecha_actual=date("Y-m-d");
            $hora_actual=date("H:i:s");
            $clave_hash = password_hash($pass,PASSWORD_DEFAULT);
            /**CREAR EL DOCUMENTO USER */
            $user=[
                "user"=>$dni,
                "pass"=>$clave_hash,
                "dni"=>$dni ,
                "estado"=>"activo",
                "fecha_crea"=>$fecha_actual,
                "hora_crea"=>$hora_actual
            ];
            // Insertar el documento en la colección
            $result = $collections->insertOne($user);

            if ($result->getInsertedCount() == 1) {
                $response = array('success' => true, 'message' => 'Usuario agregado exitosamente');
            } else {
                $response = array('success' => false, 'message' => 'Error al agregar el usuario');
            }
    
            // Devolver la respuesta en formato JSON
            header('Content-Type: application/json');
            return json_encode($response);

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function AddInfoUserM($dni,$nombre,$ape_pat,$ape_mat,$nom_agencia,$nom_cargo,$nom_dpto){
        try {
            $conexion=parent::conectar();
            $collections=$conexion->info_user;

            $info_user=[
                "DNI"=>$dni,
                "NOMBRE"=>$nombre,
                "APE_PAT"=>$ape_pat,
                "APE_MAT"=>$ape_mat,
                "AGENCIA"=>$nom_agencia,
                "CARGO"=>$nom_cargo,
                "DEPARTAMENTO"=>$nom_dpto
            ];

            $result = $collections->insertOne($info_user);

            if ($result->getInsertedCount() == 1) {
                $response = array('success' => true, 'message' => 'info_user agregado exitosamente');
            } else {
                $response = array('success' => false, 'message' => 'Error al agregar la info_user');
            }
    
            // Devolver la respuesta en formato JSON
            header('Content-Type: application/json');
            return json_encode($response);

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function AddInfoMenuM($dni,$p_clubfamilia,$p_expediente,$p_geodile){
        try {
            $conexion=parent::conectar();
            $collections=$conexion->info_menu;

            $info_user = [
                'user' => $dni,
                'menu' => [
                    'clubfamilia' => [
                        ['inicio' => $p_clubfamilia]
                    ],
                    'expediente' => [
                        ['inicio' => $p_expediente]
                    ],
                    'geodile' => [
                        ['inicio' => $p_geodile]
                    ],
                    'Admin' => [
                        ['inicio' => 'desactivado']
                    ]
                ]
            ];

            // Insertar el documento en la colección
            $result = $collections->insertOne($info_user);

            // Preparar la respuesta
            if ($result->getInsertedCount() == 1) {
                $response = array('success' => true, 'message' => 'info_menu agregado exitosamente');
            } else {
                $response = array('success' => false, 'message' => 'Error al agregar el info_menu');
            }

            // Devolver la respuesta en formato JSON
            header('Content-Type: application/json');
            return json_encode($response);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
?>