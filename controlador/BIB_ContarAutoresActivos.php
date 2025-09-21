<?php
require_once "../modelo/modelo.php";
require_once "../configuracion/conexion.php";

header('Content-Type: application/json');
try{  
    $modelo = new Modelo();    
    $funcion = $modelo->BIB_ContarAutoresActivos();
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