<?php
    class Conexion{
        public static function startUp(){
            // Conectarse a la base de datos
            $pdo = new PDO('mysql:host=localhost; dbname=jobs; charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }
    }
?>