<?php
include_once("conexionBase.php");
class modCategoria
{
    private $nombreCategoria;
    private $conx;

    function __construct()
    {
        $this->nombreCategoria = "";
        $this->conx = new conexionBase();
    }

    public function set($key, $valor)
    {
        $this->$key = $valor;
    }

    private function verificarRolExistente()
    {
        $query="select * from categoria where nombreCategoria='$this->nombreCategoria'";
        $this->conx->CreateConnection();
        $result = $this->conx->ExecuteQuery($query);
        if ($result) {
            $RowCount = $this->conx->GetCountAffectedRows();
            if ($RowCount > 0) {
                $row = $this->conx->GetRows($result);
                return json_encode(array("success"=>0,"error"=>1,"mensaje"=>"Categoria ya existente","permitido"=>0));
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
            $query = "insert into categoria set nombreCategoria='$this->nombreCategoria'";
            $this->conx->CreateConnection();
            $result = $this->conx->ExecuteQuery($query);
            if ($result) {
                $RowCount = $this->conx->GetCountAffectedRows();
                if ($RowCount > 0) {
                    //registro correcto
                    return json_encode(array("success"=>1,"error"=>0,"mensaje"=>"Categoria registrado correctamente"));
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
