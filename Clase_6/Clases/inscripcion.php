<?php
class Inscripcion
{
    public $nombreAlumno;
    public $apellidoAlumno;
    public $mailAlumno;
    public $nombreMateria;
    public $codigoMateria;

    function __construct($nombreAlumno,$apellidoAlumno,$mailAlumno,$nombreMateria,$codigoMateria)
    {
        $this->nombreAlumno = $nombreAlumno;
        $this->apellidoAlumno = $apellidoAlumno;
        $this->mailAlumno = $mailAlumno;
        $this->nombreMateria = $nombreMateria;
        $this->codigoMateria = $codigoMateria;
    }

    function guardar_inscripcion($path)
    {
        if(file_exists($path)) 
        {
            $file = fopen($path,"r");
            $contenido = fread($file, filesize($path));
            fclose($file);
            $json = json_decode($contenido, true);
            if (!$this->inscripcion_repetida($json)) {
                array_push($json,(array) $this);
                $file = fopen($path,"w");
                fwrite($file,json_encode($json));
                echo '{"respuesta":"Alumno agregado con exito"}';
                fclose($file);
            }
            else
            {
                echo '{"respuesta":"El alumno ya se encuentra inscripto a esa materia"}';
            }
        }else 
        {
            $array_inscripciones = array();
            $file = fopen($path,"w");
            array_push($array_inscripciones,(array) $this);
            fwrite($file,json_encode($array_inscripciones));
            echo '{"respuesta":"Inscripcion creada con exito"}';
            fclose($file);
        }
        
    }

    function inscripcion_repetida($array_inscripciones)
    {
        foreach ($array_inscripciones as $elemento) {
            if ($elemento['mailAlumno'] === $this->mailAlumno && $elemento['codigoMateria'] === $this->codigoMateria)
            {
                return true;
            }
        }
        return false;
    }

    static function leer_inscripciones_json($path)
    {
        $arrayInscripciones = array();
        if(file_exists($path))
        {
            $file = fopen($path,"r");
            $contenido = fread($file, filesize($path));
            $arrayInscripciones = json_decode($contenido, true);
            fclose($file);
        }
        return $arrayInscripciones;
    }

    static function filtrar_inscripciones($array_inscripciones,$parametro)
    {
        $arrayInscripciones_filtradas = array();
        foreach ($array_inscripciones as $key => $value) {
            foreach ($value as $clave => $valor) {
                var_dump($valor);
            }
        }
    }
}
?>