<?php
include "./funciones.php";
require_once "./funciones.php";
require_once "./Clases/persona.php";
require_once "./Clases/alumno.php";

$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$dni = $_GET['dni'];

//echo $apellido . "," . $nombre . "<br/>";

//saludar('PEPE');


$persona = new Persona($nombre,$dni);
$alumno = new Alumno("Juan",34543234,"ED34234","2°C");



var_dump($alumno);

echo "<br/>";
$persona->saludar($nombre);
?>