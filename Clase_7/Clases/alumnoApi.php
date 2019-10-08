<?php
include "./Clases/alumno.php";
$path_alumnos = "./lista_alumnos.json";

class AlumnoApi {

    function listar_alumnos(){
        echo "DAADADADAAAA";
        //$arrayAlumnos = Alumno::leer_alumnos_json($path_alumnos);

    }

    /*$arrayAlumnos = AlumnoApi::leer_alumnos_json($path_alumnos);
    $apellido = $_GET['apellido'];
    $alumnosEncontrados = Alumno::buscar_alumnos($arrayAlumnos,$apellido);
    if (!empty($alumnosEncontrados)) {
        echo json_encode($alumnosEncontrados);
    }else{
        echo '{"respuesta":"No se encontraron alumnos con ese apellido"}';
    }
*/
}


?>