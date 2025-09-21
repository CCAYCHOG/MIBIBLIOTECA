<?php
require_once "../modelo/modelo.php";
require_once "../configuracion/conexion.php";

header('Content-Type: application/json');
try{
    if(!isset($_POST["IdAutor"])){
        http_response_code(400);
        echo json_encode
        ([
            "Codigo"=>400, 
            "Tipo"=>"error", 
            "Mensaje"=>"No se ha recibio el parametro de búsqueda."
        ]);
        exit;
    }

    $modelo = new Modelo();    
    $funcion = $modelo->BIB_ObtenerAutorPorId(base64_decode($_POST['IdAutor']));
    $result = [];
    while ($row = $funcion->fetch(PDO::FETCH_ASSOC)) {
        $result[] = $row;
    }

    $response = [
        "Tipo" => "success",
        "Codigo" => 200,
        "Datos" => $result,
        "Mensaje" => "Consulta ejecutada correctamente"
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
} catch(Exception $e){
    http_response_code($e->getCode() ?: 500);
    echo json_encode
    ([
        "Codigo"=>$e->getCode(), 
        "Tipo"=>"error", 
        "Mensaje"=>$e->getMessage()
    ]);
}