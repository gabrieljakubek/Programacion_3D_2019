<?php
include_once "./objeto.php";
include_once "./archivo.php";
class Alumno
{
    public $nombre;
    public $apellido;
    public $email;
    public $foto;

    public function __construct($nombre, $apellido, $email, $foto = null)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->foto = $foto;
    }

    public function Equals($alumno)
    {
        $retorno = false;
        if ($this->email == $alumno->email) {
            $retorno = true;
        }
        return $retorno;
    }
    public function BuscarApellido($apellido)
    {
        $retorno = false;
        if (strtolower($this->apellido) == strtolower($apellido)) {
            $retorno = true;
        }
        return $retorno;
    }

    public static function CargarArray()
    {
        $alumnos = array();
        $base = json_decode(Objeto::Listar("./alumnos.json"));
        if (count($base) > 0) {
            for ($i = 0; $i < count($base); $i++) {
                array_push($alumnos, new Alumno($base[$i]->nombre, $base[$i]->apellido, $base[$i]->email, $base[$i]->foto));
            }
        }
        return $alumnos;
    }

}
