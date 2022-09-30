<?php
include_once('../modelo/conexionBase.php');
$conx = new conexionBase();
$query = "select idnoticia,titulo,descripcionCorta,foto from noticia join publicacion p on noticia.idnoticia = p.noticia_idnoticia join categoria c on c.idcategoria = p.categoria_idcategoria";
$conx->CreateConnection();
$result = $conx->ExecuteQuery($query);
if ($result) {
    $RowCount = $conx->GetCountAffectedRows();
    if ($RowCount > 0) {
        $datos = array();
        while ($row = $conx->GetRows($result)) {
            $datos [] = ['idNoticia' => $row[0], 'titulo' => $row[1],'descripcionCorta'=>$row[2],'foto'=>$row[3]];
        }
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        $this->NewConn->CloseConnection();
        echo json_encode(array('success' => 0, 'error' => 1, 'mensaje' => 'Algo Salio Mal'));
    }
} else {
    return json_encode(array("success" => 0, "error" => 1, "mensaje" => "Error en la consulta busqueda rol"));
}
