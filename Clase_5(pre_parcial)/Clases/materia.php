<?php

class Materia
{
    public $nombre;
    public $codigo;
    public $cupoAlumnos;
    public $aula;

    function __construct($nombre,$codigo,$cupoAlumnos,$aula)
    {
        $this->nombre = $nombre;
        $this->codigo = $codigo;
        $this->cupoAlumnos = $cupoAlumnos;
        $this->aula = $aula;
    }

    function guardar_materia_json($path)
    {
        if(file_exists($path)) 
        {
            $file = fopen($path,"r");
            $contenido = fread($file, filesize($path));
            $json = json_decode($contenido, true);
            array_push($json,(array) $this);
            fclose($file);
            $file = fopen($path,"w");
            fwrite($file,json_encode($json));
            echo '{"respuesta":"Materia agregada con exito"}';
        } else {
            $array_materias = array();
            $file = fopen($path,"w");
            array_push($array_materias,(array) $this);
            fwrite($file,json_encode($array_materias));
            echo '{"respuesta":"Materia agregado con exito"}';
        }
        fclose($file);
    }
}
?>