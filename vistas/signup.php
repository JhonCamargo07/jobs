<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/autostyle.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="imagenes/icon-jobs.png">
    <title>Clases - ADSI</title>
    <script src="https://kit.fontawesome.com/dca352768f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="js/alerta.js"></script>
    <script src="js/sweetalert2.js"></script>
</head>
<body>
    <div class="">
        
        <div class="contenido margin-vertical">
            
            <div class="div-izquierda">
                <div class="text-center"><img src="imagenes/task.png" class="logo text-center" alt="Logo jobs"></div>
                <p><strong>Task</strong> te ayuda a recordar las actividades que tienes que hacer diariamente.</p>
            </div>

            <div class="div-derecha card">

                <?php require('../controladores/usuario.php'); ?>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="formulario">
                    <div class="form-control">
                        <!-- <label for="nombre">Primer nombre y apellido <span class="required">*</span></label> -->
                        <input type="text" name="nombre" id="nombre" class="input height-grande" maxlength="70" value="<?php echo isset($nombre) ? $nombre : ""; ?>" placeholder="Nombre" title="Escribe solo el primer nombre y el primer apellido. Ejemplo: John Doe" autofocus>
                        <div><p class="mensaje__input-error" id="mensaje-error3">El nombre es obligatorio</p></div>
                    </div>
                    <div class="form-control">
                        <!-- <label for="correo">Correo electronico<span class="required">*</span></label> -->
                        <input type="email" name="usuario" id="usuario" class="input height-grande" maxlength="100" value="<?php echo isset($correo) ? $correo : "";?>" placeholder="Correo electr&#243;nico valido" title="Escribe tu correo electr&#243;nico. Debe ser un correo valido para poder recuperrar la contraseña">
                        <div><p class="mensaje__input-error" id="mensaje-error">El correo es obligatorio</p></div>
                    </div>

                    <div class="form-control">
                        <!-- <label for="password">Contraseña:</label> -->
                        <input type="password" name="password" id="password" class="input height-grande width-grande" maxlength="40" value="<?php echo isset($password) ? $password : ""; ?>" placeholder="Contraseña" title="Escribe una contraseña que sea segura">
                        <i class="eye fas fa-eye-slash" id="icono"></i>
                        <div><p class="mensaje__input-error" id="mensaje-error2">La contrase&#241;a es obligatoria</p></div>
                    </div>
                    <!-- <p id="btn-password" class="btn btn-info">Generar contraseña</p> -->
                    <div class="text-center margin-bottom">
                        <input type="submit" name="registrar" class="btn btn-primary width-grande height-mediano" value="Registrarme">
                    </div>
                </form>

                <hr class="linea">
                <div class="text-center margin-top">
                    <a href="../"><button class="btn btn-success height-mediano width-mediano">Iniciar sesión</button></a>
                </div>

            </div>

        </div>

        <?php
            include("footer.php");
        ?>
    </div>
    <script src="js/validacion.js"></script>
</body>
</html>