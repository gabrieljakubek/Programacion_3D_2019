<?php
namespace App\Models\ORM;

use App\Models\AutentificadorJWT;
use App\Models\IApiControler;

include_once __DIR__ . '/materia.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';
include_once __DIR__ . '../../modelAPI/AutentificadorJWT.php';

class materiaControler implements IApiControler
{
    public function TraerTodos($request, $response, $args)
    {
        //return cd::all()->toJson();
        $materias = materia::traerMaterias();
        $newResponse = $response->withJson($materias, 200);
        return $newResponse;
    }
    public function TraerUno($request, $response, $args)
    {
        $materia = new materia;
        $materia->nombre = $args['materia'];
        $materia->cuatrimestre = $args['cuatrimestre'];
        $retorno = materia::traerMateria($materia);
        //complete el codigo
        $newResponse = $response->withJson($retorno, 200);
        return $newResponse;
    }

    public function CargarUno($request, $response, $args)
    {
        $token = $request->getHeader("token");
        $body = $request->getParsedBody();
        $data = AutentificadorJWT::ObtenerData($token[0]);
        if (isset($body['materia']) && isset($body['cuatrimestre']) && isset($body['cupo'])) {
            $materia = new materia;
            $materia->nombre = $body['materia'];
            $materia->cuatrimestre = $body['cuatrimestre'];
            $materia->cupo = $body['cupo'];
            $existe = materia::traerMateria($materia);
            if (count($existe) == 0) {
                $materia->save();
                $respuesta = "Se dio de alta la materia";
                $response = $response->withJson($respuesta, 200);
            } else {
                $respuesta = "La materia ya esta dada de alta";
                $response = $response->withJson($respuesta, 200);
            }

        } else {
            $respuesta = "Falta cargar los campos requeridos";
            $response = $response->withJson($respuesta, 500);
        }
        //complete el codigo

        return $response;
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

}
