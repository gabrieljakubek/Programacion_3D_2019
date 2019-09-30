<?php
class Inscribir{
    public $nombre;
    public $apellido;
    public $email;
    public $materia;
    public $codigo;

    public function __construct($nombre,$apellido,$email,$materia,$codigo)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->materia = $materia;
        $this->codigo = $codigo;
    }

    public function Equals($inscripcion)
    {
        $retorno = false;
        if ($this->email== $inscripcion->email && $this->codigo == $inscripcion->codigo) {
            $retorno = true;
        }
        return $retorno;
    }

    public static function CargarArray($ruta)
    {
        $inscripsiones = array();
        $base = json_decode(Objeto::Listar($ruta));
        if (count($base) > 0) {
            for ($i = 0; $i < count($base); $i++) {
                array_push($inscripsiones, new Alumno($base[$i]->nombre, $base[$i]->apellido, $base[$i]->email, $base[$i]->materia, $base[$i]->codigo));
            }
        }
        return $inscripsiones;
    }
    
}