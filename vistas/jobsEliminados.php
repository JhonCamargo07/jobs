<?php
    require_once('../modelos/jobs.php');
    require_once('../modelos/login.php');
    $listar = new Jobs();
    $login = new Login();
    $login->validarSesion();

    $title = "Tareas eliminadas";
    include("head.php");
?>

<body>
    <div class="">
        <?php
            include("header.php");
            $mensajeTarea = "Restablecer tarea";
            $boton = "btn-success";
            include("nav.php");
            require('../controladores/jobs.php');
        ?>
        <div class="contenedor card margin-top">
            <p class="card-2 bg-light-hover margin-bottom"><strong><span class="required">*</span>Estos trabajos se eliminan automaticamente despues de 15 días<span class="required">*</span></strong></p>
            <h1 class="text-center margin-bottom">Últimas tareas eliminadas</h1>
            <div class="jobs">
                <?php
                    $usuario = $listar->selectJobsEliminados($_SESSION['datos']['IDUsuarioPK']);
                    if($usuario != null){
                        foreach($usuario as $j){
                            include('div-jobs-eliminados.php');
                        }
                    }else{
                        $mensajeError = "No se encontraron tareas eliminadas ultimamente";
                        include('div-error.php');
                    }
                ?>
            </div>
        </div>
        <?php
            include("footer.php");
        ?>
    </div>
    <script src="js/nameFile.js"></script>
</body>
</html>