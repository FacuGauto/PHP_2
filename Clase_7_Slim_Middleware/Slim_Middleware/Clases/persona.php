<?php
class Persona 
{
    public $nombre;
    public $apellido;
      
    function __construct($nombre,$apellido)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }
    function saludar($nombre){
        echo "Hola $nombre";
    }
}
?>
