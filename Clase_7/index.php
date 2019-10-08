<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require 'vendor/autoload.php';
include "./Clases/alumnoApi.php";

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

/*$app->get('[/]', function(Request $request, Response $response){
	echo " get ";
});

$app->post('/usuario[/]', function(Request $request, Response $response){
	echo " post ";
});
*/
$app->group('/alumno', function () {
 
	/*$this->get('[/]', function($request,$response,$args){
		echo "GEEEEEEt";
	});*/
   
	$this->get('[/]', \alumnoApi::class . ':listar_alumnos');

 
	   
  });

$app->run();
?>