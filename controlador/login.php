<?php
include_once("../modelo/modLogin.php");
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data)) {
    if (isset($data['usuario'])) {
        $usuario = htmlspecialchars($data['usuario']);
    } else {
        echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "Falta el nombre de usuario"));
        die();
    }
    if (isset($data['clave'])) {
        $clave = htmlspecialchars($data['clave']);
    } else {
        echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "Falta el nombre de usuario"));
        die();
    }
    //Instancia modelo persona y asignacion
    $mod = new modLogin();
    //registro BD
    $mod->set('usuario', $usuario);
    $mod->set('clave', $clave);
    $mod->registrarUsuario();
} else {
    echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "No se envio datos"));
}

