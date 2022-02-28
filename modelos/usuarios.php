<?php
    require_once('conexion.php');
    class Usuario{
        private $nombre;
        private $tipo_doc;
        private $documento;
        private $pdo;

        public function __construct(){
            try {
                $this->pdo = Conexion::startUp();
            } catch (Exception $j) {
                echo "Error al conectarse con la base de datos.";
                die($j->getMessage());
            }
        }

        public function verificar_usuario_bd($correo){
            $select = $this->pdo->prepare("SELECT IDUsuarioPK FROM usuario WHERE CorreoUsuario = :correo");
            $select->bindParam(":correo", $correo);
            if($select->execute()){
                if($select->rowCount() == 1){
                    return true;
                }else{
                    return false;
                }
            }
            $select == null;
        }

        public function verificar_usuario_bd_por_id($id){
            $select = $this->pdo->prepare("SELECT IDUsuarioPK FROM Usuario WHERE IDUsuarioPK = :id");
            $select->bindParam(":id", $id);
            if($select->execute()){
                if($select->rowCount() == 1){
                    return true;
                }else{
                    return false;
                }
            }
            $select == null;
        }

        //Crea un usuario en la base de datos, si retorna true es que el usuario se pudo registrar, de lo contrario, significa que el usuario ya se encuentra segistrado
        public function insertUsuario($nombre, $correo, $password, $rol, $estado){
            if(Usuario::verificar_usuario_bd($correo)){
                return false;
            }else{
                $insert = $this->pdo->prepare("INSERT iNTO usuario VALUES(NULL, :nombre, :correo, :Pass, :Rol, :Estado)");
                $passwordEncript = password_hash($password, PASSWORD_DEFAULT, ["cost" => 11]);
                $insert->bindParam(":nombre", $nombre);
                $insert->bindParam(":correo", $correo);
                $insert->bindParam(":Pass", $passwordEncript);
                $insert->bindParam(":Rol", $rol);
                $insert->bindParam(":Estado", $estado);
                if($insert->execute()){
                    return true;
                }
                $insert == null;
            }
        }

        // Función hecha para llamarla en las validaciones de la funcion actualizarUsuario, esto para no repetir codigo.
        public function codigoActualizarUsuario($nombre, $tipo_doc, $documento, $rol, $estado, $id){
            $update = $this->pdo->prepare("UPDATE Usuario SET Documento = :Documento, PasswordU = :Pass, NombreUsuario = :Nombre, Tipo_documento = :Tipo_doc, Rol = :Rol, EstadoUsuario = :Estado WHERE IDUsuarioPK = :Id");
            $update->bindParam(":Documento", $documento);
            $passwordEncript = password_hash($documento, PASSWORD_DEFAULT, ["cost" => 11]);
            $update->bindParam(":Pass", $passwordEncript);
            $update->bindParam(":Nombre", $nombre);
            $update->bindParam(":Tipo_doc", $tipo_doc);
            $update->bindParam(":Rol", $rol);
            $update->bindParam(":Estado", $estado);
            $update->bindParam(":Id", $id);
            if($update->execute()){
                return true;
            }
            $update == null;
        }

        public function actualizarUsuario($nombre, $tipo_doc, $documento, $rol, $estado, $id){
            if(self::verificar_usuario_bd_por_id($id)){ //Verifica que el id si exista en bd
                // Si el id existe, hace una consulta para traer todos los datos de un usuario
                $select = $this->pdo->prepare("SELECT * from Usuario WHERE IDUsuarioPK = :id");
                $select->bindParam(":id", $id);
                $select->execute();
                $datos = $select->fetch();
                $select = null; //Redefinimos la variable para que no ocupe memoria

                //Si el usuario trata de modificar campos nopermitidos, le saldrá un error.
                if($id != $datos['IDUsuarioPK'] || $rol != $datos['Rol'] || $estado != $datos['EstadoUsuario']){
                    echo '<script>
                            alertaFlotanteConRedirecion("Los datos son incorrectos", "Solo es posible modificar los datos que aparecen en el formulario", "#0EA3E3", "imagenes/error.gif", "../vistas/editarUsuario.php?id=' . $datos['IDUsuarioPK'] . '");
                        </script>';
                }
                //comprobamos si el documento que el usuario coloca es diferente al que ya se encuentra en la bd
                elseif($documento != $datos['Documento']){ //Si el usuario suministra un # de documento diferente al que ya tenia, el sistema verifica que el nuevo # de documento no exista en bd
                    if(self::verificar_usuario_bd($documento)){//Si el # de documento ya lo tiene otro usuario genera una alerta
                        echo '<script>
                                alertaFlotanteConRedirecion("Ya hay un usuario con el mismo número de documento", "Verifique los datos e intente nuevamente", "#0EA3E3", "imagenes/error.gif", "../vistas/editarUsuario.php?id=' . $id . '");
                            </script>';
                    }else{//Si ningun usuario tienen el nuevo # de documento, actualiza el usuario
                        return self::codigoActualizarUsuario($nombre, $tipo_doc, $documento, $rol, $estado, $id);
                    }
                }else{//Si el # de documento NO es diferente al de la bd, actualiza al usuario
                    return self::codigoActualizarUsuario($nombre, $tipo_doc, $documento, $rol, $estado, $id);
                }
                $datos == null;
            }else{ //En caso de que el ID no exista en bd
                echo '<script>
                        alertaFlotanteConRedirecion("El usuario no se encuentra registrado", "Verifique los datos e intente nuevamente", "#0EA3E3", "imagenes/error.gif", "../vistas/usuarios.php");
                    </script>';
            }
        }

        public function listarUsuarios(){
            $rows = null;
            $select = $this->pdo->prepare("SELECT * FROM Usuario");
            $select->execute();
            while($resultado=$select->fetch()){
                $rows[] = $resultado;
            }
            return $rows;
            $rows = null;
            $select = null;
        }

        public function obtenerUsuarios($id){
            $rows = null;
            $select = $this->pdo->prepare("SELECT * FROM Usuario WHERE IDUsuarioPK = :id");
            $select->bindParam(":id", $id);
            $select->execute();
            while($resultado=$select->fetch()){
                $rows[] = $resultado;
            }
            return $rows;
            $rows = null;
            $select = null;
        }

        public function obtenerUsuariosPorBusqueda($parametro){ //Buscador
            $rows = null;
            $parametro = "%" .$parametro . "%";
            $select = $this->pdo->prepare("CALL sp_search_usuario(:parametro)");
            $select->bindParam(":parametro", $parametro);
            $select->execute();
            while($resultado=$select->fetch()){
                $rows[] = $resultado;
            }
            return $rows;
            $rows = null;
            $select = null;
        }
    }
?>