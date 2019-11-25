<?php

namespace App\Models\ORM;

use App\Models\AutentificadorJWT;
use App\Models\IApiControler;
use App\Models\ORM\materias_usuario;
use App\Models\ORM\usuario;
use App\Models\ORM\utils;

include_once __DIR__ . '/usuario.php';
include_once __DIR__ . '/utils.php';
include_once __DIR__ . '/materias_usuario.php';
include_once __DIR__ . '/usuarioControler.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';
include_once __DIR__ . '../../modelAPI/AutentificadorJWT.php';

class usuarioControler implements IApiControler
{
    const rutaImagenes = "../src/app/imagenes/";
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
        $contador = 0;
        $buscar = usuario::find($args["legajo"]);
        $token = $request->getHeader('token');
        $body = $request->getParsedBody();
        $data = AutentificadorJWT::ObtenerData($token[0]);
        $mensaje = "No se realizo ninguna modificacion";
        $uploadedFile = null;
        if (($buscar['id'] == $data[0]->id && $data[0]->tipo == 1) || ($data[0]->tipo == 3 && $buscar['tipo'] == 1)) {
            if (isset($body["email"]) && $body["email"] != $buscar["email"]) {
                $buscar['email'] = $body["email"];
                $buscar->save();
                $contador++;
            }
            $files = $request->getUploadedFiles();
            if (isset($files['foto'])) {
                $uploadedFile = $files['foto'];
                utils::guardarArchivo($uploadedFile, usuarioControler::rutaImagenes, $buscar['id']);
            }
            if ($uploadedFile != null) {
                $contador++;
            }
            if ($contador != 0) {
                $mensaje = " Se realizaron los cambios";
            }
        } else if (($buscar['id'] == $data[0]->id && $data[0]->tipo == 2) || ($data[0]->tipo == 3 && $buscar['tipo'] == 2)) {
            if (isset($body["email"]) && $body["email"] != $buscar["email"]) {
                $buscar['email'] = $body["email"];
                $buscar->save();
                $contador++;
            }
            if (isset($body["materias"])) {
                $materias = explode(",", $body["materias"]);
                $dando = materias_usuario::traerMaterias($buscar['id']);
                if ($dando == []) {
                    foreach ($materias as $m) {
                        $materia = new materias_usuario;
                        $materia->pk_materia = $m;
                        $materia->pk_usuario = $buscar['id'];
                        $materia->save();
                        $contador++;
                    }
                } else {
                    foreach ($materias as $m) {
                        $cargada = false;
                        foreach ($dando as $d) {
                            $int = intval($m);
                            if ($int == $d['pk_materia']) {
                                $cargada = true;
                            }
                        }
                        if ($cargada == false) {
                            $materia = new materias_usuario;
                            $materia->pk_materia = $m;
                            $materia->pk_usuario = $buscar['id'];
                            $materia->save();
                            $contador++;
                        }
                    }
                }
            }
            if ($contador != 0) {
                $mensaje = "Se realizaron los cambios";
            }
        } else {
            $mensaje = "No tiene la autorizacion para realizar la modificacion";
        }
        $newResponse = $response->withJson($mensaje, 200);
        return $newResponse;
    }

    public function LogIn($request, $response, $args)
    {
        $usuario = new usuario;
        $body = $request->getParsedBody();
        $usuario->email = $body["email"];
        $usuario->clave = $body["clave"];
        $usuario->tipo = $body["tipo"];
        $validacion = usuario::traerUsuario($usuario, 1);
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
