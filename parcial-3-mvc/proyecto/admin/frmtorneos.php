<?php
    require_once("template/header.php");
?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0"><i class="fas fa-trophy"></i> CAPTURAR LA INFORMACIÓN DEL TORNEO</h3>
    </div>
    <div class="card-body">
        <form action="saveTorneo.php" method="post">
            <!-- NOMBRE DEL TORNEO -->
            <div class="mb-3">
                <label for="nombreTorneo" class="form-label fw-bold">NOMBRE DEL TORNEO</label>
                <input type="text" class="form-control" name="txtNombreTorneo" id="nombreTorneo" required>
            </div>

            <!-- ORGANIZADOR -->
            <div class="mb-3">
                <label for="organizador" class="form-label fw-bold">ORGANIZADOR (nombre completo)</label>
                <input type="text" class="form-control" name="txtOrganizador" id="organizador" required>
            </div>

            <!-- PATROCINADOR(ES) -->
            <div class="mb-3">
                <label for="patrocinador" class="form-label fw-bold">PATROCINADOR(ES)</label>
                <textarea class="form-control" name="txtPatrocinador" id="patrocinador" cols="30" rows="2"></textarea>
                <span class="form-text text-muted">
                    <i class="fas fa-info-circle"></i> Atención: se puede separar con ";" si hay más de un patrocinador.
                </span>
            </div>

            <!-- SEDE Y CATEGORÍA (2 columnas) -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="sede" class="form-label fw-bold">SEDE (cancha)</label>
                    <input type="text" class="form-control" name="txtSede" id="sede" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="categoria" class="form-label fw-bold">CATEGORÍA</label>
                    <input type="text" class="form-control" name="txtCategoria" id="categoria" list="lstCategories" required>
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
                    <label for="premio1" class="form-label fw-bold">PREMIO 1ER. LUGAR</label>
                    <input type="text" class="form-control" name="txtPremio1" id="premio1">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="premio2" class="form-label fw-bold">PREMIO 2DO. LUGAR</label>
                    <input type="text" class="form-control" name="txtPremio2" id="premio2">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="premio3" class="form-label fw-bold">PREMIO 3ER. LUGAR</label>
                    <input type="text" class="form-control" name="txtPremio3" id="premio3">
                </div>
            </div>

            <!-- OTRO PREMIO -->
            <div class="mb-3">
                <label for="otroPremio" class="form-label fw-bold">OTRO PREMIO (CAMPEÓN CANASTERO)</label>
                <input type="text" class="form-control" name="txtOtroPremio" id="otroPremio">
            </div>

            <!-- USUARIO Y CONTRASEÑA (2 columnas) -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="usuario" class="form-label fw-bold">USUARIO</label>
                    <input type="text" class="form-control" name="txtUsuario" id="usuario" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="contrasena" class="form-label fw-bold">CONTRASEÑA</label>
                    <input type="password" class="form-control" name="txtContrasena" id="contrasena" required>
                </div>
            </div>

            <!-- BOTONES -->
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Guardar Torneo
                </button>
                <a href="home.php" class="btn btn-danger btn-lg">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
    <div class="card-footer text-body-secondary bg-light">
        <strong><i class="fas fa-edit"></i> FORMULARIO PARA REGISTRAR TORNEOS - Brant Santana Gonzalez Arenas</strong>
    </div>
</div>

<?php
    require_once("template/footer.php");
?>