<?php
class Persona 
{
    public $nombre;
    public $dni;
      
    function __construct($nombre,$dni)
    {
        $this->nombre = $nombre;
        $this->dni = $dni;
    }

    function saludar($nombre){
        echo "Hola $nombre";
    }
}

?>