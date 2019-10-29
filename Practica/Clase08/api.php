<?php
require_once "./iapiusable.php";
class Api implements IApiUsable{
    public function CargarAlumno($request,$response,$args)
    {
        $valores = $request->getParsedBody();
        $alumno = new Alumno($valores["nombre"],$valores["apellido"],$valores["email"]);
        Manejador::GuardarAlumno($alumno,null);
        return $response->withJson(json_decode( Manejador::ListarAlumnos(null,null)),200);
    }

    public function Loggear($request,$response,$args){
        Manejador::Logger($request->getMethod(),$request->getAttribute('ip_address'));
        return $response->getBody()->write("Loggeo");
    }
}