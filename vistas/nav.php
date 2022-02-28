<?php
    $eliminar = new Jobs();
    $eliminar->deleteJobsAuto();
?>
        <nav class="card-2 nav">
            <div class="nav-enlaces">
                <ul id="listaNav">
                    <a href="clases.php" id="clases"><i class="icon-nav fas fa-laptop-code"></i>Clases</a>
                    <a href="jobs.php" id="trabajos"><i class="icon-nav fas fa-users"></i>Tareas pendientes</a>
                    <a href="newTrabajo.php"id="newTrabajo"><i class="icon-nav far fa-address-card"></i><?php echo isset($_GET['id']) ? "Editar tarea" : "Crear tarea";?></a>
                    <a href="oldTrabajo.php" id="oldTrabajo"><i class="icon-nav fas fa-check-circle"></i>Tareas hechas</a>
                    <a href="../controladores/logout.php"><i class="icon-nav fas fa-sign-out-alt"></i>Salir</a>
                </ul>
            </div>
        </nav>