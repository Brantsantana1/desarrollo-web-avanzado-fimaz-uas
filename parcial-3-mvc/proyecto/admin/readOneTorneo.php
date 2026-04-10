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
?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0"><i class="fas fa-info-circle"></i> DETALLE DEL TORNEO SELECCIONADO</h3>
        <small><i class="fas fa-hashtag"></i> ID: <?= htmlspecialchars($lstTorneo['id']) ?></small>
    </div>
    <div class="card-body">
        <form action="#" method="post">
            <!-- NOMBRE DEL TORNEO -->
            <div class="mb-3">
                <label for="nombreTorneo" class="form-label fw-bold">
                    <i class="fas fa-trophy"></i> NOMBRE DEL TORNEO
                </label>
                <input type="text" class="form-control" id="nombreTorneo" 
                       value="<?= htmlspecialchars($lstTorneo['nombreTorneo']) ?>" readonly>
            </div>

            <!-- ORGANIZADOR -->
            <div class="mb-3">
                <label for="organizador" class="form-label fw-bold">
                    <i class="fas fa-user"></i> ORGANIZADOR (nombre completo)
                </label>
                <input type="text" class="form-control" id="organizador" 
                       value="<?= htmlspecialchars($lstTorneo['organizador']) ?>" readonly>
            </div>

            <!-- PATROCINADOR(ES) -->
            <div class="mb-3">
                <label for="patrocinador" class="form-label fw-bold">
                    <i class="fas fa-handshake"></i> PATROCINADOR(ES)
                </label>
                <textarea class="form-control" id="patrocinador" rows="2" readonly><?= htmlspecialchars($lstTorneo['patrocinadores']) ?></textarea>
                <span class="form-text text-muted">
                    <i class="fas fa-info-circle"></i> Atención: se puede separar con ";" si hay más de un patrocinador.
                </span>
            </div>

            <!-- SEDE Y CATEGORÍA (2 columnas) -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="sede" class="form-label fw-bold">
                        <i class="fas fa-map-marker-alt"></i> SEDE (cancha)
                    </label>
                    <input type="text" class="form-control" id="sede" 
                           value="<?= htmlspecialchars($lstTorneo['sede']) ?>" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="categoria" class="form-label fw-bold">
                        <i class="fas fa-tag"></i> CATEGORÍA
                    </label>
                    <input type="text" class="form-control" id="categoria" 
                           value="<?= htmlspecialchars($lstTorneo['categoria']) ?>" readonly>
                </div>
            </div>

            <!-- PREMIOS (3 columnas) -->
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="premio1" class="form-label fw-bold">
                        <i class="fas fa-medal"></i> PREMIO 1ER. LUGAR
                    </label>
                    <input type="text" class="form-control" id="premio1" 
                           value="<?= htmlspecialchars($lstTorneo['premio1']) ?>" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="premio2" class="form-label fw-bold">
                        <i class="fas fa-medal"></i> PREMIO 2DO. LUGAR
                    </label>
                    <input type="text" class="form-control" id="premio2" 
                           value="<?= htmlspecialchars($lstTorneo['premio2']) ?>" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="premio3" class="form-label fw-bold">
                        <i class="fas fa-medal"></i> PREMIO 3ER. LUGAR
                    </label>
                    <input type="text" class="form-control" id="premio3" 
                           value="<?= htmlspecialchars($lstTorneo['premio3']) ?>" readonly>
                </div>
            </div>

            <!-- OTRO PREMIO -->
            <div class="mb-3">
                <label for="otroPremio" class="form-label fw-bold">
                    <i class="fas fa-star"></i> OTRO PREMIO (CAMPEÓN CANASTERO)
                </label>
                <input type="text" class="form-control" id="otroPremio" 
                       value="<?= htmlspecialchars($lstTorneo['otroPremio']) ?>" readonly>
            </div>

            <!-- USUARIO Y CONTRASEÑA (2 columnas) -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="usuario" class="form-label fw-bold">
                        <i class="fas fa-user-circle"></i> USUARIO
                    </label>
                    <input type="text" class="form-control" id="usuario" 
                           value="<?= htmlspecialchars($lstTorneo['usuario']) ?>" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="contrasena" class="form-label fw-bold">
                        <i class="fas fa-lock"></i> CONTRASEÑA
                    </label>
                    <input type="text" class="form-control" id="contrasena" 
                           value="<?= htmlspecialchars($lstTorneo['contrasena']) ?>" readonly>
                </div>
            </div>

            <!-- BOTÓN REGRESAR -->
            <div class="text-center mt-3">
                <a href="lista_torneos.php" class="btn btn-success btn-lg">
                    <i class="fas fa-arrow-left"></i> REGRESAR
                </a>
            </div>
        </form>
    </div>
    <div class="card-footer text-body-secondary bg-light">
        <strong><i class="fas fa-info-circle"></i> DETALLE DE TORNEO - Brant Santana Gonzalez Arenas | Lisiv3-1</strong>
    </div>
</div>

<?php
    require_once("template/footer.php");
?>