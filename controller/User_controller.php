<?php
$baseDir=dirname(__DIR__);
$modelPath=$baseDir .'/model/User_model.php';

require_once $modelPath;

class UserController{

    public function ValidaUserNew($dni,$pass,$nombre,$ape_pat,$ape_mat,$nom_agencia,$nom_cargo,$nom_dpto,$p_clubfamilia,$p_expediente,$p_geodile){
        $user=new Crud_User();
        $validaU=$user->ValidarUserM($dni);
        $ext_U=json_decode($validaU,true);
        if($ext_U['message']=='existe'){
            $datos[]=array(
                "status"=>false,
                "message"=>"existe"
            );
            return json_encode($datos);
        }else{
            $this->addUserC($dni,$pass);
            $this->addInfoUserC($dni,$nombre,$ape_pat,$ape_mat,$nom_agencia,$nom_cargo,$nom_dpto);
            $this->addinfoMenuC($dni,$p_clubfamilia,$p_expediente,$p_geodile);
            $datos[]=array(
                "status"=>true,
                "message"=>"user_add"
            );
            return json_encode($datos);
        }
    }
    
    /**CONTROLER PARA AGREGAR DATOS A LA COLLECTION USER user-pass-dni-fecha_crea-estado */
    public function addUserC($dni,$pass){
        $user=new Crud_User();
        $addU=$user->AddUserM($dni,$pass);
        return json_encode($addU);
    }

    /**CONTROLLER PARA AGREGAR DATOS A LA COLLECTION INFO_USER  dni-nombre-ape_pat-ape_mat-agencia-cargo-departamento*/
    public function addInfoUserC($dni,$nombre,$ape_pat,$ape_mat,$nom_agencia,$nom_cargo,$nom_dpto){
        $user=new Crud_User();
        $addInfoU=$user->AddInfoUserM($dni,$nombre,$ape_pat,$ape_mat,$nom_agencia,$nom_cargo,$nom_dpto);
        return json_encode($addInfoU);
    }

    /**CONTROLLER PARA AGREGAR DATOS A LA COLLECTION INFO_MENU  user-menu{clubfamilia-expedientes-geodile}*/
    public function addinfoMenuC($dni,$p_clubfamilia,$p_expediente,$p_geodile){
        $menu=new Crud_User();
        $addMenu=$menu->AddInfoMenuM($dni,$p_clubfamilia,$p_expediente,$p_geodile);
        return json_encode($addMenu);
    }

    public function List_userC(){
        $user=new Crud_User();
        $listUs=$user->listUser();
        $listIn_Us=$user->listInfo_User();
        $listIn_Me=$user->listInfo_Menu();
        $response_u=json_decode($listUs,true);
        $response_iu=json_decode($listIn_Us,true);
        $response_im=json_decode($listIn_Me,true);

        if($response_iu){
            for($i=0;$i<count($response_iu);$i++){
                $list[]=array(
                    "DNI"=>$response_iu[$i]['DNI'],
                    "NOM_COM"=>$response_iu[$i]['NOMBRE'].' '.$response_iu[$i]['APE_PAT'].' '.$response_iu[$i]['APE_MAT'],
                    "NOMBRE"=>$response_iu[$i]['NOMBRE'],
                    "APE_PAT"=>$response_iu[$i]['APE_PAT'],
                    "APE_MAT"=>$response_iu[$i]['APE_MAT'],
                    "AGENCIA"=>$response_iu[$i]['AGENCIA'],
                    "DEPARTAMENTO"=>$response_iu[$i]['DEPARTAMENTO'],
                    "CARGO"=>$response_iu[$i]['CARGO'],
                    "USER"=>$response_u[$i]['user'],
                    "ESTADO"=>$response_u[$i]['estado'],
                    "FECHA"=>$response_u[$i]['fecha_crea'],
                    "HORA"=>isset($response_u[$i]['hora_crea']) ? $response_u[$i]['hora_crea'] : 'Hora no disponible'
                );
            }
            $resultados = array(
                "sEcho" => 1,
                "iTotalRecords" => count($list),
                "iTotalDisplayRecords" => count($list),
                "data" => $list
            );
        }
        echo json_encode($resultados);
    }
}

?>