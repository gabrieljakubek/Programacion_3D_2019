<?php
namespace App\Models\ORM;

class usuario extends \Illuminate\Database\Eloquent\Model
{

    public static function traerUsuario($valor, $validacion = 2)
    {
        if ($validacion === 1) {
            $respuesta = self::select("id", "email", "tipo")
                ->where('email', $valor["email"])
                ->where('clave', $valor['id'])
                ->get();
        } else if ($validacion === 2) {
            $respuesta = self::select("id", "email", "tipo")
                ->where('email', $valor)
                ->get();
        } else if ($validacion === 3) {
            $respuesta = self::select("id", "email", "tipo")
                ->where('id', $valor)
                ->get();
        } else {
            $respuesta = "Opcion no valida";
        }
        return $respuesta;
    }
    public static function traerUsuarios()
    {
        $respuesta = self::select("id", "email", "tipo")->get();
        return $respuesta;
    }
}
