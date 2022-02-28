<?php
    require_once('../modelos/login.php');
    require_once('validacion.php');
    if($_POST){ // Si envian el formulario, crea unas variables.
        // Con la funcion ltrim y rtrim quitamos los posibles espacios que pueda tener cada dato al inicio y al final.
        $usuario = limpiarTexto($_POST['usuario']);
        $password = limpiarTexto($_POST['password']);

        // La función 'campoNull' verifica si el campo que se le pasa está vacío o no.
        if(campoNull($usuario) || campoNull($password)){
            echo '<script language="javascript">
                    alertaFlotante("Error en los datos", "Verifiquelos e intente nuevamente", "#0EA3E3", "imagenes/error.gif");
                </script>';
        }elseif(numCharacters($usuario, 3, 30) || numCharacters($password, 5, 30)){
            // La función 'NumCharacters' verifica si la cantidad de caracteres de un elemento está entre el rango que se le pase.
            echo '<script>
                    alertaFlotante("Error en la cantidad de caracteres", "Caracteres miminos: 3, maximos: 30", "#0EA3E3", "imagenes/error.gif");
                </script>';
        }else{
            // Variable para recibir lo que devuelva la funcion login del modelo.
            $modelo = new Login();
            // La función 'limpiarTexto' elimina caracteres no permitidos como <>'\...
            $entrada = $modelo->login($usuario, $password);
            // Si lo que devuelve la función es false, lo redireciona a login.
            if($entrada == false){
                echo '<script>
                        alertaFlotante("Error en los datos", "Verifiquelos e intente nuevamente", "#0EA3E3", "imagenes/error.gif");
                    </script>';
            }else{
                if($modelo->validarEstado()){

                    echo "<script>
                            alertaFlotante('El usuario ya votó', 'El usuario ya eligió a un presidente, por ende, no puede votar nuevamente', '#0EA3E3', 'imagenes/error.gif');
                        </script>";
                }else{
                    // Si lo que devuelve la funcion es true (estado activo), lo deja ingresar al menu.
                    header('Location: jobs.php');
                }
            }
        }
    }
?>
