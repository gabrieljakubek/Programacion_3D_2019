<?php
namespace App\Models\ORM;

class materia extends \Illuminate\Database\Eloquent\Model
{

     public static function traerMateria($valor)
    {
            $respuesta = self::select("id", "nombre", "cuatrimestre",'cupo')
                ->where('nombre', $valor['nombre'])
                ->where('cuatrimestre',$valor['cuatrimestre'])
                ->get();
        
        return $respuesta;
    }
    public static function traerMaterias()
    {
        $respuesta = self::select("id", "nombre", "cuatrimestre",'cupo')->get();
        return $respuesta;
    } 
}
