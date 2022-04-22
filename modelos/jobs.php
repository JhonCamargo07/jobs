<?php
    require_once('conexion.php');
    require_once('../controladores/validacion.php');
    class Jobs{
        private $pdo;
        
        // el constructor llama a la funcion que conecta a la bd
        public function __construct(){
            try {
                $this->pdo = Conexion::startUp();
            } catch (Exception $j) {
                echo "Error al conectarse con la base de datos.";
                die($j->getMessage());
            }
        }

        // Metodo para registrar todas las acciones que se realicen en la base de datos
        public function historialSql($tablaAfectada, $accion, $idUser){
            $equipo = gethostname();
            $nombreUsuarioEquipo = get_current_user();
            $insert = $this->pdo->prepare("CALL sp_insert_historial(:tablaAfectada, :accion, :equipo, :nombreUsuarioEquipo, :idUser)");
            $insert->bindParam(":tablaAfectada", $tablaAfectada);
            $insert->bindParam(":accion", $accion);
            $insert->bindParam(":equipo", $equipo);
            $insert->bindParam(":nombreUsuarioEquipo", $nombreUsuarioEquipo);
            $insert->bindParam(":idUser", $idUser);
            $insert->execute();
        }

        // Función para listar los trabajos que aun no entén hechos
        public function selectJobs($id){
            $rows = null;
            $select = $this->pdo->prepare("CALL sp_select_job_asc(1, :id)");
            $select->bindParam(":id", $id);
            if($select->execute()){
                while($resultado = $select->fetch()){
                    $rows[] = $resultado;
                }
            }
            return $rows;
            $rows = null;
            $select == null;
        }

        // Metodo para selecionar todos los trabajos de un solo usuario
        public function Obtener($idJob, $idUser){
            $rows = null;
            $stm = $this->pdo->prepare("SELECT * FROM job WHERE IDJobPK = :idJob AND IDUsuarioFK = :idUser");
            $stm->bindParam(':idJob', $idJob);
            $stm->bindParam(':idUser', $idUser);
            if($stm->execute()){
                $rows = $stm->fetch();
                return $rows;
            }else{
                return false;
            }
        }

        // Metodo para contar el numero de tareas que falta por terminar
        public function contarTareasFaltantes($idUser){
            $rows = null;
            $stm = $this->pdo->prepare("SELECT COUNT(IDJobPK) FROM job WHERE EstadoJob = 1 AND IDUsuarioFK = :idUser");
            $stm->bindParam(':idUser', $idUser);
            if($stm->execute()){
                $rows = $stm->fetchColumn();
                return $rows;
            }else{
                return false;
            }
        }

        // Metodo para listar a todos los trabajos que ya estén hechos
        public function selectJobsHechos($id){
            $rows = null;
            $select = $this->pdo->prepare("CALL sp_select_job_desc(2, :id)");
            $select->bindParam(":id", $id);
            if($select->execute()){
                while($resultado = $select->fetch()){
                    $rows[] = $resultado;
                }
            }
            return $rows;
            $rows = null;
            $select == null;
        }

        // Metodo para insertar en la tabla job
        public function insertJob($titulo, $descripcion, $fechaLimite, $EstadoJob, $id){
            $insert = $this->pdo->prepare("INSERT INTO job VALUES (null, :titulo, :descripcion, now(), :fechaLimite, :EstadoJob, :id)");
            $insert->bindParam(":titulo", $titulo);
            $insert->bindParam(":descripcion", $descripcion);
            $insert->bindParam(":fechaLimite", $fechaLimite);
            $insert->bindParam(":EstadoJob", $EstadoJob);
            $insert->bindParam(":id", $id);
            if($insert->execute()){
                Jobs::historialSql("Job", "Insertar una tarea. Titulo: " . $titulo, $id);
                return true;
            }else{
                return false;
            }
        }

        // Metodo para actualzar una tarea
        public function updateTarea($titulo, $descripcion, $fechaLimite, $idJob, $idUser){
            $insert = $this->pdo->prepare("UPDATE job 
                                            SET TituloJob = :titulo, 
                                            Descripcion = :descripcion,
                                            FechaCreacion = now(),
                                            FechaLimite = :fechaLimite
                                            WHERE IDJobPK = :idJob 
                                            AND IDUsuarioFK = :idUser");
            $insert->bindParam(":titulo", $titulo);
            $insert->bindParam(":descripcion", $descripcion);
            $insert->bindParam(":fechaLimite", $fechaLimite);
            $insert->bindParam(":idJob", $idJob);
            $insert->bindParam(":idUser", $idUser);
            if($insert->execute()){
                Jobs::historialSql("Job", "Actualizar los datos de una tarea. IDJob = " . $idJob . " Titulo: '" . $titulo . "'", $idUser);
                return true;
            }else{
                return false;
            }
        }

        // Método para actualizar el estado de una tarea, (realizada(2) o no realizada(1))
        public function updateJob($estado, $idJob, $idUser){
            $update = $this->pdo->prepare("CALL sp_update_estado_job(:estado, :idJob, :idUser)");
            $update->bindParam(":estado", $estado);
            $update->bindParam(":idJob", $idJob);
            $update->bindParam(":idUser", $idUser);
            if($update->execute()){
                Jobs::historialSql("Job", "Actualizar el estado de una tarea (tarea terminada). IDJob = " . $idJob, $idUser);
                return true;
            }else{
                return false;
            }
        }

        // Metodo para eliminar las tareas que ya entén terminadas y tengan más de 15 dias
        public function deleteJobsAuto(){
            $fechaEliminar = restarDias('-15 day');
            $menosUnDia = restarDias('-1 day');
            $delete = $this->pdo->prepare("DELETE FROM job WHERE EstadoJob = 2 AND FechaLimite < :fechaEliminar AND FechaCreacion < :menosUnDia");
            $delete->bindParam(":fechaEliminar", $fechaEliminar);
            $delete->bindParam(":menosUnDia", $menosUnDia);
            $delete->execute();
            $delete = null;
            $delete1 = $this->pdo->prepare("DELETE FROM job_eliminado WHERE fechaEliminacion < :fechaEliminar");
            $delete1->bindParam(":fechaEliminar", $fechaEliminar);
            $delete1->execute();
            $delete1 = null;
        }

        // Metodo para eliminar un tabajo de la base de datos
        public function deleteJob($idJob, $idUser){
            // $delete = $this->pdo->prepare("sp_delete_old_job(:fechaEliminar)");
            $delete = $this->pdo->prepare("DELETE FROM job WHERE IDJobPK = :idJob AND IDUsuarioFK = :idUser");
            $delete->bindParam(":idJob", $idJob);
            $delete->bindParam(":idUser", $idUser);
            if($delete->execute()){
                Jobs::historialSql("Job", "Eliminar una tarea", $idUser);
                return true;
            }else{
                return false;
            }
        }


        // Metodo para listar trabajos eliminados de la tabla jobEliminado
        public function selectJobsEliminados($id){
            $rows = null;
            $select = $this->pdo->prepare("CALL sp_select_job_eliminado_asc(:id)");
            $select->bindParam(":id", $id);
            if($select->execute()){
                while($resultado = $select->fetch()){
                    $rows[] = $resultado;
                }
            }
            return $rows;
            $rows = null;
            $select == null;
        }


        // Metodo para eliminar un registro de la tabla job_eliminado
        public function deleteJobEliminado($idJob, $idUser){
            $delete = $this->pdo->prepare("DELETE FROM job_eliminado WHERE IDJobEPK = :idJob AND IDUsuarioFK = :idUser");
            $delete->bindParam(":idJob", $idJob);
            $delete->bindParam(":idUser", $idUser);
            if($delete->execute()){
                Jobs::historialSql("Job_eliminados", "Eliminar tarea de la tabla eliminados. IDJob = " . $idJob, $idUser);
                return true;
            }else{
                return false;
            }
        }

        //Metodo para dar un mensaje segun la cantidad de tareas que hayan
        public function tareasMayorCero($numero){
            if($numero == 0){
                return false;
            }else{
                return true;
            }
        }

    }
?>