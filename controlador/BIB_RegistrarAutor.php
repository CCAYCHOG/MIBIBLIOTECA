<?php
require_once "../modelo/modelo.php";
require_once "../configuracion/conexion.php";

header('Content-Type: application/json');
try{  
    if (!isset($_POST['datos'])) {
        http_response_code(400);
        echo json_encode
        ([
            "Tipo" => 'error',
            "Mensaje" => 'No se recibieron datos del autor.',
            "Codigo" => 400
        ]);
        exit;
    }
    $datos = $_POST['datos'];
    if (empty($datos['nombre_autor']) || empty($datos['apellido_autor'])) {
        echo json_encode
        ([
            "Tipo"=>'error',
            "Mensaje"=>'¡Los apellidos y nombres deben estar completos!',
            "Codigo"=>500
        ]);
        exit;
    }
    $modelo = new Modelo();    
    $funcion = $modelo->BIB_RegistrarAutor(
        $datos['nombre_autor'], $datos['apellido_autor'], $datos['nacionalidad_autor'], $datos['fnacimiento_autor'],
        $datos['estado_autor'], $datos['usuario'], $_SERVER['REMOTE_ADDR']
    );
    $result = [];
    while ($row = $funcion->fetch(PDO::FETCH_ASSOC)) {
        $result[] = [
            "Tipo"    => $row['Tipo'] ?? null,
            "Mensaje" => $row['Mensaje'] ?? null,
            "Codigo"  => $row['Codigo'] ?? null,
            "Datos"  => base64_encode($row['Datos']) ?? null
        ];
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