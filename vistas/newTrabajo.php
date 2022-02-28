<?php
    require_once('../modelos/login.php');
    require_once('../modelos/jobs.php');
    $login = new Login();
    $login->validarSesion();
    $job = new Jobs();


    $title = isset($_GET['id']) ? "Actualizar tarea" : "Crear tarea";
    include("head.php");

?>
<body>
    <div class="">
        <?php

            if(isset($_GET['id'])){
                $editar = $job->Obtener($_GET['id'], $_SESSION['datos']['IDUsuarioPK']);
                if($editar == false){
                    echo '<script>
                        alertaFlotanteConRedirecion("No se pudo completar la acción", "Nuestro sitio experimenta fallos en este momento", "#0EA3E3", "imagenes/error.gif", "../vistas/jobs.php");
                    </script>';
                }
            }

            include("header.php");
            include("nav.php");
            require_once("../controladores/jobs.php");
        ?>
        <div class="contenedor card margin-top">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> " method="POST" enctype="multipart/form-data">
                <!--Información personal-->
                <h2 class="text-center"><?php echo isset($_GET['id']) ? "Actualizar tarea" : "Asignar una nueva tarea"; ?></h2>
            
                <div class="form-group">
                    <label for="nombre">Titulo <span class="required">*</span></label><br>
                    <input type="text" name="titulo" id="titulo" class="input" placeholder="Ejemplo: Taller de inglés" title="Ejemplo: Taller de inglés" value="<?php echo isset($titulo) ? $titulo : ""; echo isset($_GET['id']) ? $editar['TituloJob'] : "" ; ?>" required>
                </div>

                <div class="form-group">
                    <label for="nombre">Descripción</label><br>
                    <textarea name="descripcion" id="descripcion" cols="40" rows="6" class="input" placeholder="Realizar el punto #5 de la guía de inglés"><?php echo isset($descripcion) ? $descripcion : ""; echo isset($_GET['id']) ? $editar['Descripcion'] : "" ; ?></textarea>
                    <?php
                        if(isset($_GET['id'])){
                    ?>
                            <input type="hidden" name="id" value="<?php echo $editar['IDJobPK']; ?>">
                    <?php
                        }
                    ?>
                </div>
                
                <div class="form-group">
                    <label for="documento">Fecha de entrega <span class="required">*</span></label><br>
                    <input type="date" name="fechaLimite" id="fechaLimite" class="input" value="<?php echo isset($fechaLimite) ? $fechaLimite : ""; echo isset($_GET['id']) ? $editar['FechaLimite'] : "" ; ?>" required>
                </div>

                <center>
                    <input type="submit" name="<?php echo isset($_GET['id']) ? "actualizar" : "registrar" ?>" value="<?php echo isset($_GET['id']) ? "Actualizar" : "Registrar" ?>" class="btn btn-outline-success" formnovalidate>
                </center><br>
            </form>
        </div>
        <?php
            include("footer.php");
        ?>
    </div>
    <script src="js/nameFile.js"></script>
</body>
</html>