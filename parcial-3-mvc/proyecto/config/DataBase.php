<?php
// Crear una clase para conexión a base de datos mediante PDO.
class DataBase {
    // Atributos de la clase DataBase
    private $host = "localhost";
    private $db = "proyecto";
    private $user = "root";
    private $password = "";
    private $PDO;

    // Constructor
    public function __construct() {
        // Puedes inicializar algo aquí si lo necesitas
    }

    // Método para conexión a la base de datos
    public function connect() {
        try {
            $this->PDO = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db,
                $this->user,
                $this->password
            );
            // Configurar el modo de errores de PDO para que lance excepciones
            $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Configurar el charset a UTF-8
            $this->PDO->exec("SET NAMES utf8");
            
            return $this->PDO;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    
    // Método para cerrar la conexión
    public function disconnect() {
        $this->PDO = null;
    }
    
    // Método para obtener la conexión
    public function getConnection() {
        return $this->PDO;
    }
}
?>