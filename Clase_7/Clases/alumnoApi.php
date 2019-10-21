<?php
//include "alumno.php";


class AlumnoApi {

  //  public $path_alumnos = "./lista_alumnos.json";

    function traerTodos(){
        echo "DAADADADAAAA";
     //   var_dump($path_alumnos);
        $arrayAlumnos = Alumno::leer_alumnos_json($path_alumnos);
        var_dump($arrayAlumnos);
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