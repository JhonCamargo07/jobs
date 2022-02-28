public function __construct(){
    try {
        $this->pdo = Conexion::startUp();
    } catch (Exception $j) {
        echo "Error al conectarse con la base de datos.";
        die($j->getMessage());
    }
}