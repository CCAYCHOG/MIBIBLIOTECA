<?php
require_once "../modelo/modelo.php";
require_once "../configuracion/conexion.php";

header('Content-Type: application/json');
try{
    if(!isset($_POST["IdAutor"]) || !isset($_POST['usuario'])){
        http_response_code(400);
        echo json_encode
        ([
            "Codigo"=>400, 
            "Tipo"=>"error", 
            "Mensaje"=>"No se ha recibio los parametros de para ejecutar el borrado."
        ]);
        exit;
    }

    $modelo = new Modelo();    
    $funcion = $modelo->BIB_EliminarAutorPorId(base64_decode($_POST['IdAutor']), $_POST['usuario'], $_SERVER['REMOTE_ADDR']);
    $result = [];
    while ($row = $funcion->fetch(PDO::FETCH_ASSOC)) {
        $result[] = $row;
    }
    echo json_encode($result);
} catch(Exception $e){
    http_response_code($e->getCode() ?: 500);
    echo json_encode
    ([
        "Codigo"=>$e->getCode(), 
        "Tipo"=>"error", 
        "Mensaje"=>$e->getMessage()
    ]);
}