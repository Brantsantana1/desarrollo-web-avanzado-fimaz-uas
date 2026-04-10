<?php
require_once("../config/DataBase.php");  // Solo un ../

class torneosModel {
    public $PDO;
    
    public function __construct() {
        $conection = new DataBase();
        $this->PDO = $conection->connect();
    }
    
    /**
     * Método para insertar un torneo (CREATE)
     */
    public function insert($nombreTorneo, $organizador, $patrocinadores, $sede, 
                          $categoria, $premio1, $premio2, $premio3, $otroPremio, 
                          $usuario, $contrasena) {
        
        try {
            $contrasenaEncriptada = $this->passwordEncrypt($contrasena);
            
            $statement = $this->PDO->prepare("INSERT INTO torneos VALUES(
                null, 
                :nombreTorneo, 
                :organizador, 
                :patrocinadores, 
                :sede, 
                :categoria, 
                :premio1, 
                :premio2, 
                :premio3, 
                :otroPremio, 
                :usuario, 
                :contrasena
            )");
            
            $statement->bindParam(":nombreTorneo", $nombreTorneo);
            $statement->bindParam(":organizador", $organizador);
            $statement->bindParam(":patrocinadores", $patrocinadores);
            $statement->bindParam(":sede", $sede);
            $statement->bindParam(":categoria", $categoria);
            $statement->bindParam(":premio1", $premio1);
            $statement->bindParam(":premio2", $premio2);
            $statement->bindParam(":premio3", $premio3);
            $statement->bindParam(":otroPremio", $otroPremio);
            $statement->bindParam(":usuario", $usuario);
            $statement->bindParam(":contrasena", $contrasenaEncriptada);
            
            if ($statement->execute()) {
                return $this->PDO->lastInsertId();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error al insertar torneo: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * MÉTODO READ - Consultar todos los torneos
     */
    public function read() {
        try {
            $statement = $this->PDO->prepare("SELECT * FROM torneos ORDER BY id DESC");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al leer torneos: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * MÉTODO READ ONE - Consultar un torneo específico por ID
     */
    public function readOne($id) {
        try {
            $statement = $this->PDO->prepare("SELECT * FROM torneos WHERE id = :id LIMIT 1");
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al leer un torneo: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * MÉTODO UPDATE - Actualizar los datos del Torneo
     */
    public function update($id, $nombreTorneo, $organizador, $patrocinadores, $sede,
                           $categoria, $premio1, $premio2, $premio3, $otroPremio) {
        try {
            $statement = $this->PDO->prepare("UPDATE torneos SET 
                nombreTorneo = :nombreTorneo,
                organizador = :organizador, 
                patrocinadores = :patrocinadores, 
                sede = :sede, 
                categoria = :categoria, 
                premio1 = :premio1, 
                premio2 = :premio2, 
                premio3 = :premio3, 
                otroPremio = :otroPremio 
                WHERE id = :id");
            
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":nombreTorneo", $nombreTorneo);
            $statement->bindParam(":organizador", $organizador);
            $statement->bindParam(":patrocinadores", $patrocinadores);
            $statement->bindParam(":sede", $sede);
            $statement->bindParam(":categoria", $categoria);
            $statement->bindParam(":premio1", $premio1);
            $statement->bindParam(":premio2", $premio2);
            $statement->bindParam(":premio3", $premio3);
            $statement->bindParam(":otroPremio", $otroPremio);
            
            return ($statement->execute()) ? $id : false;
        } catch (PDOException $e) {
            error_log("Error al actualizar torneo: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * MÉTODO DELETE - Eliminar un torneo
     */
    public function delete($id) {
        try {
            $statement = $this->PDO->prepare("DELETE FROM torneos WHERE id = :id");
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $e) {
            error_log("Error al eliminar torneo: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Método para encriptar la contraseña
     */
    public function passwordEncrypt($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
?>