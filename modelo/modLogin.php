<?php
include_once("conexionBase.php");

class modLogin
{
    private $usuario;
    private $clave;
    private $conx;

    function __construct()
    {
        $this->usuario = "";
        $this->clave = "";
        $this->conx = new conexionBase();
    }

    public function set($key, $valor)
    {
        $this->$key = $valor;
    }

    public function registrarUsuario()
    {

        date_default_timezone_set('America/Boa_Vista');
        $fecha = strftime("%Y-%m-%d");
        $hora = strftime("%H:%M:%S");
        $query = "select idusuario,token,idpersona,idrol,nombreRol,nombre,primerApellido,segundoApellido,email,sexo,ci,clave from usuario join persona p on p.idpersona = usuario.persona_idpersona join rol r on r.idrol = usuario.rol_idrol where usuario='$this->usuario'";
        $this->conx->CreateConnection();
        $result = $this->conx->ExecuteQuery($query);
        if ($result) {
            $RowCount = $this->conx->GetCountAffectedRows();
            if ($RowCount > 0) {
                $row = $this->conx->GetRows($result);
                if(password_verify($this->clave,$row[11])){
                    echo json_encode(array('success' => 1,
                        'idUsuario'=>(int)$row[0],
                        'token'=>$row[1],
                        'idPersona'=>(int)$row[2],
                        'idRol'=>(int)$row[3],
                        'nombreRol'=>$row[4],
                        'nombre'=>$row[5],
                        'primerApellido'=>$row[6],
                        'segundoApellido'=>$row[7],
                        'correo'=>$row[8],
                        'sexo'=>$row[9],
                        'ci'=>$row[10]
                    ),JSON_UNESCAPED_UNICODE);

                }
                else {

                    echo json_encode(array('success' =>0,'Error'=>1,'Mensaje'=>'La contraseña no coincide'));
                }
            } else {
                $this->conx->CloseConnection();
                echo json_encode(array('success' =>0,'Error'=>1,'Mensaje'=>'No existe el usuario'));
            }
        } else {
            $this->conx->CloseConnection();
            echo json_encode(array('success' =>0,'Error'=>1,'Mensaje'=>'No se realizo la consulta correctamente'));
        }
    }
}