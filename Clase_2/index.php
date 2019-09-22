<?php
#include "./funciones.php";
#require_once "./funciones.php";
require_once "./Clases/persona.php";
require_once "./Clases/alumno.php";

session_start();

if (!isset($_SESSION['cont']))    
{
    $_SESSION['cont'] = 1;
    $_SESSION['alumnos'] = 1;
}
else
{
    $_SESSION['cont'] = $_SESSION['cont'] + 1;
}

var_dump($_SESSION['cont']);

$dato = $_SERVER['REQUEST_METHOD'];
$alumno = new Alumno("Juan",34543234,"ED34234","2°C");
$alumno2 = new Alumno("Federico",38458784,"EF34240","2°C");
$array_alumnos = array($alumno, $alumno2);
#var_dump($array_alumnos);

#var_dump($dato);
#var_dump($_POST);
if ($dato=="GET")
{
    foreach($array_alumnos as $alumno){
        #var_dump($alumno);
        echo $alumno->nombre . "," . $alumno->dni . "," . $alumno->legajo . "," . $alumno->cuatrimestre . "\n";
        #$alumno->datos($alumno);
        #echo "Alumno: $value<br>";
      }
}
elseif ($dato=="POST")
{
    if (!empty($_POST['nombre']))    
    {
        if (!empty($_POST['dni']))
       {
            if (!empty($_POST['legajo'])) 
            {
                if (!empty($_POST['cuatrimestre'])) 
                {
                    $nombre = $_POST['nombre'];
                    $dni = $_POST['dni'];
                    $legajo = $_POST['legajo'];
                    $cuatrimestre = $_POST['cuatrimestre'];

                    $alumno = new Alumno($nombre,$dni,$legajo,$cuatrimestre);

                    echo "Alumno " . $nombre . " agregado con exito";
                }
            }
        }
    }

}


//echo $apellido . "," . $nombre . "<br/>";

//saludar('PEPE');


#$persona = new Persona($nombre,$dni);


#var_dump($alumno);

#echo "<br/>";
#$persona->saludar($nombre);
?>