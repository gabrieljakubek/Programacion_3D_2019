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
    $todosLosCds = cd::all();
    $newResponse = $response->withJson($todosLosCds, 200);
    return $newResponse;
  }
  public function TraerUno($request, $response, $args)
  {
    $body = $request->getParsedBody();
    $usuario = usuario::select("email","tipo")->where('email',$body['email'])->get();

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
    return self::TraerUno($request,$response,$args);
    /* $newResponse = $response->withJson("Plancho", 200);
    return $newResponse; */
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
