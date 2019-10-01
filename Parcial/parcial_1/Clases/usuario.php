<?php
class Usuario
{
    public $legajo;
    public $email;
    public $nombre;
    public $clave;
    public $foto_1;
    public $foto_2;
      
    function __construct($legajo,$email,$nombre,$clave,$foto_1,$foto_2)
    {
        $this->legajo = $legajo;
        $this->email = $email;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->foto_1 = $legajo . $foto_1;
        $this->foto_2 = $legajo . $foto_2;
    }

    function guardar_usuario_json($path)
    {
        if(file_exists($path)) 
        {
            $file = fopen($path,"r");
            $contenido = fread($file, filesize($path));
            fclose($file);
            $json = json_decode($contenido, true);
            if (!Usuario::buscar_usuario_legajo($json,$this->legajo)) {
                array_push($json,(array) $this);
                $file = fopen($path,"w");
                fwrite($file,json_encode($json));
                fclose($file);
                echo '{"respuesta":"Usuario agregado con exito"}';
            }
            else
            {
                echo '{"respuesta":"El legajo ya existe en la lista de usuarios"}';
            }
        } 
        else 
        {
            $array_usuarios = array();
            $file = fopen($path,"w");
            array_push($array_usuarios,(array) $this);
            fwrite($file,json_encode($array_usuarios));
            echo '{"respuesta":"Usuario agregado con exito"}';
            fclose($file);
        }
        
    }

    static function buscar_usuario_legajo($arrayUsuarios,$legajo)
    {
        $arrayUsuariosEncontrados = array();
        foreach ($arrayUsuarios as $value) {
            if ((strcasecmp($value['legajo'],$legajo) == 0)) {
                array_push($arrayUsuariosEncontrados,$value);
            }
        }
        return $arrayUsuariosEncontrados;
    }

    function buscar_usuario_legajo_instancia($arrayUsuarios)
    {
        $arrayUsuariosEncontrados = array();
        foreach ($arrayUsuarios as $value) {
            if ((strcasecmp($value['legajo'],$this->legajo) == 0)) {
                return $value;
            }
        }
        return false;
    }

    static function leer_usuarios_json($path)
    {
        $arrayUsuarios = array();
        if(file_exists($path))
        {
            $file = fopen($path,"r");
            $contenido = fread($file, filesize($path));
            $arrayUsuarios = json_decode($contenido, true);
            fclose($file);
        }
        return $arrayUsuarios;
    }

    static function buscar_usuarios($arrayUsuarios,$legajo,$clave)
    {
        $arrayUsuariosEncontrados = array();
        foreach ($arrayUsuarios as $value) {
            if ((strcasecmp($value['legajo'],$legajo) == 0) && (strcasecmp($value['clave'],$clave) == 0)) {
                array_push($arrayUsuariosEncontrados,$value);
            }
        }
        return $arrayUsuariosEncontrados;
    }

    function modificar_usuario($path)
    {
        if(file_exists($path)) 
        {
            $file = fopen($path,"r");
            $contenido = fread($file, filesize($path));
            fclose($file);
            $json = json_decode($contenido, true);
            $usuarios = $this->buscar_usuario_legajo($json,$this->legajo);
            if($usuarios)
            {
                foreach ($json as $key => $value) {
                    if($json[$key]['legajo'] == $this->legajo)
                    {
                        $json[$key]['email'] = $this->email;
                        $json[$key]['nombre'] = $this->nombre;
                        $json[$key]['clave'] = $this->clave;
                        $json[$key]['foto_1'] = $this->foto_1;
                        $json[$key]['foto_2'] = $this->foto_2;
                    }
                }
                $file = fopen($path,"w");
                fwrite($file,json_encode($json));
                fclose($file);
                echo '{"respuesta":"Usuario editado con exito"}';
            }
        }
        else
        {
            echo '{"respuesta":"No existe lista de usarios"}';
        }
    }
}
?>