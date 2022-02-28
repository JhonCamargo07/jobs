<?php
    require_once('conexion.php');
    class clases{
        private $pdo;

        public function __construct(){
            try {
                $this->pdo = Conexion::startUp();
            } catch (Exception $j) {
                echo "Error al conectarse con la base de datos.";
                die($j->getMessage());
            }
        }

        public function listarClases($dia){
            $rows = null;
            if($dia == "Mon"){
                $select = $this->pdo->prepare('SELECT NombreClase, EnlaceClase, EnlacePortafolio, HoraInicio, HoraFin fROM clase INNER JOIN horario on LunesFK = IDClasePK;');
            }elseif($dia == "Tue"){
                $select = $this->pdo->prepare('SELECT NombreClase, EnlaceClase, EnlacePortafolio, HoraInicio, HoraFin fROM clase INNER JOIN horario on MartesFK = IDClasePK;');
            }elseif($dia == "Wed"){
                $select = $this->pdo->prepare('SELECT NombreClase, EnlaceClase, EnlacePortafolio, HoraInicio, HoraFin fROM clase INNER JOIN horario on MiercolesFK = IDClasePK;');
            }elseif($dia == "Thu"){
                $select = $this->pdo->prepare('SELECT NombreClase, EnlaceClase, EnlacePortafolio, HoraInicio, HoraFin fROM clase INNER JOIN horario on JuevesFK = IDClasePK;');
            }elseif($dia == "Fri"){
                $select = $this->pdo->prepare('SELECT NombreClase, EnlaceClase, EnlacePortafolio, HoraInicio, HoraFin fROM clase INNER JOIN horario on ViernesFK = IDClasePK;');
            }else{
                $select = $this->pdo->prepare('SELECT NombreClase, EnlaceClase, EnlacePortafolio, HoraInicio, HoraFin from clase');
            }
            if($select->execute()){
                while($resultado=$select->fetch()){
                    $rows[] = $resultado;
                }
            }
            return $rows;
            $rows = null;
            $select = null;
        }

        public function selectDia($dia){
            
        }
    }
?>