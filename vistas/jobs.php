<?php
    require_once('../modelos/jobs.php');
    require_once('../modelos/login.php');
    $listar = new Jobs();
    $login = new Login();
    $login->validarSesion();

    $title = "Tareas pendientes";
    include("head.php");

    $tareasFaltantes = $listar->contarTareasFaltantes($_SESSION['datos']['IDUsuarioPK']);
?>

<body>
    <div class="">
        <?php
            include("header.php");
            $mensajeTarea = "Ya está terminada";
            $boton = "btn-success";
            include("nav.php");
            require('../controladores/jobs.php');
        ?>
        <div class="contenedor card margin-top">
        <p class="card-2 bg-light-hover margin-bottom"><strong><span class="required">*</span><?php echo $listar->tareasMayorCero($tareasFaltantes) ? "Tienes " . $tareasFaltantes . "tareas pendientes, son pocas, animo!" : "Por el momento no tienes ninguna tarea" ?><span class="required">*</span></strong></p>
            <h1 class="text-center margin-bottom">Tareas pendientes</h1>
            <div class="jobs">
                <?php
                $usuario = $listar->selectJobs($_SESSION['datos']['IDUsuarioPK']);
                if($usuario != null){
                    foreach($usuario as $j){
                        include('div-jobs.php');
                    }
                }else{
                    $mensajeError = "No tienes tareas pendientes, felicidades!";
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