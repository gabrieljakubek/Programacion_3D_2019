<?php
require_once "./manejador.php";
class Middelware
{
    public function test1($request,$response,$next){
        $route = $request->getAttribute('route');
        Manejador::Logger($route->getMethods(),$request->getServerParam('REMOTE_ADDR'));
        $response=$next($request,$response);
        return $response;
    }
}
