<?php

include_once("conexionBase.php");

class modNoticia
{
    private $titulo;
    private $descripcionCorta;
    private $descripcionLarga;
    private $foto;
    private $fechaPublicacion;
    private $llave;
    private $idCategoria;
    private $conx;

    function __construct()
    {
        $this->titulo = "";
        $this->descripcionCorta = "";
        $this->descripcionLarga = "";
        $this->foto = "";
        $this->fechaPublicacion = "";
        $this->llave = "";
        $this->idCategoria = null;
        $this->conx = new conexionBase();
    }

    public function set($key, $valor)
    {
        $this->$key = $valor;
    }

    private function verificarNoticia()
    {
        $query = "select * from noticia join publicacion p on noticia.idnoticia = p.noticia_idnoticia join categoria c on c.idcategoria = p.categoria_idcategoria where titulo='$this->titulo' and idcategoria=$this->idCategoria";
        $this->conx->CreateConnection();
        $result = $this->conx->ExecuteQuery($query);
        if ($result) {
            $RowCount = $this->conx->GetCountAffectedRows();
            if ($RowCount > 0) {
                $row = $this->conx->GetRows($result);
                return json_encode(array("success" => 0, "error" => 1, "mensaje" => "Noticia ya existente, titulo existente"));
            } else {
                return 1;
            }
        } else {
            return json_encode(array("success" => 0, "error" => 1, "mensaje" => "Error en la consulta verificacion"));
        }
    }

    function buscarNoticia()
    {
        $query = "select * from noticia where llave='$this->llave'";
        $this->conx->CreateConnection();
        $result = $this->conx->ExecuteQuery($query);
        if ($result) {
            $RowCount = $this->conx->GetCountAffectedRows();
            if ($RowCount > 0) {
                $row = $this->conx->GetRows($result);
                return $row;
            } else {
                return 1;
            }
        } else {
            return json_encode(array("success" => 0, "error" => 1, "mensaje" => "Error en la consulta busqueda noticia"));
        }
    }

    public function registrarNoticia()
    {
        $ver = $this->verificarNoticia();
        if ($ver == 1) {
            $this->llave=uniqid();
            $query = "insert into noticia (titulo, descripcionCorta, descripcionLarga, foto, fechaPublicacion, llave) values (
'$this->titulo','$this->descripcionCorta','$this->descripcionLarga','$this->foto','$this->fechaPublicacion','$this->llave')";
            $this->conx->CreateConnection();
            $result = $this->conx->ExecuteQuery($query);
            if ($result) {
                $RowCount = $this->conx->GetCountAffectedRows();
                if ($RowCount > 0) {
                    $resp=$this->buscarNoticia();
                   $query2="insert into publicacion (noticia_idnoticia, categoria_idcategoria) values ($resp[0],$this->idCategoria)";
                    $this->conx->CreateConnection();
                    $result2 = $this->conx->ExecuteQuery($query2);
                    if ($result2){
                        return json_encode(array("success" => 1, "error" => 0, "mensaje" => "Noticia registrada correctamente"));

                    }
                    else{
                        return json_encode(array("success" => 0, "error" => 1, "mensaje" => "Error al registrar la noticia","sql"=>$query2));

                    }
                    //registro correcto
                } else {
                    return json_encode(array("success" => 0, "error" => 1, "mensaje" => "Error al registrar"));
                }
            } else {
                return json_encode(array("success" => 0, "error" => 1, "mensaje" => "Error en la consulta noticia","sql"=>$query));
            }
        } else {
            return $ver;
        }
    }
}