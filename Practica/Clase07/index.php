<?php
include_once "./objeto.php ";
include_once "./archivo.php";
include_once "./alumno.php";
include_once "./manejador.php";
include_once "./api.php";
require 'vendor/autoload.php';
$config['displayErrorDetails'] = true;

$app = new \Slim\App;
// $app->get('/hello/{name}', function ( $request,  $response, $args) {
//     $name = $args['name'];
//     $response->getBody()->write("Hello, $name");

//     return $response;
// });

// $app->get('/', function ( $req,   $res, $args = []) {
//     return $res->withStatus(400)->write('Bad Request');
// });

$app->group("/saludar", function () {
    $this->get('/', function ($req, $res, $args = []) {
        return $res->withStatus(400)->write('Bad Request');
    });
    $this->get('/hello/{name}', function ($request, $response, $args) {
        $name = $args['name'];
        return $response->withJson("Hello, $name",200);
    });
    $this->post('/alumno',\Api::class . ':CargarAlumno');});
$app->run();
