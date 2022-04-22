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
            <p class="card-2 bg-light-hover margin-bottom"><strong><span class="required">*</span>Estas tareas se eliminan autom&#225;ticamente despu&#233;s de 15 d&#237;as<span class="required">*</span></strong></p>
            <h1 class="text-center margin-bottom">&#218;ltimas tareas eliminadas</h1>
            <div class="jobs">
                <?php
                    $usuario = $listar->selectJobsEliminados($_SESSION['datos']['IDUsuarioPK']);
                    if($usuario != null){
                        foreach($usuario as $j){
                            include('div-jobs-eliminados.php');
                        }
                    }else{
                        $mensajeError = "No se encontraron tareas eliminadas &#218;ltimamente";
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