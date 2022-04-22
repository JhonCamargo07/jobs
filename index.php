<?php
    require_once('controladores/validacion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vistas/css/autostyle.css">
    <link rel="stylesheet" href="vistas/css/style.css">
    <link rel="icon" href="vistas/imagenes/icon-jobs.png">
    <title>Clases - ADSI</title>
    <script src="https://kit.fontawesome.com/dca352768f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body>
    <div class="">

        <div class="contenido margin-vertical">
            
            <div class="div-izquierda">
                <div class="text-center"><img src="vistas/imagenes/task.png" class="logo text-center" alt="Logo jobs"></div>
                <p><strong>Task</strong> te ayuda a recordar las actividades que tienes que hacer diariamente.</p>
            </div>

            <div class="div-derecha card">

                <form action="vistas/index.php" method="POST" id="formulario">

                    <div class="form-control margin-top">
                        <input type="text" name="usuario" id="usuario" class="input height-grande" maxlength="30" value="<?php if(isset($usuario)){echo $usuario;} ?>" placeholder="Correo electr&#243;nico" autofocus>
                        <div><p class="mensaje__input-error" id="mensaje-error">El correo es obligatorio</p></div>
                    </div>

                    <div class="form-control">
                        <input type="password" name="password" id="password" class="input height-grande" maxlength="30" value="<?php if(isset($password)){echo $password;} ?>" placeholder="Contraseña">
                        <i class="eye fas fa-eye-slash" id="icono"></i>
                        <div><p class="mensaje__input-error" id="mensaje-error2">La contrase&#241;a es obligatoria</p></div>
                    </div>
                    
                    <div class="text-center">
                        <input type="submit" name="ingresar" class="btn btn-primary height-grande width-grande" value="Iniciar sesi&#243;n">
                    </div>
                    <p class="text-center margin-vertical"><a href="" class="color-primary">¿Olvidaste tu contraseña?</a></p>
                    <hr class="linea">

                </form>
                <div class="text-center margin-top">
                    <a href="vistas/signup.php"><button class="btn btn-success height-mediano width-mediano">Crear una cuenta</button></a>
                </div>

            </div>

        </div>

        <?php
            include("vistas/footer.php");
        ?>
    </div>
    <script src="vistas/js/validacion.js"></script>
</body>
</html>