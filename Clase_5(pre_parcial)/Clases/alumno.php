<?php
include "persona.php";
class Alumno extends Persona
{
    public $email;
    public $foto;
      
    function __construct($nombre,$apellido,$email,$foto)
    {
        parent::__construct($nombre,$apellido);
        $this->email = $email;
        $this->foto = $foto;
    }
    
    static function datos()
    {
        return $this->nombre . "," . $this->dni . "," . $this->legajo . "," . $this->cuatrimestre;
    }

    function retorna_JSON()
    {
        return json_encode($this);
    }

    function guardar_alumno_json($path)
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
            echo '{"respuesta":"Alumno agregado con exito"}';
        } else {
            $array_alumnos = array();
            $file = fopen($path,"w");
            array_push($array_alumnos,(array) $this);
            fwrite($file,json_encode($array_alumnos));
            echo '{"respuesta":"Alumno agregado con exito"}';
        }
        fclose($file);
    }

    static function leer_alumnos_json($path)
    {
        $arrayAlumnos = array();
        if(file_exists($path))
        {
            $file = fopen($path,"r");
            $contenido = fread($file, filesize($path));
            $arrayAlumnos = json_decode($contenido, true);
            fclose($file);
        }
        return $arrayAlumnos;
    }

    static function buscar_alumnos_json($arrayAlumnos,$apellido)
    {
        $arrayAlumnosEncontrados = array();
        foreach ($arrayAlumnos as $value) {
            if ((strcasecmp($value['apellido'],$apellido) == 0)) {
                array_push($arrayAlumnosEncontrados,$value);
            }
        }
        return $arrayAlumnosEncontrados;
    }
}
?>