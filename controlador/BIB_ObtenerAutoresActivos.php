<?php
require_once "../modelo/modelo.php";
require_once "../configuracion/conexion.php";

try{
    if(!isset($_POST["pInicio"]) || !isset($_POST["pCantidad"])){
        http_response_code(400);
        echo '';
        exit;
    }

    $modelo = new Modelo();    
    $funcion = $modelo->BIB_ObtenerAutoresActivos($_POST["pInicio"], $_POST["pCantidad"], $_POST["pFiltro"]);
    $result = "";
    $contador = $_POST["pInicio"];
    while ($row = $funcion->fetch(PDO::FETCH_ASSOC)) {
        $idCodificado = base64_encode($row['IdAutor']);
        $result .= "<tr>";
        $result .= "<td>" . htmlspecialchars($contador) . "</td>";
        $result .= "<td>" . strtoupper(htmlspecialchars($row['Nombre'])) . "</td>";
        $result .= "<td>" . strtoupper(htmlspecialchars($row['Apellido'])) . "</td>";
        $result .= "<td>" . strtoupper(htmlspecialchars($row['Nacionalidad'])) . "</td>";
        $result .= "<td>" . htmlspecialchars($row['FechaNacimiento']) . "</td>";
        $result .= '<td class="text-end">
            <button class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#modal-autor" onclick="BIB_ObtenerAutorPorId(\''.$idCodificado.'\')">
                 <i class="bi bi-pencil"></i>
            </button>
            <button class="btn btn-sm btn-outline-danger" onclick="BIB_EliminarAutorPorId(\''.$idCodificado.'\')">
                <i class="bi bi-trash"></i>
            </button>
        </td>';
        $result .= "</tr>";
        $contador++;
    }
    echo $result;
} catch(Exception $e){
    http_response_code($e->getCode() ?: 500);
    echo json_encode
    ([
        "Codigo"=>$e->getCode(), 
        "Tipo"=>"error", 
        "Mensaje"=>$e->getMessage()
    ]);
}