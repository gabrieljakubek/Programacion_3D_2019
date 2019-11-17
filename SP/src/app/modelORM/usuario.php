<?php  
namespace App\Models\ORM;
 
 use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class usuario extends \Illuminate\Database\Eloquent\Model {  
  

    public static function traerUsuario($valor){
        $respuesta = self::select("email","tipo")->where('email',$valor)->get();
        return $respuesta;
    }
    public static function traerUsuarios(){
        $respuesta = self::select("email","clave","tipo")->get();
        return $respuesta;
    }
}
