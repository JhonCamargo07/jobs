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
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://kit.fontawesome.com/dca352768f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row mt-5 mb-3">
            <div class="col-12 col-md-7 d-flex justify-content-center align-items-center">
                <div class="mb-2 px-4">
                    <div class="text-center"><img src="vistas/imagenes/task.png" loading="lazy" class="img-fluid logo text-center" alt="Logo jobs"></div>
                    <p class="text-22 text-center"><strong>Task</strong> te ayuda a recordar las actividades que tienes que hacer diariamente.</p>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="card mb-2 border-0 shadow">
                    <h3 class="text-center fw-bold">Iniciar sesi&#243;n</h3>
                    <form action="vistas/index.php" method="POST" id="formulario">
                        <div class="mb-3 mt-4">
                            <input type="text" name="usuario" id="usuario" class="form-control height-grande" maxlength="30" value="<?php if (isset($usuario)) {echo $usuario;} ?>" placeholder="Correo electr&#243;nico" autofocus>
                            <div>
                                <p class="mensaje__input-error" id="mensaje-error">El correo es obligatorio</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <input type="password" name="password" id="password" class="input form-control height-grande" maxlength="30" value="<?php if (isset($password)) {echo $password;} ?>" placeholder="Contraseña">
                            <i class="eye fas fa-eye-slash" id="icono"></i>
                            <div>
                                <p class="mensaje__input-error" id="mensaje-error2">La contrase&#241;a es obligatoria</p>
                            </div>
                        </div>

                        <div class="text-center">
                            <input type="submit" name="ingresar" class="btn btn-primary text-10 text-white height-grande w-75 btn-lg" value="Iniciar sesi&#243;n">
                        </div>
                        <p class="text-center mb-1 mt-2"><a href="" class="text-primary">Olvid&#233; mi contrase&#241;a</a></p>
                        <hr class="linea">
                    </form>
                    <div class="text-center">
                        <a href="vistas/signup.php"><button class="btn btn-success height-grande w-75 btn-lg">Crear una cuenta</button></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <?php
    include("vistas/footer.php");
    ?>

    <script src="vistas/js/validacion.js"></script>
</body>

</html>