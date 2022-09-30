<?php
include_once("conexionBase.php");

class modUsuario
{
    private $usuario;
    private $clave;
    private $token;
    private $idRol;
    private $idPersona;
    private $conx;

    function __construct()
    {
        $this->usuario = "";
        $this->clave = "";
        $this->token = "";
        $this->idRol = null;
        $this->idPersona = null;
        $this->conx = new conexionBase();
    }

    public function set($key, $valor)
    {
        $this->$key = $valor;
    }

    private function verificarUsuario()
    {
        $query = "select * from usuario where usuario='$this->usuario'";
        $this->conx->CreateConnection();
        $result = $this->conx->ExecuteQuery($query);
        if ($result) {
            $RowCount = $this->conx->GetCountAffectedRows();
            if ($RowCount > 0) {
                return json_encode(array("success" => 0, "error" => 1, "mensaje" => "Usuario ya existente"));
            } else {
                return 1;
            }
        } else {
            return json_encode(array("success" => 0, "error" => 1, "mensaje" => "Error en la consulta"));
        }
    }

    public function registrarUsuario()
    {
        $ver = $this->verificarUsuario();
        if ($ver == 1) {
            $password_segura=password_hash($this->clave, PASSWORD_BCRYPT,['cost'=>4]);
            $token=password_hash($this->usuario, PASSWORD_BCRYPT,['cost'=>4]);
            $query = "insert into usuario (usuario, clave, token, persona_idpersona, rol_idrol) values ('$this->usuario','$password_segura','$token',$this->idPersona, $this->idRol)";
            $this->conx->CreateConnection();
            $result = $this->conx->ExecuteQuery($query);
            if ($result) {
                $RowCount = $this->conx->GetCountAffectedRows();
                if ($RowCount > 0) {
                    //registro correcto
                    return json_encode(array("success" => 1, "error" => 0, "mensaje" => "Usuario registrado correctamente","token"=>"$token"));
                } else {
                    return json_encode(array("success" => 0, "error" => 1, "mensaje" => "Error al registrar"));
                }
            } else {
                return json_encode(array("success" => 0, "error" => 1, "mensaje" => "Error en la consulta"));
            }
        } else {
            return $ver;
        }
    }
}