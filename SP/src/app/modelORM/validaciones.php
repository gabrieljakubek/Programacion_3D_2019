<?php
namespace App\Models\ORM;

use App\Models\AutentificadorJWT;

include_once __DIR__ . '../../modelAPI/AutentificadorJWT.php';

class validaciones
{

    public static function validar($request, $response, $next)
    {
        $token = $request->getHeader('token');
        if (!empty($token)) {
            try
            {
                AutentificadorJWT::verificarToken($token[0]);
                $response = $next( $request, $response);
            } catch (Exception $e) {
                $mensaje = ["mensaje" => "Se requiere ingresar un token valido"];
                $response = $response->withJson($mensaje, 500);
            }
        } else {
            $mensaje = ["mensaje" => "Se requiere ingresar un token"];
            $response = $response->withJson($mensaje, 500);
        }
        return $response;
    }
    public static function validarAdmin($request, $response, $next)
    {
        $token = $request->getHeader('token');
        $data = AutentificadorJWT::ObtenerData($token[0]);
        if ($data[0]->tipo ===3) {
            $response = $next( $request, $response);
        } else {
            $mensaje = ["mensaje" => 'Solamente para administradores'];
            $response = $response->withJson($mensaje, 500);
        }
        return $response;
    }
}
