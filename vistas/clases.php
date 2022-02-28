<?php
    require_once('../modelos/clases.php');
    require_once('../modelos/jobs.php');
    require_once('../controladores/validacion.php');
    $listar = new clases;

    $title = "Login";
    include("head.php");
?>

<body>
    <div class="">

        <?php
            include("header.php");
            include("nav.php");
        ?>

        <div class="contenedor card">
            <h1 class="text-center margin-bottom">Clases de la semana</h1>
            <?php

                $Usuario = $listar->listarClases(date("Y"));
                if($Usuario != null){
                    foreach($Usuario as $r){
            ?>

                        <div class="card margin-bottom">
                            <h5 class="margin-bottom"><?php echo $r['NombreClase'] . " (" . $r['HoraInicio'] . " - " . $r['HoraFin'] . ")";?></h5>
                            <a href="<?php echo $r['EnlaceClase']; ?>"><i class="icono fas fa-laptop-code"></i></a>
                            <a href="<?php echo $r['EnlacePortafolio']; ?>"><i class="icono fas fa-briefcase"></i></a>
                        </div>

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
            include("footer.php");
        ?>
    </div>
    <script src="js/nameFile.js"></script>
</body>
</html>