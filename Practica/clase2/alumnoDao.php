<?php
class AlumnoDao
{
    public function __construct()
    {
    }
    public function Guardar($array, $value)
    {
        array_push($array, get_object_vars($value));
        return $array;
    }

    public function Borrar($array, $value)
    { 
        for ($i=0; $i < count($array); $i++) { 
            if($array[$i]->nombre == $value->nombre)
            {
                unset($array[$i]);
            }
        }
        return $array;
    }

    public function Modificar($array, $value)
    { }

    public function Listar($array)
    { }
}
