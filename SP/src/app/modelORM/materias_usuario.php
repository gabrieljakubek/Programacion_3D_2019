<?php
namespace App\Models\ORM;


class materias_usuario extends \Illuminate\Database\Eloquent\Model
{
    public static function traerMaterias($valor)
    {
        $respuesta = self::select("id", "pk_usuario", "pk_materia")
            ->where('pk_usuario', $valor)
            ->get();

        return $respuesta;
    }

}
