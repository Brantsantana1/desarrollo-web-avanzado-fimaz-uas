<?php
    require_once("template/header.php");
    require_once("../controllers/torneosController.php");
    
    // Verificar que se recibió un ID válido
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        header("Location: lista_torneos.php");
        exit();
    }
    
    // Instanciamos controlador para ejecutar la consulta
    $objTorneosController = new torneosController();
    
    // Capturar el id y a su vez sacar la información del torneo
    $lstTorneo = $objTorneosController->readOneTorneo($_GET['id']);
    
    // Verificar si el torneo existe
    if (!$lstTorneo) {
        echo '<div class="alert alert-danger text-center">
                <i class="fas fa-exclamation-triangle"></i> Torneo no encontrado
              </div>';
        echo '<div class="text-center"><a href="lista_torneos.php" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Regresar</a></div>';
        require_once("template/footer.php");
        exit();
    }
    
    // Mostrar mensaje de error si existe
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> <strong>¡Error!</strong> No se pudo actualizar el torneo. Intente nuevamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
?>

<div class="mx-auto p-5">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h3 class="mb-0"><i class="fas fa-pen"></i> EDITAR INFORMACIÓN DEL TORNEO</h3>
            <small><i class="fas fa-hashtag"></i> ID: <?= htmlspecialchars($lstTorneo['id']) ?></small>
        </div>
        <div class="card-body">
            <form action="updateTorneo.php" method="post">
                <!-- Campo oculto para enviar el ID -->
                <input type="hidden" name="txtId" value="<?= htmlspecialchars($lstTorneo['id']) ?>">
                
                <!-- NOMBRE DEL TORNEO -->
                <div class="mb-3">
                    <label for="nombreTorneo" class="form-label fw-bold">
                        <i class="fas fa-trophy"></i> Nombre del Torneo:
                    </label>
                    <input type="text" class="form-control" name="txtNombreTorneo" id="nombreTorneo" 
                           value="<?= htmlspecialchars($lstTorneo['nombreTorneo']) ?>" required>
                </div>

                <!-- ORGANIZADOR -->
                <div class="mb-3">
                    <label for="organizador" class="form-label fw-bold">
                        <i class="fas fa-user"></i> Organizador (nombre completo):
                    </label>
                    <input type="text" class="form-control" name="txtOrganizador" id="organizador" 
                           value="<?= htmlspecialchars($lstTorneo['organizador']) ?>" required>
                </div>

                <!-- PATROCINADOR(ES) -->
                <div class="mb-3">
                    <label for="patrocinador" class="form-label fw-bold">
                        <i class="fas fa-handshake"></i> Patrocinador(ES):
                    </label>
                    <textarea class="form-control" name="txtPatrocinador" id="patrocinador" 
                              cols="30" rows="2"><?= htmlspecialchars($lstTorneo['patrocinadores']) ?></textarea>
                    <span class="form-text text-muted">
                        <i class="fas fa-info-circle"></i> Atención: se puede separar con ";" si hay más de un patrocinador.
                    </span>
                </div>

                <!-- SEDE Y CATEGORÍA (2 columnas) -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="sede" class="form-label fw-bold">
                            <i class="fas fa-map-marker-alt"></i> SEDE (cancha):
                        </label>
                        <input type="text" class="form-control" name="txtSede" id="sede" 
                               value="<?= htmlspecialchars($lstTorneo['sede']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="categoria" class="form-label fw-bold">
                            <i class="fas fa-tag"></i> CATEGORÍA:
                        </label>
                        <input type="text" class="form-control" name="txtCategoria" id="categoria" 
                               list="lstCategories" value="<?= htmlspecialchars($lstTorneo['categoria']) ?>" required>
                        <datalist id="lstCategories">
                            <option value="1ra. fuerza">
                            <option value="2da. fuerza">
                            <option value="Veteranos">
                            <option value="Libre">
                            <option value="Juvenil">
                            <option value="Femenil">
                            <option value="Empresarial">
                            <option value="Infantil">
                            <option value="Minibasket">
                        </datalist>
                    </div>
                </div>

                <!-- PREMIOS (3 columnas) -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="premio1" class="form-label fw-bold">
                            <i class="fas fa-medal"></i> PREMIO 1ER. LUGAR:
                        </label>
                        <input type="text" class="form-control" name="txtPremio1" id="premio1" 
                               value="<?= htmlspecialchars($lstTorneo['premio1']) ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="premio2" class="form-label fw-bold">
                            <i class="fas fa-medal"></i> PREMIO 2DO. LUGAR:
                        </label>
                        <input type="text" class="form-control" name="txtPremio2" id="premio2" 
                               value="<?= htmlspecialchars($lstTorneo['premio2']) ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="premio3" class="form-label fw-bold">
                            <i class="fas fa-medal"></i> PREMIO 3ER. LUGAR:
                        </label>
                        <input type="text" class="form-control" name="txtPremio3" id="premio3" 
                               value="<?= htmlspecialchars($lstTorneo['premio3']) ?>">
                    </div>
                </div>

                <!-- OTRO PREMIO -->
                <div class="mb-3">
                    <label for="otroPremio" class="form-label fw-bold">
                        <i class="fas fa-star"></i> OTRO PREMIO (CAMPEÓN CANASTERO):
                    </label>
                    <input type="text" class="form-control" name="txtOtroPremio" id="otroPremio" 
                           value="<?= htmlspecialchars($lstTorneo['otroPremio']) ?>">
                </div>

                <!-- NOTA: Usuario y Contraseña NO se editan -->
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> <strong>📌 Nota:</strong> El usuario y contraseña del organizador no se pueden editar por seguridad.
                    Si necesita cambiarlos, contacte al administrador.
                </div>

                <!-- BOTONES -->
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-warning btn-lg">
                        <i class="fas fa-save"></i> Actualizar Torneo
                    </button>
                    <a href="lista_torneos.php" class="btn btn-secondary btn-lg">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
        <div class="card-footer text-body-secondary bg-light">
            <strong><i class="fas fa-pen"></i> EDITAR TORNEO - Brant Santana Gonzalez Arenas</strong>
        </div>
    </div>
</div>

<?php
    require_once("template/footer.php");
?>