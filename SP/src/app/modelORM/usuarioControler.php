<?php

namespace App\Models\ORM;

use App\Models\AutentificadorJWT;
use App\Models\IApiControler;
use App\Models\ORM\usuario;

include_once __DIR__ . '/usuario.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';
include_once __DIR__ . '../../modelAPI/AutentificadorJWT.php';

class usuarioControler implements IApiControler
{
    public function TraerTodos($request, $response, $args)
    {
        //return cd::all()->toJson();
        $usuarios = usuario::traerUsuarios();
        $newResponse = $response->withJson($usuarios, 200);
        return $newResponse;
    }
    public function TraerUno($request, $response, $args)
    {
        $usuario = usuario::traerUsuario($args['email']);
        if (count($usuario) == 0) {
            $newResponse = $response->withJson("No existe el usuario", 200);
        } else {
            $newResponse = $response->withJson($usuario, 200);
        }
        return $newResponse;
    }

    public function CargarUno($request, $response, $args)
    {
        $usuario = new usuario;
        $body = $request->getParsedBody();
        $usuario->email = $body["email"];
        $usuario->clave = $body["clave"];
        $usuario->tipo = $body["tipo"];
        $existe = usuario::traerUsuario($usuario["clave"]);
        if (count($existe) == 0) {
            $respuesta = "Plancho";
            $usuario->save();
        } else {
            $respuesta = "No plancho";
        }
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    public function BorrarUno($request, $response, $args)
    {
        //complete el codigo 
        $newResponse = $response->withJson("sin completar", 200);
        return $newResponse;
    }

    public function ModificarUno($request, $response, $args)
    {
        //complete el codigo
        $newResponse = $response->withJson("sin completar", 200);
        return $newResponse;
    }

    public function LogIn($request, $response, $args)
    {
        $usuario = new usuario;
        $body = $request->getParsedBody();
        $usuario->email = $body["email"];
        $usuario->clave = $body["clave"];
        $usuario->tipo = $body["tipo"];
        $validacion = usuario::traerUsuario($usuario, true);
        if (count($validacion) != 0) {
            $token = AutentificadorJWT::CrearToken($validacion);
            $respuesta = array('estado' => "Acceso autorizado", 'token' => $token);
        } else {
            $respuesta = "Acceso no autorizado";
        }
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
}
