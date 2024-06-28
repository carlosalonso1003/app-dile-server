<?php

// Habilitar CORS para cualquier origen
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization");

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Manejar la solicitud preflight
    http_response_code(200);
    exit();
}

if($method == 'GET' && $request == '/api-json-user/api/list_cargo'){
    require_once "controller/Cargo_controller.php";
    $contro_cargo=new CargoController();
    $list_cargo=$contro_cargo->listCargos();
    if($list_cargo){
        json_encode($list_cargo);
    }
}else if ($method == 'GET' && $request == '/api-json-user/api/list_departamentos') {
    require_once "controller/Departamento_controller.php";
    $contro_dpto=new DepartamentoController();
    $list_dpto=$contro_dpto->listDepartamentos();
    if($list_dpto){
        json_encode($list_dpto);
    }
}else if($method=='GET' && $request=='/api-json-user/api/list_agencias'){
    require_once "controller/Agencia_controller.php";
    $contro_agencia=new AgenciaController();
    $list_age=$contro_agencia->listAgencias();
    if($list_age){
        json_encode($list_age);
    }
}else if($method=='GET' && $request=='/api-json-user/api/list_user'){
    require_once "controller/User_controller.php";
    $control_userSD=new UserController();
    $lis_u=$control_userSD->List_userC();
    if($lis_u){
        json_encode($lis_u);
    }
}
/**METHODOS POST */ 
else if($method=='POST' && $request=='/api-json-user/api/buscarPersonal'){
    $data=json_decode(file_get_contents("php://input",true));

    if(isset($data->dni,$data->ape_pat) && !empty($data->dni) && !empty($data->ape_pat)){
        $dni=$data->dni;
        $ape_pat=$data->ape_pat;
        require_once "controller/Personal_controller.php";
        $controlPerso=new PersonalController();
        $persona=$controlPerso->BuscarPersonalC($dni,$ape_pat);
        $dec_perfil=json_decode($persona);
        echo json_encode($dec_perfil);
    }
}
else if($method=='POST' && $request=='/api-json-user/api/login'){
    $data=json_decode(file_get_contents("php://input",true));
    
    if(isset($data->user,$data->pass) &!empty($data->user) && !empty($data->pass)){
        $user=$data->user;
        $pass=$data->pass;
        require_once "controller/Login_controller.php";
        $controller=new LoginController();
        $auteticado=$controller->LoginUserC($user,$pass);
        $valida=json_decode($auteticado,true);
        if($valida[0]['status']==1){
            echo json_encode($valida);
        }else{
            echo json_encode($valida);
        }
    }else{
        $info[]=array('message'=>"ingrese_datos");
        echo json_encode($info);
    }
}else if($method=='POST' && $request=='/api-json-user/api/miPerfil'){
    $data=json_decode(file_get_contents("php://input",true));
    if(!empty($data->CUOTA_FIJA) && !empty($data->TEA_INTERES) && !empty($data->MONTO_PRESTAMO)
    && !empty($data->EDAD)){
        $cuo_fija=$data->CUOTA_FIJA;
        $tea_interes=$data->TEA_INTERES;
        $monto_pre=$data->MONTO_PRESTAMO;
        $edad=$data->EDAD;

        require_once "controller/perfil_controller.php";

        $perfil=new PerfilController();
        $per=$perfil->BuscarPerfil($cuo_fija,$tea_interes,$monto_pre,$edad);
        $dec_perfil=json_decode($per);
        echo json_encode($dec_perfil);
}
} else if($method=='POST' && $request=='/api-json-user/api/create_user'){
    $data=json_decode(file_get_contents("php://input",true));
    if(!empty($data->DNI) && !empty($data->NOMBRE) && !empty($data->APE_PAT) 
    && !empty($data->APE_MAT) && !empty($data->AGENCIA) && !empty($data->CARGO) 
    && !empty($data->DEPARTAMENTO) && !empty($data->PASS)
    && !empty($data->CLUBFAMILIA) && !empty($data->EXPEDIENTES) && !empty($data->GEODILE) ){
        $dni=$data->DNI;
        $nombre=$data->NOMBRE;
        $ape_pat=$data->APE_PAT;
        $ape_mat=$data->APE_MAT;
        $nom_agencia=$data->AGENCIA;
        $nom_cargo=$data->CARGO;
        $nom_dpto=$data->DEPARTAMENTO;
        $password=$data->PASS;
        $p_clubfamilia=$data->CLUBFAMILIA;
        $p_expediente=$data->EXPEDIENTES;
        $p_geodile=$data->GEODILE;

        require_once "controller/User_controller.php";

        $user=new UserController();
        $valida=$user->ValidaUserNew($dni,$password,$nombre,$ape_pat,$ape_mat,$nom_agencia,$nom_cargo,$nom_dpto,$p_clubfamilia,$p_expediente,$p_geodile);
        $dec_valida=json_decode($valida);
        echo json_encode($dec_valida);
    }
}
else {
    http_response_code(404);
    echo json_encode(array("mensaje" => "Ruta no encontrada"));
}
?>
