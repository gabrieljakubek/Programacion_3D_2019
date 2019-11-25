<?php
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\usuarioControler;

include_once __DIR__ . '/../../src/app/modelORM/usuarioControler.php';

return function (App $app) {
    $container = $app->getContainer();

     $app->group('/usuario', function () {   
         
        $this->post('/', usuarioControler::class.':CargarUno');
        $this->get('/{email}', usuarioControler::class.':TraerUno');
        $this->get('/', usuarioControler::class.':TraerTodos');
        $this->post('/login', usuarioControler::class.':LogIn');
        $this->post('/{legajo}', usuarioControler::class.':ModificarUno');
    });
};
