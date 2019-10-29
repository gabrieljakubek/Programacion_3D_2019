<?php
include_once "./objeto.php";
include_once "./archivo.php";
include_once "./alumno.php";
include_once "./log.php";
include_once "./manejador.php";
include_once "./api.php";
include_once "./middelware.php";
require 'vendor/autoload.php';
$config["displayErrorDetails"] = true;
$config["addContentLengthHeader"] = false;
$app = new \Slim\App(['settings'=>$config]);

$app->group("/saludar", function () {
    $this->get('/', function ($req, $res, $args = []) {
        return $res->withStatus(400)->write('Bad Request');
    });
    $this->get('/hello/{name}', function ($request, $response, $args) {
        $name = $args['name'];
        return $response->withJson("Hello, $name",200);
    });
    $this->post('/alumno',\Api::class . ':CargarAlumno');
})->add(\Middelware::class . ":test1");

$app->run();