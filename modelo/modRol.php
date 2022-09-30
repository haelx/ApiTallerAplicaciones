<?php

include_once("conexionBase.php");

class modRol
{
    private $nombreRol;
    private $conx;

    function __construct()
    {
        $this->nombreRol = "";
        $this->conx = new conexionBase();
    }

    public function set($key, $valor)
    {
        $this->$key = $valor;
    }

    private function verificarRolExistente()
    {
        $query="select * from rol where nombreRol='$this->nombreRol'";
        $this->conx->CreateConnection();
        $result = $this->conx->ExecuteQuery($query);
        if ($result) {
            $RowCount = $this->conx->GetCountAffectedRows();
            if ($RowCount > 0) {
                $row = $this->conx->GetRows($result);
                return json_encode(array("success"=>0,"error"=>1,"mensaje"=>"Rol ya existente","permitido"=>0));
            } else {
                return 1;
            }
        } else {
            return json_encode(array("success"=>0,"error"=>1,"mensaje"=>"Error en la consulta"));
        }
    }

    public function registrarRol()
    {
        $ver=$this->verificarRolExistente();
        if($ver==1) {
            $query = "insert into rol set nombreRol='$this->nombreRol'";
            $this->conx->CreateConnection();
            $result = $this->conx->ExecuteQuery($query);
            if ($result) {
                $RowCount = $this->conx->GetCountAffectedRows();
                if ($RowCount > 0) {
                    //registro correcto
                    return json_encode(array("success"=>1,"error"=>0,"mensaje"=>"Rol registrado correctamente"));
                } else {
                    return json_encode(array("success"=>0,"error"=>1,"mensaje"=>"Error al registrar"));
                }
            } else {
                return json_encode(array("success"=>0,"error"=>1,"mensaje"=>"Error en la consulta"));
            }
        }
        else{
            return $ver;
        }

    }
}