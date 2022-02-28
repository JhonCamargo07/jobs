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

            <h1 class="text-center margin-bottom">Iniciar sesión</h1>
            <?php require('../controladores/login.php'); ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="form-control">
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" id="usuario" class="input" maxlength="30" value="<?php if(isset($usuario)){echo $usuario;} ?>" placeholder="Escribe tu usuario" autofocus>
                </div>

                <div class="form-control">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" class="input" maxlength="30" value="<?php if(isset($password)){echo $password;} ?>" placeholder="Escribe tu contraseña">
                </div>
                <div class="text-center">
                    <input type="submit" name="generar" class="btn btn-outline-success" value="Iniciar sesión">
                </div>
            </form>
        </div>

        <?php
            include("footer.php");
        ?>
    </div>
    
</body>
</html>