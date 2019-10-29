<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require 'vendor/autoload.php';
include "./Clases/alumno.php";


$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

/*$app->get('/alumnos[/]', function(Request $request, Response $response){
	//var_dump($response);
	$path_json = "./lista_alumnos.json";
	$arrayAlumnos = Alumno::leer_alumnos_json($path_json);
	echo json_encode($arrayAlumnos);
});*/

/*$app->post('/alumnos', function(Request $request, Response $response){
	echo "GEEET 22222";
	var_dump($request);
	$nombre = $request->getParam('nombre');
	$id_alumno = $request->getAttribute('id');
	echo $id_alumno;
	$path_json = "./lista_alumnos.json";
	$arrayAlumnos = Alumno::leer_alumnos_json($path_json);
	//echo json_encode($arrayAlumnos);
});*/
/*$app->post('/usuario[/]', function(Request $request, Response $response){
	echo " post ";
});
*/
//$app->group('/alumno$path', function () {//path va en el index
//$app->group('/alumno', function () {
	/*$this->get('[/]', function($request,$response,$args){
		echo "GEEEEEEt";
	});*/

//	$this->get('[/]',\alumnoApi::class . ':traerTodos');
   
//	$this->get('[/]', \alumnoApi::class . ':listar_alumnos');

 
	   
//});

$app->group('/alumno', function () {
 
	$this->get('/', \alumno::class . ':traerTodos');
   
	//$this->get('/{id}', \alumno::class . ':traerUno');
	$this->post('/', \alumno::class . ':CargarUno');
	$this->delete('/', \alumno::class . ':BorrarUno');
	$this->put('/', \alumno::class . ':ModificarUno');
	   
});

$app->run();
?>