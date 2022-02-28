<?php
    require_once('../modelos/jobs.php');
    require_once('../modelos/login.php');
    $listar = new Jobs();
    $login = new Login();
    $login->validarSesion();

    $title = "Tareas realizadas";
    include("head.php");
?>

<body>
    <div class="">
        <?php
            include("header.php");
            $mensajeTarea = "No está terminada";
            $boton = "btn-danger";
            include("nav.php");
            require('../controladores/jobs.php');
        ?>
        <div class="contenedor card margin-top">
            <p class="card-2 bg-light-hover margin-bottom"><strong><span class="required">*</span>Los trabajos que ya están terminados se eliminan automaticamente despues de 15 días<span class="required">*</span></strong></p>
            <h1 class="text-center margin-bottom">Trabajos realizados</h1>
            <div class="jobs">
                <?php
                $usuario = $listar->selectJobsHechos($_SESSION['datos']['IDUsuarioPK']);
                if($usuario != null){
                    foreach($usuario as $j){
                        include('div-jobs.php');
                    }
                }else{
                    $mensajeError = "No hay tareas terminadas por el momento";
                    include('div-error.php');
                }
                ?>
                <a href="jobsEliminados.php">Recuperar tarea eliminada</a>
            </div>
        </div>
        <?php
            include("footer.php");
        ?>
    </div>
    <script src="js/nameFile.js"></script>
</body>
</html>