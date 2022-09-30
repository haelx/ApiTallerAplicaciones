<?php
include_once("../modelo/modCategoria.php");
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data)) {
//    $nombre=filter_var($data['nombre'],FILTER_SANITIZE_STRING);
    if (isset($data['nombreCategoria'])) {
        $nombreCategoria = htmlspecialchars($data['nombreCategoria']);
    } else {
        echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "Falta el nombre"));
        die();
    }
    //Instancia modelo persona y asignacion
    $modCat = new modCategoria();
    $modCat->set('nombreCategoria', $nombreCategoria);
    //registro BD
    echo $modCat->registrarRol();
} else {
    echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "No se envio datos"));
}

