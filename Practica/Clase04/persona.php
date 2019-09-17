<?php
class Persona{
    public $nombre;
    public $apellido;
    public $legajo;
    public $imagen;

    public function __construct($nombre,$apellido,$legajo,$imagen = null)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->legajo = $legajo;
        $this->imagen = $imagen;
    }

    public function Equals($persona)
    {
        $retorno = false;
        if ($this->legajo == $persona->legajo) {
            $retorno= true;
        }
        return $retorno;
    }

    public static function CargarArray($array)
    {
        $personas = array();
        for ($i=0; $i < count($array); $i++) { 
            array_push($personas,new Persona($array[$i]->nombre,$array[$i]->apellido,$array[$i]->legajo,$array[$i]->imagen));
        }
        return $personas;
    }
}