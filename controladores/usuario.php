<?php
    require('validacion.php');
    require('../modelos/usuarios.php');
    require_once('../modelos/login.php');
    $usuario = new Usuario();

    //Registrar usuario
    if(isset($_POST['registrar'])){
        $nombre = ucwords(strtolower((limpiarTexto($_POST['nombre']))));
        $correo = limpiarTexto($_POST['correo']);
        $password = limpiarTexto($_POST['password']);
        $rol = isset(($_POST['rol'])) ? $_POST['rol'] : 2;
        $estado = isset(($_POST['estado'])) ? $_POST['estado'] : 1;

        if(campoNull($nombre) || campoNull($correo) || campoNull($password)){
            echo '<script>
                    alertaFlotante("Complete todos los compos", "Algunos campos están vacios", "#0EA3E3", "imagenes/error.gif");
                </script>';
        }else{
            $resultadoRegistro = $usuario->insertUsuario($nombre, $correo, $password, $rol, $estado);

            if($resultadoRegistro){
                $modelo = new Login();
                $entrada = $modelo->login($correo, $password);
                if($entrada){
                    echo '<script>
                            alertaFlotante("¡Usuario registrado exitosamente!", "El usuario fue registrado y ya tiene acceso a la plataforma", "#4DAF51", "imagenes/success.gif");
                            setInterval( ()=> {
                                location.href = "jobs.php";
                            }, 5100);
                        </script>';
                }
            }else{
                echo '<script>
                        alertaFlotante("El correo ya se encuentra registrado", "Verifique los datos e intente nuevamente", "#0EA3E3", "imagenes/error.gif");
                    </script>';
            }
        }
    }

    // Actualizar usuario
    if(isset($_POST['actualizar'])){
        $id = limpiarTexto($_POST['id']);
        $nombre = ucwords(strtolower((limpiarTexto($_POST['nombre']))));
        $tipo_doc = limpiarTexto($_POST['tipo_doc']);
        $documento = limpiarTexto($_POST['documento']);
        $rol = limpiarTexto($_POST['rol']);
        $estado = limpiarTexto($_POST['estado']);


        if(campoNull($id) || campoNull($nombre) || campoNull($tipo_doc) || campoNull($documento)){
            echo '<script>
                    alertaFlotanteConRedirecion("Complete todos los compos", "Algunos campos están vacios", "#0EA3E3", "imagenes/error.gif", "../vistas/usuarios.php");
                </script>';
        }else{
            $resultadoActualizacion = $usuario->actualizarUsuario($nombre, $tipo_doc, $documento, $rol, $estado, $id);

            if($resultadoActualizacion){
                echo '<script>
                        alertaFlotanteConRedirecion("¡Usuario actualizado exitosamente!", "Los datos del usuario ya se actualizarón", "#4DAF51", "imagenes/success.gif", "../vistas/usuarios.php");
                    </script>';
            }
        }
    }
?>