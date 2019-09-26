<?php
include "./Clases/alumno.php";
include "./Clases/materia.php";
$path_alumnos = "./lista_alumnos.json";
$path_materias = "./lista_materias.json";
$dato = $_SERVER['REQUEST_METHOD'];

if ($dato == "POST") {
    if($_POST['caso'] == "cargarAlumno")
    {
        if (!empty($_POST['nombre'])) 
        {
            if (!empty($_POST['apellido'])) 
            {
                if (!empty($_POST['email'])) 
                {
                    if (!empty($_FILES['foto'])) 
                    {
                        $img_origen = $_FILES['foto']['tmp_name'];
                        $img_destino = "./Fotos/" . $_FILES['foto']['name'];
                        $result_img = move_uploaded_file($img_origen,$img_destino);

                        if ($result_img == true) {
                            $nombre = $_POST['nombre'];
                            $apellido = $_POST['apellido'];
                            $email = $_POST['email'];
                            $foto = $_FILES['foto']['name'];
                            $alum = new Alumno($nombre,$apellido,$email,$foto);
                            $alum->guardar_alumno_json($path_alumnos);
                        }
                        //A cada llamada del postman se debe responder con un json. Ej {"respuesta":"Alumno agregado con exito"}
                    }
                }
            }
        }
    }elseif ($_POST['caso'] == "cargarMateria ") {
        if (!empty($_POST['nombre'])) 
        {
            if (!empty($_POST['codigo'])) 
            {
                if (!empty($_POST['cupo'])) 
                {
                    if (!empty($_POST['aula'])) 
                    {
                        $nombre = $_POST['nombre'];
                        $codigo = $_POST['codigo'];
                        $cupo = $_POST['cupo'];
                        $aula = $_POST['aula'];
                        $materia = new Materia($nombre,$codigo,$cupo,$aula);
                        $materia->guardar_materia_json($path_materias);
                    }
                }
            }
        }
    }
}
if ($dato == "GET") {
    if($_GET['caso'] == "consultarAlumno")
    {
        if (!empty($_GET['apellido'])) 
        {
            $arrayAlumnos = Alumno::leer_alumnos_json($path_alumnos);
            $apellido = $_GET['apellido'];
            $alumnosEncontrados = Alumno::buscar_alumnos($arrayAlumnos,$apellido);
            if (!empty($alumnosEncontrados)) {
                echo json_encode($alumnosEncontrados);
            }else{
                echo '{"respuesta":"No se encontraron alumnos con ese apellido"}';
            }
        }
    }
}

?>