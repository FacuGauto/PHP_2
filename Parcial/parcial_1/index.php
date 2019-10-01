<?php
include "./Clases/usuario.php";
$dato = $_SERVER['REQUEST_METHOD'];
$path_usuarios = "./usuarios.json";
//var_dump($_SERVER);

if ($dato == "POST") {
    if($_POST['caso'] == "cargarUsuario")
    {
        if (!empty($_POST['legajo'])) 
        {
            if (!empty($_POST['email'])) 
            {
                if (!empty($_POST['nombre'])) 
                {
                    if (!empty($_POST['clave'])) 
                    {
                        if (!empty($_FILES['foto_1'])) 
                        {
                            if (!empty($_FILES['foto_2'])) 
                            {
                                $img_1_origen = $_FILES['foto_1']['tmp_name'];
                                $img_1_destino = "./img/fotos/" . $_FILES['foto_1']['name'];
                                $result_img_1 = move_uploaded_file($img_1_origen,$img_1_destino);

                                $img_2_origen = $_FILES['foto_2']['tmp_name'];
                                $img_2_destino = "./img/fotos/" . $_FILES['foto_2']['name'];
                                $result_img_2 = move_uploaded_file($img_2_origen,$img_2_destino);

                                if ($result_img_1 == true && $result_img_2 == true) {

                                    $legajo = $_POST['legajo'];
                                    $email = $_POST['email'];
                                    $nombre = $_POST['nombre'];
                                    $clave = $_POST['clave'];
                                    $foto_1 = $_FILES['foto_1']['name'];
                                    $foto_2 = $_FILES['foto_2']['name'];
                                    $usuario = new Usuario($legajo,$email,$nombre,$clave,$foto_1,$foto_2);
                                    $usuario->guardar_usuario_json($path_usuarios);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    if($_POST['caso'] == "modificarUsuario")
    {
        if (!empty($_POST['legajo'])) 
        {
            if (!empty($_POST['email'])) 
            {
                if (!empty($_POST['nombre'])) 
                {
                    if (!empty($_POST['clave'])) 
                    {
                        if (!empty($_FILES['foto_1'])) 
                        {
                            if (!empty($_FILES['foto_2'])) 
                            {
                                $legajo = $_POST['legajo'];
                                $email = $_POST['email'];
                                $nombre = $_POST['nombre'];
                                $clave = $_POST['clave'];
                                $foto_1 = $_FILES['foto_1']['name'];
                                $foto_2 = $_FILES['foto_2']['name'];

                                $img_1_origen = $_FILES['foto_1']['tmp_name'];
                                $img_1_destino = "./img/backup/" . $_FILES['foto_1']['name'];
                                $result_img_1 = move_uploaded_file($img_1_origen,$img_1_destino);

                                $img_2_origen = $_FILES['foto_2']['tmp_name'];
                                $img_2_destino = "./img/backup/" . $_FILES['foto_2']['name'];
                                $result_img_2 = move_uploaded_file($img_2_origen,$img_2_destino);
                                $usuario = new Usuario($legajo,$email,$nombre,$clave,$foto_1,$foto_2);
                                //var_dump($usuario);
                                if ($result_img_1 == true && $result_img_2 == true) {
                                    $usuario->modificar_usuario($path_usuarios);
                                }
                               
                            }
                        }
                    }
                }
            }
        }
        
    }
}
if ($dato == "GET")
{
    if($_GET['caso'] == "login")
    {
        if (!empty($_GET['legajo'])) 
        {
            if (!empty($_GET['clave'])) 
            {
                $arrayUsuarios = Usuario::leer_usuarios_json($path_usuarios);
                $legajo = $_GET['legajo'];
                $clave = $_GET['clave'];

                $usuariosEncontrados = Usuario::buscar_usuarios($arrayUsuarios,$legajo,$clave);
                if (!empty($usuariosEncontrados)) {
                    echo json_encode($usuariosEncontrados);
                }else{
                    echo '{"respuesta":"No se encontraron usuarios con esa clave y legajo"}';
                }
            }
            else
            {
                echo '{"respuesta":"Falta ingresar la clave"}';    
            }
        }
        else
        {
            echo '{"respuesta":"Falta ingresar el legajo"}';
        }
    }
    if($_GET['caso'] == "verUsuario")
    {
        var_dump($_GET['legajo']);
        $array_usuario = Usuario::buscar_usuario_legajo($json,$_GET['legajo']);
    }
}

?>