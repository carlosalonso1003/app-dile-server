<?php
$baseDir = dirname(__DIR__);
$modelPath = $baseDir . '/config/Conexion.php';
require_once $modelPath;

class InsertDepartamentos extends Conexion {
    public function insertarDatos() {
        $departamentos = [
            ["COD_DPTO" => "01", "NOM_DPTO" => "GERENCIA GENERAL"],
            ["COD_DPTO" => "02", "NOM_DPTO" => "ADMINISTRACION"],
            ["COD_DPTO" => "03", "NOM_DPTO" => "DPTO. DE CONTABILIDAD"],
            ["COD_DPTO" => "04", "NOM_DPTO" => "AUDITORIA INTERNA"],
            ["COD_DPTO" => "05", "NOM_DPTO" => "UNIDAD DE RIESGOS"],
            ["COD_DPTO" => "06", "NOM_DPTO" => "DPTO.DE CREDITOS"],
            ["COD_DPTO" => "07", "NOM_DPTO" => "COBRANZA ADMINISTRATIVA"],
            ["COD_DPTO" => "08", "NOM_DPTO" => "COBRANZA JUDICIAL"],
            ["COD_DPTO" => "09", "NOM_DPTO" => "DPTO. DE OPERACIONES"],
            ["COD_DPTO" => "10", "NOM_DPTO" => "ADMISION DE SOCIOS"],
            ["COD_DPTO" => "11", "NOM_DPTO" => "SISTEMAS E INFORMATICA"],
            ["COD_DPTO" => "12", "NOM_DPTO" => "CONSEJO DE ADMINISTRACION"],
            ["COD_DPTO" => "13", "NOM_DPTO" => "CONSEJO DE VIGILANCIA"],
            ["COD_DPTO" => "14", "NOM_DPTO" => "COMITE DE EDUCACION"],
            ["COD_DPTO" => "15", "NOM_DPTO" => "COMITE ELECTORAL"],
            ["COD_DPTO" => "16", "NOM_DPTO" => "ASESORIA LEGAL"],
            ["COD_DPTO" => "17", "NOM_DPTO" => "MARKETING"],
            ["COD_DPTO" => "18", "NOM_DPTO" => "PLANIFICACION Y DESARROLLO"],
            ["COD_DPTO" => "19", "NOM_DPTO" => "RECURSOS HUMANOS"],
            ["COD_DPTO" => "20", "NOM_DPTO" => "DPTO. DE RECUPERACIONES"],
            ["COD_DPTO" => "21", "NOM_DPTO" => "MANTENIMIENTO"]
        ];

        try {
            $conexion = parent::conectar();
            $collection = $conexion->departamentos;
            $result = $collection->insertMany($departamentos);
            return json_encode(['insertedIds' => $result->getInsertedIds()]);
        } catch (\Throwable $th) {
            return json_encode(['error' => $th->getMessage()]);
        }
    }
}

// Ejecutar la inserción
$insertDepartamentos = new InsertDepartamentos();
echo $insertDepartamentos->insertarDatos();
?>