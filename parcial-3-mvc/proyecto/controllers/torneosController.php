<?php
require_once("../models/torneosModel.php");

class torneosController {
    private $model;
    
    public function __construct() {
        $this->model = new torneosModel();
    }
    
    /**
     * Método para guardar un torneo (CREATE)
     */
    public function saveTorneo($nombreTorneo, $organizador, $patrocinadores, $sede,
                               $categoria, $premio1, $premio2, $premio3, $otroPremio, 
                               $usuario, $contrasena) {
        
        $id = $this->model->insert(
            $nombreTorneo, $organizador, $patrocinadores, $sede,
            $categoria, $premio1, $premio2, $premio3, $otroPremio, 
            $usuario, $contrasena
        );
        
        return ($id !== false) ? header("Location: ../admin/home.php") : header("Location: ../admin/frmtorneos.php");
    }
    
    /**
     * MÉTODO READ - Consultar todos los torneos
     */
    public function readTorneos() {
        $resultado = $this->model->read();
        return ($resultado) ? $resultado : false;
    }
    
    /**
     * MÉTODO READ ONE - Consultar un torneo específico
     */
    public function readOneTorneo($id) {
        $resultado = $this->model->readOne($id);
        return ($resultado) ? $resultado : false;
    }
    
    /**
     * MÉTODO UPDATE - Actualizar un torneo
     */
    public function updateTorneo($id, $nombreTorneo, $organizador, $patrocinadores, 
                                  $sede, $categoria, $premio1, $premio2, $premio3, $otroPremio) {
        $resultado = $this->model->update(
            $id, $nombreTorneo, $organizador, $patrocinadores, 
            $sede, $categoria, $premio1, $premio2, $premio3, $otroPremio
        );
        
        return ($resultado !== false) ? header("Location: ../admin/lista_torneos.php?update=success") 
                                      : header("Location: ../admin/editTorneo.php?id=" . $id . "&error=1");
    }
    
    /**
     * MÉTODO DELETE - Eliminar un torneo
     */
    public function delete($id) {
        $resultado = $this->model->delete($id);
        return ($resultado) ? header("Location: ../admin/lista_torneos.php?delete=success") 
                            : header("Location: ../admin/readOneTorneo.php?id=" . $id . "&error=1");
    }
}
?>