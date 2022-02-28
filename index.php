<?php
    require_once('modelos/clases.php');
    require_once('controladores/validacion.php');
    $listar = new clases;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vistas/css/autostyle.css">
    <link rel="stylesheet" href="vistas/css/style.css">
    <link rel="icon" href="vistas/imagenes/clase.png">
    <title>Clases - ADSI</title>
    <script src="https://kit.fontawesome.com/dca352768f.js" crossorigin="anonymous"></script>
    <!-- <script src="js/alerta.js"></script>
    <script src="js/sweetalert2.js"></script> -->
</head>
<body>
    <div class="">
        <header class="card card-2">
            <div class="header-div">
                <!-- <img src="imagenes/variedades-ampi_logo.png" alt="Logo" class="header-img"> -->
                <h1 class="header-titulo">ADSI</h1>
            </div>
            <div class="header-div">
                <a href="vistas/signup.php"><button class="btn btn-info">Registrarse</button></a>
                <a href="vistas/"><button class="btn btn-success">Iniciar sesion</button></a>
            </div>
        </header>

        <div class="contenedor card">
            <h1 class="text-center margin-bottom">Clases <?php if(diasLaborales(date("D"))){echo " de hoy";}else{echo " de la semana";}?> </h1>
            <?php
                // if(isset($_POST['consulta'])){
                //     $parametro = limpiarTexto($_POST['parametro']);
                //     if(campoNull($parametro)){
                //         $Usuario = "";
                //         echo '<script>
                //                 alertaFlotanteConRedirecion("Los datos son incorrectos", "Tiene que completar el compo para realizar la busqueda", "#0EA3E3", "imagenes/error.gif", "../vistas/Usuarios.php");
                //             </script>';
                //     }else{
                //         $Usuario = $model->obtenerUsuariosPorBusqueda($parametro);
                //     }
                // }else{
                    // }
                $Usuario = $listar->listarClases(date("D"));
                if($Usuario != null){
                    foreach($Usuario as $r){
            ?>

                        <div class="card margin-bottom">
                            <h5 class="margin-bottom"><?php echo $r['NombreClase'] . " (" . $r['HoraInicio'] . " - " . $r['HoraFin'] . ")";?></h5>
                            <a href="<?php echo $r['EnlaceClase']; ?>"><i class="icono fas fa-laptop-code"></i></a>
                            <a href="<?php echo $r['EnlacePortafolio']; ?>"><i class="icono fas fa-briefcase"></i></a>
                        </div>
                        <!-- <tr id="campoP">
                            <th class="padding"><?php echo $r['NombreClase']; ?></th>
                            <th class="padding"><a href="<?php echo $r['EnlaceClase']; ?>"><i class="icono fas fa-laptop-code"></i></a></th>
                            <th class="padding"><a href="<?php echo $r['EnlacePortafolio']; ?>"><i class="icono fas fa-briefcase"></i></a></th>
                            <th class="padding"><?php echo $r['HoraInicio'] . " - " . $r['HoraFin']; ?></th>
                        </tr> -->

                        
            <?php
                    }
                }else{
                    echo '<script>
                    alertaFlotanteConRedirecion("El usuario no se encuentra registrado", "Verifique los datos e intente nuevamente", "#0EA3E3", "imagenes/error.gif", "../vistas/usuarios.php");
                    </script>';
                }
            ?>
                <a href=""></a>
            </center>
        </div>

        <?php
            include("vistas/footer.php");
        ?>
    </div>
</body>
</html>