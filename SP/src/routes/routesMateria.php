<?php
use App\Models\ORM\materiaControler;
use App\Models\ORM\validaciones;
use Slim\App;

include_once __DIR__ . '/../../src/app/modelORM/materiaControler.php';
include_once __DIR__ . '/../../src/app/modelORM/validaciones.php';

return function (App $app) {
    $container = $app->getContainer();

    $app->group('/materia', function () {

        $this->post('/', materiaControler::class . ':CargarUno')
            ->add(validaciones::class . ":validarAdmin")
            ->add(validaciones::class . ":validar");

    });
};
