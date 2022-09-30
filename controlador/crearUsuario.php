<?php
include_once("../modelo/modUsuario.php");
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data)) {
//    $nombre=filter_var($data['nombre'],FILTER_SANITIZE_STRING);
    if (isset($data['usuario'])) {
        $usuario = htmlspecialchars($data['usuario']);
    } else {
        echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "Falta el nombre de usuario"));
        die();
    }
    if (isset($data['clave'])) {
        $clave = htmlspecialchars($data['clave']);
    } else {
        echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "Falta la clave"));
        die();
    }
    if (isset($data['idPersona'])) {
        $idPersona = htmlspecialchars($data['idPersona']);
    } else {
        echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "Falta el id de la persona"));
        die();
    }
    if (isset($data['idRol'])) {
        $idRol = htmlspecialchars($data['idRol']);
    } else {
        echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "Falta el id del rol"));
        die();
    }
    //Instancia modelo persona y asignacion
    $mod=new modUsuario();
    //registro BD
    $mod->set('usuario',$usuario);
    $mod->set('clave',$clave);
    $mod->set('idPersona',$idPersona);
    $mod->set('idRol',$idRol);
    echo $mod->registrarUsuario();
} else {
    echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "No se envio datos"));
}

