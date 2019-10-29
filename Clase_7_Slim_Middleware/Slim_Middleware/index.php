<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require 'vendor/autoload.php';
require_once './Clases/log.php';
require_once './Clases/archivo.php';
$app = new \Slim\App;

function addLog($metodo, $ruta){
    $hora = date("h:i:s");
    $log = new Log($ruta, $metodo, $hora);
    Log::Alta($log);
}

$mid1 = function($req, $response, $next){
    $response->getBody()->write(" MID Antes ");
    addLog($req->getMethod(), $req->getUri()->getPath());
    $response = $next($req, $response);
    $response->getBody()->write(" MID Despues ");
    return $response;
};

$app->add($mid1);

/*$app->get('/alumno', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello");
    return $response;
});*/

$app->group('/alumnos', function(){
    $this->get('/', function($request, $response){
        $response->getBody()->write("GET");
    });
    $this->post('/', function($request, $response){
        $response->getBody()->write("POST");
    });
    $this->put('/', function($request, $response){
        $response->getBody()->write("PUT");
    });
    $this->delete('/', function($request, $response){
        $response->getBody()->write("DELETE");
    });
});
$app->run();
?>