<?php
require_once "./Clases/persona.php";
require_once "./Clases/alumno.php";

$nombre = $_POST['nombre'];
$dni = $_POST['dni'];
$legajo = $_POST['legajo'];
$cuatrimestre = $_POST['cuatrimestre'];
$imagen_aux = "./a/prueba.jpg";

//$img_type = explode('.',$_FILES['imagen']['name']);
//$img_type = $img_type[sizeof($img_type) - 1];
//$img = $_FILES['imagen']['tmp_name'];
//$result = move_uploaded_file($img,"./Fotos/" . "uno" . "." . $img_type);
//if($result)
//{
    
//}


$alumno = new Alumno($nombre,$dni,$legajo,$cuatrimestre,$imagen_aux);
//var_dump($alumno);
//var_dump(json_encode($alumno));
//var_dump((array) $alumno);

$file = fopen("./archivo.json","r");
$contenido = fread($file, filesize("./archivo.json"));
fclose($file);
//var_dump($contenido);
$json = json_decode($contenido, true);
var_dump($json);
array_push($json,(array) $alumno);
//echo "AJJAJAJAJAJAJ";
var_dump($json);
$file = fopen("./archivo.json","w");
//fwrite($file, json_encode($json));

fwrite($file,$json);
fclose($file);






?>