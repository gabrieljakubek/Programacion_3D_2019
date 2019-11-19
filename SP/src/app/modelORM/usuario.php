<?php
namespace App\Models\ORM;

class usuario extends \Illuminate\Database\Eloquent\Model
{

    public static function traerUsuario($valor, $validacion = false)
    {
        if ($validacion === true) {
            $respuesta = self::select("id", "email","tipo")
                ->where('email', $valor["email"])
                ->where('clave', $valor['id'])
                ->get();
        } else {
            $respuesta = self::select("id", "email", "tipo")
                ->where('email', $valor)
                ->get();
        }
        return $respuesta;
    }
    public static function traerUsuarios()
    {
        $respuesta = self::select("id", "email", "tipo")->get();
        return $respuesta;
    }
}
