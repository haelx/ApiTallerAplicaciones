<?php
include_once ("conexionBase.php");
class validacion{
private $token;
private $usuario;
private $conx;

    function __construct()
    {
        $this->token = "";
        $this->usuario = "";
        $this->conx = new conexionBase();
    }
    public function set($key, $valor)
    {
        $this->$key = $valor;
    }
    public function validarTransaccion(){
        $query="select token from usuario where usuario='$this->usuario' and token='$this->token'";
        $this->conx->CreateConnection();
        $result = $this->conx->ExecuteQuery($query);
        if ($result) {
            $RowCount = $this->conx->GetCountAffectedRows();
            if ($RowCount > 0) {
                $row = $this->conx->GetRows($result);
//                echo json_encode(array("success"=>1,"error"=>0,"token"=>$row[0]));
                return 0;
            }
            else{
                return 1;
//                echo json_encode(array("success"=>0,"error"=>1,"mensaje"=>"El usuario no tiene Api"));
            }
        }
        else{
            return 1;
//            echo json_encode(array("success"=>0,"error"=>1,"mensaje"=>"No tiene acceso a la Api"));
        }
    }
}