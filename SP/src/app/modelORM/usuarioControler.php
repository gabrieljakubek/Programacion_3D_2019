<?php

namespace App\Models\ORM;

use App\Models\ORM\usuario;
use App\Models\IApiControler;

include_once __DIR__ . '/usuario.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class usuarioControler implements IApiControler
{
  public function Beinvenida($request, $response, $args)
  {
    $response->getBody()->write("GET => Bienvenido!!! ,a UTN FRA SlimFramework");

    return $response;
  }

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
    $newResponse = $response->withJson($usuario, 200);
    return $newResponse;
  }

  public function CargarUno($request, $response, $args)
  {
    $usuario = new usuario;
    $body = $request->getParsedBody();
    $usuario->email = $body["email"];
    $usuario->clave = $body["clave"];
    $usuario->tipo = $body["tipo"];
    $validacion = usuario::traerUsuario($usuario["clave"]);
    if(count($validacion) ==0)
    {
      $respuesta = "Plancho";
      $usuario->save();
    }
    else {
      $respuesta = "No plancho";
    }
    $newResponse = $response->withJson( $respuesta, 200);
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
    return   $newResponse;
  }
}
