<?php
include_once ('../modelo/conexionBase.php');
$conx=new conexionBase();
$query = "select * from rol";
$conx->CreateConnection();
$result = $conx->ExecuteQuery($query);
if ($result) {
    $RowCount = $conx->GetCountAffectedRows();
    if ($RowCount > 0) {
        $datos = array();
        while ($row = $conx->GetRows($result)) {
            $datos []= ['id' => $row[0], 'name' => $row[1]];
        }
        echo json_encode($datos,JSON_UNESCAPED_UNICODE);
    } else {
        $this->NewConn->CloseConnection();
        echo json_encode(array('success' => 0, 'error' => 1, 'mensaje' => 'Algo Salio Mal'));
    }
} else {
    return json_encode(array("success" => 0, "error" => 1, "mensaje" => "Error en la consulta busqueda rol"));
}
