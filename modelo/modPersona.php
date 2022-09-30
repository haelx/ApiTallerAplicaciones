<?php

include_once("conexionBase.php");

class modPersona
{
    private $nombre;
    private $primerApellido;
    private $segundoApellido;
    private $email;
    private $sexo;
    private $ci;
    private $conx;

    function __construct()
    {
        $this->nombre = "";
        $this->primerApellido = "";
        $this->segundoApellido = "";
        $this->email = "";
        $this->sexo = "";
        $this->ci = "";
        $this->conx = new conexionBase();
    }

    public function set($key, $valor)
    {
        $this->$key = $valor;
    }

    private function verificarPersona()
    {
        $query="select * from persona where ci='$this->ci'";
        $this->conx->CreateConnection();
        $result = $this->conx->ExecuteQuery($query);
        if ($result) {
            $RowCount = $this->conx->GetCountAffectedRows();
            if ($RowCount > 0) {
                $row = $this->conx->GetRows($result);
                return json_encode(array("success"=>0,"error"=>1,"mensaje"=>"Persona ya existente, Ci existente"));
            } else {
                return 1;
            }
        } else {
            return json_encode(array("success"=>0,"error"=>1,"mensaje"=>"Error en la consulta"));
        }
    }

    public function registrarPersona()
    {
        $ver=$this->verificarPersona();
        if($ver==1) {
            $query = "insert into persona (nombre, primerApellido, segundoApellido, email, sexo, ci) 
values ('$this->nombre','$this->primerApellido','$this->segundoApellido','$this->email','$this->sexo','$this->ci')";
            $this->conx->CreateConnection();
            $result = $this->conx->ExecuteQuery($query);
            if ($result) {
                $RowCount = $this->conx->GetCountAffectedRows();
                if ($RowCount > 0) {
                    //registro correcto
                    return json_encode(array("success"=>1,"error"=>0,"mensaje"=>"Persona registrada correctamente"));
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