<?php
    class Pizza{
        public $id;
        public $precio;
        public $tipo;
        public $cantidad;
        public $sabor;
        public $imagen;
        public $foto;

        public function __construct($id, $precio, $tipo, $cantidad, $sabor, $imagen, $foto){
            $this->id = $id;
            $this->precio = $precio;
            $this->tipo = $tipo;
            $this->cantidad = $cantidad;
            $this->sabor = $sabor;
            $this->foto = $foto;
            $this->imagen = $imagen;
        }

        public function toJSON(){
            return json_encode($this);
        }

        public static function alta($objeto){
            Archivo::guardarUno('./Archivos/pizzas.txt', $objeto);
        }

        public static function validarTipo($tipo){
            return (strcasecmp($tipo, 'molde') == 0 || strcasecmp($tipo, 'piedra') == 0) ? true : false;
        }

        public static function validarSabor($sabor){
            return (strcasecmp($sabor, 'muzza') == 0 || strcasecmp($sabor, 'jamon') == 0 || strcasecmp($sabor, 'especial') == 0) ? true : false;
        }

        public static function validarCombinacion($tipo, $sabor){
            $pizzas = Pizza::retornarPizzas();
            foreach($pizzas as $item){
                if(strcasecmp($item->sabor, $sabor) == 0 && strcasecmp($item->tipo, $tipo) == 0)
                    return true;
            }
            return false;
        }

        public static function retornarPizzas(){
            $datos = Archivo::leerArchivo('./Archivos/pizzas.txt');
            $pizzas = array();
            foreach ($datos as $key => $value) {
                $pizza = new Pizza($value->id, $value->precio, $value->tipo, $value->cantidad, $value->sabor, $value->imagen, $value->foto);
                array_push($pizzas, $pizza);
            }
            return $pizzas;
        }

        public static function generarNuevoId(){
            $rutaArchivo = './Archivos/id.txt';      
            $archivo = fopen($rutaArchivo, 'r');
            $ultimoId = fgets($archivo);
            fclose($archivo);
            $nuevoId = number_format($ultimoId) + 1;
            $nuevoArchivo = fopen($rutaArchivo, 'w');
            fwrite($nuevoArchivo, $nuevoId);
            return $nuevoId;
        }

        public static function mostrarDisponible($tipo, $sabor){
            $datos = Pizza::retornarPizzas();
            $saborCount = 0; $tipoCount = 0;
            foreach($datos as $item){
                if(strcasecmp($item->sabor, $sabor) == 0)
                    $saborCount += $item->cantidad;
                if(strcasecmp($item->tipo, $tipo) == 0)
                    $tipoCount += $item->cantidad;
            }
            echo 'Hay ' .$saborCount. ' del sabor: ' .$sabor .PHP_EOL;
            echo 'Hay ' .$tipoCount. ' del tipo: ' .$tipo .PHP_EOL;
        }

        public static function existeId($id){
            $pizzas = Pizza::retornarPizzas();
            foreach($pizzas as $item){
                if(strcasecmp($item->id, $id) == 0)
                    return true;
            }
            return false;
        }
        
        public static function modificar($datos, $img){
            $lista = Pizza::retornarPizzas();
            foreach( $lista as $item ){
                if(strcasecmp($item->id, $datos['id']) == 0){
                    $origen = $img['imagen']->file;
                    $nombreImagen = $img['imagen']->getClientFilename();
                    $ext = pathinfo($nombreImagen, PATHINFO_EXTENSION);
                    $destinoImagen = $item->imagen;
                    if(file_exists($destinoImagen)){
                        copy($destinoImagen,"./backUp/".$item->id."_imagen".date("Ymd").".".$ext);
                    }
                    move_uploaded_file($origen, $destinoImagen);
                    $origen2 = $img['foto']->file;
                    $nombreFoto = $img['foto']->getClientFilename();
                    $ext2 = pathinfo($nombreFoto, PATHINFO_EXTENSION);
                    $destinoFoto = $item->foto;
                    if(file_exists($destinoFoto)){
                        copy($destinoFoto,"./backUp/".$item->id."_foto".date("Ymd").".".$ext2);
                    }
                    move_uploaded_file($origen2, $destinoFoto);
                    $item->tipo = $datos['tipo'];
                    $item->sabor = $datos['sabor'];
                    $item->cantidad = $datos['cantidad'];
                    
                    break;
                }
            }
            echo '{"mensaje":"Modificacion exitosa"}';
            Archivo::guardarTodos('./Archivos/pizzas.php', $lista);
        }   
       
    }
?>