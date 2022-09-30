<?php
include_once("../modelo/modRol.php");
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data)) {
//    $nombre=filter_var($data['nombre'],FILTER_SANITIZE_STRING);
    if (isset($data['nombreRol'])) {
        $nombreRol = htmlspecialchars($data['nombreRol']);
    } else {
        echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "Falta el nombre"));
        die();
    }
    //Instancia modelo persona y asignacion
    $modPer = new modRol();
    $modPer->set('nombreRol', $nombreRol);
    //registro BD
    echo $modPer->registrarRol();
} else {
    echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "No se envio datos"));
}

