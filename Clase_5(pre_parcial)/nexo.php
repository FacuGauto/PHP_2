<?php
include "./Clases/alumno.php";
$path = "./lista_alumnos.json";
$dato = $_SERVER['REQUEST_METHOD'];

//var_dump($dato);
if ($dato == "POST") {
    if($_POST['caso'] == "cargarAlumno")
    {
        if (!empty($_POST['nombre'])) 
        {
            if (!empty($_POST['apellido'])) 
            {
                if (!empty($_POST['email'])) 
                {
                    //var_dump($_FILES);
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
                            var_dump($alum);
                            $alum->guardar_alumno_json($path);
                        }
                        //A cada llamada del postman se debe responder con un json. Ej {"respuesta":"Alumno agregado con exito"}
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
           // var_dump($_GET);

            $arrayAlumno = Alumno::leer_alumnos_json($path);
            //var_dump($arrayAlumno);
            $apellido = $_GET['apellido'];
            Alumno::buscar_alumnos_json($arrayAlumno,$apellido);
        }
    }
}







?>