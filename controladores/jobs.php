<?php
    require_once('../modelos/jobs.php');
    require_once('../modelos/login.php');
    require_once('validacion.php');
    $job = new Jobs();
    $idUsuario = $_SESSION['datos']['IDUsuarioPK'];

    if(isset($_POST['updateEstado'])){
        $id = limpiarTexto($_POST['id']);
        $estadoEnviado = limpiarTexto($_POST['estado']);
        $estado = 1;
        if($estadoEnviado == 1){
            $estado = 2;
        }else{
            $estado = 1;
        }
        $update = $job->updateJob($estado, $id, $idUsuario);
        if($update && $estadoEnviado == 1){
            echo '<script>
                    alertaFlotanteConRedirecion("¡Felicidades!", "Ahora tienes más tiempo libre", "#76B03D", "imagenes/success.gif", "../vistas/jobs.php");
                </script>';
        }elseif($update && $estadoEnviado == 2){
            echo '<script>
                    alertaFlotanteConRedirecion("¡Tarea pendiente!", "No olvides realizarla lo más pronto posible", "#0EA3E3", "imagenes/error.gif", "../vistas/jobs.php");
                </script>';
        }else{
            echo '<script>
                    alertaFlotanteConRedirecion("No se pudo completar la acción", "Nuestro sitio experimenta fallos en este momento", "#0EA3E3", "imagenes/error.gif", "../vistas/jobs.php");
                </script>';
        }
    }

    if(isset($_POST['registrar'])){
        $titulo = limpiarTexto($_POST['titulo']);
        $descripcion = limpiarTexto($_POST['descripcion']);
        $fechaLimite = limpiarTexto($_POST['fechaLimite']);

        if(campoNull($titulo) || campoNull($fechaLimite)){
            echo '<script>
                    alertaFlotante("Error en los datos", "El titulo y la fecha son requeridos", "#0EA3E3", "imagenes/error.gif");
                </script>';
        }else{
            $insercion = $job->insertJob($titulo, $descripcion, $fechaLimite, 1, $idUsuario);
            if($insercion){
                echo '<script>
                    alertaFlotanteConRedirecion("¡Tarea agregada exitosamente!", "La tarea está pendiente por realizar", "#76B03D", "imagenes/success.gif", "../vistas/jobs.php");
                </script>';
            }else{
                echo '<script>
                        alertaFlotanteConRedirecion("No se pudo completar la acción", "Nuestro sitio experimenta fallos en este momento", "#0EA3E3", "imagenes/error.gif", "../vistas/jobs.php");
                    </script>';
            }
        }
    }

    if(isset($_POST['actualizar'])){
        $titulo = limpiarTexto($_POST['titulo']);
        $descripcion = limpiarTexto($_POST['descripcion']);
        $fechaLimite = limpiarTexto($_POST['fechaLimite']);
        $idJob = limpiarTexto($_POST['id']);

        if(campoNull($titulo) || campoNull($fechaLimite) || campoNull($idJob)){
            echo '<script>
                    alertaFlotante("Error en los datos", "El titulo y la fecha son requeridos", "#0EA3E3", "imagenes/error.gif");
                </script>';
        }else{
            $actualizacion = $job->updateTarea($titulo, $descripcion, $fechaLimite, $idJob, $idUsuario);
            if($actualizacion){
                echo '<script>
                    alertaFlotanteConRedirecion("¡Tarea actualizada exitosamente!", "La tarea fue actualizada en la base de datos", "#76B03D", "imagenes/success.gif", "../vistas/jobs.php");
                </script>';
            }else{
                echo '<script>
                        alertaFlotanteConRedirecion("No se pudo completar la acción", "Nuestro sitio experimenta fallos en este momento", "#0EA3E3", "imagenes/error.gif", "../vistas/jobs.php");
                    </script>';
            }
        }
    }

    if(isset($_POST['deleteJob'])){
        $idJob = limpiarTexto($_POST['id']);

        $delete = $job->deleteJob($idJob, $idUsuario);
        if($delete){
            echo '<script>
                    alertaFlotanteConRedirecion("¡Tarea eliminada exitosamente!", "La tarea ya se eliminó de base de datos", "#76B03D", "imagenes/success.gif", "../vistas/jobs.php");
                </script>';
        }else{
            echo '<script>
                        alertaFlotanteConRedirecion("No se pudo completar la acción", "Nuestro sitio experimenta fallos en este momento", "#0EA3E3", "imagenes/error.gif", "../vistas/jobs.php");
                    </script>';
        }
    }

    if(isset($_POST['restablecerJob'])){
        $idJob = limpiarTexto($_POST['idJobE']);
        // $fEliminacion = limpiarTexto($_POST['fEliminacion']);
        $tituloJob = limpiarTexto($_POST['tituloJob']);
        $descripcion = limpiarTexto($_POST['descripcion']);
        // $fCreacion = limpiarTexto($_POST['fCreacion']);
        $fLimite = limpiarTexto($_POST['fLimite']);
        $estadoJob = limpiarTexto($_POST['estadoJob']);
        // echo $fCreacion . "<br>";

        // echo "$idJob <br>";
        // echo "$tituloJob <br>";
        // echo $descripcion . "<br>";
        // echo $fLimite . "<br>";
        // echo $estadoJob . "<br>";
        // echo $idUsuario . "<br>";

        $insert = $job->insertJob($tituloJob, $descripcion, $fLimite, $estadoJob, $idUsuario);
        if($insert){
            $delete = $job->deleteJobEliminado($idJob, $idUsuario);
            if($delete){
                echo '<script>
                        alertaFlotanteConRedirecion("¡Tarea restaurada exitosamente!", "La tarea logró ser recuperada", "#76B03D", "imagenes/success.gif", "../vistas/jobs.php");
                    </script>';
            }else{
                echo '<script>
                            alertaFlotanteConRedirecion("No se pudo completar la acción", "Nuestro sitio experimenta fallos en este momento", "#0EA3E3", "imagenes/error.gif", "../vistas/jobs.php");
                        </script>';
            }
        }else{
            echo '<script>
                        alertaFlotanteConRedirecion("No se pudo completar la acción", "Nuestro sitio experimenta fallos en este momento", "#0EA3E3", "imagenes/error.gif", "../vistas/jobs.php");
                    </script>';
        }
    }
?>