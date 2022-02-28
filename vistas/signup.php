<?php
    $title = "Login";
    include("head.php");
?>
<body>
    <div class="">

        <?php
            include("header.php");
        ?>
        
        <div class="card card-login margin-top">

            <h1 class="text-center margin-bottom">Registrarse</h1>
            <?php require('../controladores/usuario.php'); ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="form-control">
                    <label for="nombre">Primer nombre y apellido <span class="required">*</span></label>
                    <input type="text" name="nombre" id="nombre" class="input" maxlength="70" value="<?php echo isset($nombre) ? $nombre : ""; ?>" placeholder="Ejemplo: John Doe" title="Escribe solo el primer nombre y el primer apellido" autofocus>
                </div>
                <div class="form-control">
                    <label for="correo">Correo electronico<span class="required">*</span></label>
                    <input type="email" name="correo" id="correo" class="input" maxlength="100" value="<?php echo isset($correo) ? $correo : "";?>" placeholder="Ejemplo: JohnDoe27" title="Escribe un usuario">
                </div>

                <div class="form-control">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" class="input" maxlength="40" value="<?php echo isset($password) ? $password : ""; ?>" placeholder="Escribe tu contraseña" title="Una contraseña que sea segura">
                </div>
                <p id="btn-password" class="btn btn-info">Generar contraseña</p>
                <div class="text-center">
                    <input type="submit" name="registrar" class="btn btn-outline-success" value="Registrarme">
                </div>
            </form>
        </div>

        <?php
            include("footer.php");
        ?>
    </div>
    <script src="js/generador-password.js"></script>
</body>
</html>