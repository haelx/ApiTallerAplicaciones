<?php
include_once("../modelo/modNoticia.php");
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data)) {
//    $titulo=filter_var($data['titulo'],FILTER_SANITIZE_STRING);
    if (isset($data['titulo'])) {
        $titulo = htmlspecialchars($data['titulo']);
    } else {
        echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "Falta el titulo"));
        die();
    }
    if (isset($data['descripcionCorta'])) {
        $descripcionCorta = htmlspecialchars($data['descripcionCorta']);
    } else {
        echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "Falta la descripcion corta"));
        die();
    }
    if(isset($data['descripcionLarga'])){
        $descripcionLarga=htmlspecialchars($data['descripcionLarga']);
    }else{
        $descripcionLarga="";
    }
    if(isset($data['foto'])){
        $foto=htmlspecialchars($data['foto']);
    }else{
        $foto="";
    }
    if(isset($data['fechaPublicacion'])){
        $fechaPublicacion=htmlspecialchars($data['fechaPublicacion']);
    }else{
        $fechaPublicacion="";
    }
    if(isset($data['idCategoria'])){
        $idCategoria=htmlspecialchars($data['idCategoria']);
    }else{
        echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "Falta la categoria"));
        die();
    }
    //Instancia modelo persona y asignacion
    $modNot=new modNoticia();
    $modNot->set('titulo',$titulo);
    $modNot->set('descripcionCorta',$descripcionCorta);
    $modNot->set('descripcionLarga',$descripcionLarga);
    $modNot->set('foto',$foto);
    $modNot->set('fechaPublicacion',$fechaPublicacion);
    $modNot->set('idCategoria',$idCategoria);
    //registro BD
    echo $modNot->registrarNoticia();
} else {
    echo json_encode(array("success" => 0, "error" => 1, "mensaje" => "No se envio datos"));
}


