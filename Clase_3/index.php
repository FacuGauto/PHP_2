<?php
//Archivo .json con array de objetos. Leo el archivo (jsondecode) y agrego al array array_push un nuevo objeto jsonencode
$dato = $_SERVER['REQUEST_METHOD'];
$array_personas = array();
echo "AAAAAAAAAAAAAAA";

if ($dato=="POST")
{
    $file = fopen("./archivo.json","r");
    //echo fgets($file);
    //echo fgets($file);
    $contenido = fread($file, filesize("./archivo.json"));
    //$array_personas = $contenido;
//    var_dump($contenido);
    //var_dump(json_decode($contenido));
    $json = json_decode($contenido, true);
    var_dump($json[1]['nombre']);
    echo $json[1]['nombre'];
    array_push($json,json_encode('{"nombre": "Pepe","apellido": "Argento"}'));
    var_dump($json);
    //fread($file,filesize("archivo.json"));

    //fgets($file);
        /*while(!feof($file))
    {
        echo fgets($file). "\n";
    } */
    fclose($file);
    /*if (!empty($_POST['nombre']))    
    {
        if (!empty($_POST['apellido']))
        {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $file = fopen("./archivo.txt","a");
            fwrite($file, $nombre . "-" . $apellido . PHP_EOL);
            fclose($file);

       }
    }*/
}


?>