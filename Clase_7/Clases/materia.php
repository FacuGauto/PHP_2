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
            fclose($file);
            $json = json_decode($contenido, true);
            if(Materia::buscar_materia($json,$this->codigo))
            {
                foreach ($json as $key => $value) {
                    if ($value['codigo'] === $this->codigo) {
                        $json[$key]['nombre'] = $this->nombre;
                        $json[$key]['cupoAlumnos'] = $this->cupoAlumnos;
                        $json[$key]['aula'] = $this->aula;
                    }
                }
                //echo '{"respuesta":"Materia editada con exito"}';
            }
            else
            {
                array_push($json,(array) $this);  
                echo '{"respuesta":"Materia agregada con exito"}';
            }
            $file = fopen($path,"w");
            fwrite($file,json_encode($json));
        }
        else
        {
            $array_materias = array();
            $file = fopen($path,"w");
            array_push($array_materias,(array) $this);
            fwrite($file,json_encode($array_materias));
            echo '{"respuesta":"Materia agregado con exito"}';
        }
       fclose($file);
    }

    static function leer_materias_json($path)
    {
        $arrayMaterias = array();
        if(file_exists($path))
        {
            $file = fopen($path,"r");
            $contenido = fread($file, filesize($path));
            $arrayMaterias = json_decode($contenido, true);
            fclose($file);
        }
        return $arrayMaterias;
    }

    static function buscar_materia($arrayMaterias,$codigo)
    {
        foreach ($arrayMaterias as $value) {
            if ($value['codigo'] === $codigo) {
                return $value;
            }
        }
        return "";
    }

    function materia_restar_cupo()
    {
        $this->cupoAlumnos -= 1;
    }
}
?>