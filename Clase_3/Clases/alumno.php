<?php
class Alumno extends Persona
{
    public $legajo;
    public $cuatrimestre;
    public $imagen;
      
    function __construct($nombre,$dni,$legajo,$cuatrimestre,$imagen)
    {
        parent::__construct($nombre,$dni);
        $this->legajo = $legajo;
        $this->cuatrimestre = $cuatrimestre;
        $this->imagen = $imagen;
    }

    static function datos()
    {
        return $this->nombre . "," . $this->dni . "," . $this->legajo . "," . $this->cuatrimestre;
    }
}
?>