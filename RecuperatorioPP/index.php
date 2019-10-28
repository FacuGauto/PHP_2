<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require 'vendor/autoload.php';
require_once './Clases/pizza.php';
require_once './Clases/archivo.php';
require_once './clases/log.php';
//include "./Clases/alumno.php";


$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

function addLog($metodo, $ruta){
        $hora = date("h:i:s");
        $log = new Log($ruta, $metodo, $hora);
        Log::Alta($log);
}

$app = new \Slim\App(["settings" => $config]);

$app->get('/pizzas', function(Request $request, Response $response, array $args){
    addLog($request->getMethod(), $request->getUri()->getPath());
	//var_dump($response);
	//$path_json = "./lista_alumnos.json";
    //$arrayAlumnos = Alumno::leer_alumnos_json($path_json);
    
    $arrDatos = $request->getQueryParams();
    var_dump($arrDatos);
        if(isset($arrDatos['tipo'], $arrDatos['sabor']) && !empty($arrDatos['tipo']) && !empty($arrDatos['sabor'])){
            if(Pizza::validarTipo($arrDatos['tipo'])){
                if(Pizza::validarSabor($arrDatos['sabor'])){
                    require_once './clases/log.php';
                    Pizza::mostrarDisponible($arrDatos['tipo'], $arrDatos['sabor']);
                }else
                    echo '{"mensaje":"Ingrese un sabor valido"}'; 
            }else
                echo '{"mensaje":"Ingrese un tipo valido"}';
        }else
            echo '{"mensaje":"Ingrese tipo y sabor"}';
});

$app->post('/pizzas', function(Request $request, Response $response, array $args){
    addLog($request->getMethod(), $request->getUri()->getPath());

    $arrDatos = $request->getParsedBody();

    
    $arrImg = $request->getUploadedFiles();
    //var_dump($arrImg);
    if(isset($arrDatos['precio'], $arrDatos['tipo'], $arrDatos['cantidad'], $arrDatos['sabor'])){
        if(!empty($arrDatos['precio']) && !empty($arrDatos['tipo']) && !empty($arrDatos['sabor']) && !empty($arrDatos['cantidad'])){
            if($arrImg['imagen'] != null && $arrImg['foto'] != null){
                $tipo = $arrDatos['tipo']; 
                $sabor = $arrDatos['sabor']; 
                $precio = $arrDatos['precio']; 
                $cantidad = $arrDatos['cantidad'];
                if(Pizza::validarTipo($tipo)){
                    if(Pizza::validarSabor($sabor)){
                        if(!Pizza::validarCombinacion($tipo, $sabor)){
                            $id = Pizza::generarNuevoId();
                            // Imagen
                            $origen = $arrImg['imagen']->file;
                            $nombreImagen = $arrImg['imagen']->getClientFilename();
                            $ext = pathinfo($nombreImagen, PATHINFO_EXTENSION);
                            $destinoImagen = "./images/pizzas/".$id."-imagen.".$ext;
                            move_uploaded_file($origen, $destinoImagen);
                            //Foto
                            $origen2 = $arrImg['foto']->file;
                            $nombreFoto = $arrImg['foto']->getClientFilename();
                            $ext2 = pathinfo($nombreFoto, PATHINFO_EXTENSION);
                            $destinoFoto = "./images/pizzas/".$id."-foto.".$ext2;
                            move_uploaded_file($origen2, $destinoFoto);

                            $pizza = new Pizza($id, $precio, $tipo, $cantidad, $sabor, $destinoImagen, $destinoFoto);
                            Pizza::alta($pizza);
                            echo '{"mensaje":"Se guardo correctamente"}';
                        }else
                            echo '{"mensaje":"La combinación ya existe"}';  
                    }else
                        echo '{"mensaje":"Ingrese un sabor válido"}';   
                }else
                    echo '{"mensaje":"Ingrese un tipo válido"}';
            }else
                echo '{"mensaje":"Debe ingresar 2 imagenes"}';
        }else
            echo '{"mensaje":"No puede haber campos vacios"}';
    }else
        echo '{"mensaje":"Faltan datos"}';
});

$app->post('/pizzasMod', function(Request $request, Response $response, array $args){
    addLog($request->getMethod(), $request->getUri()->getPath());

    $datos = $request->getParsedBody();
    $img = $request->getUploadedFiles();
    
    if(isset($datos['precio'], $datos['tipo'], $datos['sabor'], $datos['cantidad'], $datos['id'])){
        $email = $datos['email']; $tipo = $datos['tipo']; $sabor = $datos['sabor']; $cantidad = $datos['cantidad']; $id = $datos['id'];
        if(!empty($email) && !empty($tipo) && !empty($sabor) && !empty($cantidad) && !empty($id)){
            if($img['imagen'] != null && $img['foto'] != null){
                if(Pizza::validarTipo($tipo)){
                    if(Pizza::validarSabor($sabor)){
                        if(Pizza::existeId($id)){
                            Pizza::modificar($datos, $img);
                        }else
                            echo '{"mensaje":"No existe pizza con ese id"}';
                    }else
                        echo '{"mensaje":"Ingrese un sabor valido"}';
                }else
                    echo '{"mensaje":"Ingrese un tipo valido"}';
            }else
                echo '{"mensaje":"Debe ingresar 2 imagenes"}';
        }else
            echo '{"mensaje":"No puede haber campos vacíos"}';
    }else
        echo '{"mensaje":"Complete todos los campos requeridos"}';
});


$app->run();

?>