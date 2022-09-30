<?php
include_once("../modelo/modPersona.php");
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data)) {
//    $nombre=filter_var($data['nombre'],FILTER_SANITIZE_STRING);
    if (isset($data['nombre'])) {
        $nombre = htmlspecialchars($data['nombre']);
    } else {
        echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "Falta el nombre"));
        die();
    }
    if (isset($data['primerApellido'])) {
        $primerApellido = htmlspecialchars($data['primerApellido']);
    } else {
        echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "Falta el primer apellido"));
        die();
    }
    if(isset($data['segundoApellido'])){
        $segundoApellido=htmlspecialchars($data['segundoApellido']);
    }else{
        $segundoApellido="";
    }
    if(isset($data['email'])){
        $email=htmlspecialchars($data['email']);
    }else{
        $email="";
    }
    if(isset($data['sexo'])){
        $sexo=htmlspecialchars($data['sexo']);
    }else{
        $sexo="";
    }
    if(isset($data['ci'])){
        $ci=htmlspecialchars($data['ci']);
    }else{
        echo json_encode(array("success"=>0,"error"=>1,"mensaje"=>"Falta el Ci"));
        die();
    }
    //Instancia modelo persona y asignacion
    $modPer=new modPersona();
    $modPer->set('nombre',$nombre);
    $modPer->set('primerApellido',$primerApellido);
    $modPer->set('segundoApellido',$segundoApellido);
    $modPer->set('email',$email);
    $modPer->set('sexo',$sexo);
    $modPer->set('ci',$ci);
    //registro BD
   echo $modPer->registrarPersona();
} else {
    echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "No se envio datos"));
}

