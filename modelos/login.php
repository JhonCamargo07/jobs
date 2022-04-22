<?php
    $barrio = "El Recuerdo";
    require_once('conexion.php');
    if(!headers_sent() && '' == session_id()){
        session_start();
    }
    class Login{
        private $pdo;

        public function __construct(){
            try {
                $this->pdo = Conexion::startUp();
            } catch (Exception $j) {
                echo "Error al conectarse con la base de datos.";
                die($j->getMessage());
            }
        }

        // Función para consultar el usuario en la base de datos
        public function login($usuario, $password){
            $str = $this->pdo->prepare("Call sp_select_usuario_login(:Usuario)");
            $str->bindParam(':Usuario', $usuario);
            $str->execute();
            if($str->rowCount() == 1){
                $resultado = $str->fetch();
                // Se hace la comprobacion si la contraseña que el usuario ingresa (sin encriptar) es igual a la que esta en la base de datos (con encriptación), esto utlizando la funcion password_verify
                if(password_verify($password, $resultado['PasswordU'])){
                    // Guardar algunos datos dentro de la sesión
                    $_SESSION['datos'] = $resultado;
                    // $_SESSION['Nombre'] = $resultado["NombreUsuario"] . " " . $resultado['ApellidoUsuario'];
                    // $_SESSION['Sexo'] = $resultado['SexoUsuario'];
                    // $_SESSION['id'] = $resultado['IDUsuarioPK'];
                    // $_SESSION['Tipo_User'] = $resultado['Rol'];
                    // $_SESSION['Estado'] = $resultado['EstadoUsuario'];
                    return $_SESSION['datos'];
                }else{
                    return false;
                }
            }else{
                return false;
            }
            $str = null;
        }

        public function validarSesion(){
            if($_SESSION['datos']['IDUsuarioPK'] == null){
                header('location: ../');
            }
        }
        
        public function validarEstado(){
            if($_SESSION['datos']['EstadoUsuario'] == 2){
                session_destroy();
                return true;
            }else{
                return false;
            }
        }
        
        public function validarRolVotante(){
            if($_SESSION['datos']['Rol'] == 2){
                header('location: votante/');
            }
        }

        public function validarRolAdmin(){
            if($_SESSION['datos']['Rol'] == 1){
                header('location: ../');
            }
        }
        
    }
?>