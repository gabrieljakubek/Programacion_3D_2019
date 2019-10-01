<?php
include_once "./objeto.php";
include_once "./archivo.php";
class Usuario
{
    public $legajo;
    public $clave;
    public $nombre;
    public $email;
    public $foto1;
    public $foto2;

    public function __construct($legajo, $clave=null, $nombre = null, $email = null, $foto1 = null, $foto2 = null)
    {
        $this->legajo = $legajo;
        $this->clave = $clave;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->foto1 = $foto1;
        $this->foto2 = $foto2;
    }

    public function Equals($usuario)
    {
        $retorno = false;
        if ($this->legajo == $usuario->legajo && $this->clave == $usuario->clave) {
            $retorno = true;
        }
        return $retorno;
    }
    public static function CargarArray($ruta)
    {
        $usuarios = array();
        $base = json_decode(Objeto::Listar($ruta));
        if (count($base) > 0) {
            for ($i = 0; $i < count($base); $i++) {
                array_push($usuarios, new Usuario($base[$i]->legajo, $base[$i]->clave, $base[$i]->nombre, $base[$i]->email, $base[$i]->foto1, $base[$i]->foto2));
            }
        }
        return $usuarios;
    }
}
