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

    function guardar_alumno_json($path)
    {
        if(file_exists($path)) 
        {
            $file = fopen($path,"r");
            $contenido = fread($file, filesize($path));
            fclose($file);
            $json = json_decode($contenido, true);
            if (!Alumno::buscar_alumno_email($json,$this->email)) {
                array_push($json,(array) $this);
                $file = fopen($path,"w");
                fwrite($file,json_encode($json));
                echo '{"respuesta":"Alumno agregado con exito"}';
            }else{
                echo '{"respuesta":"El mail ya existe en la lista de alumnos"}';
            }
            
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

    static function buscar_alumnos($arrayAlumnos,$apellido)
    {
        $arrayAlumnosEncontrados = array();
        foreach ($arrayAlumnos as $value) {
            if ((strcasecmp($value['apellido'],$apellido) == 0)) {
                array_push($arrayAlumnosEncontrados,$value);
            }
        }
        return $arrayAlumnosEncontrados;
    }

    static function buscar_alumno_email($arrayAlumnos,$email)
    {
        foreach ($arrayAlumnos as $value) {
            if ((strcasecmp($value['mailAlumno'],$email) == 0)) {
                return true;
            }
        }
        return false;
    }
}
?>