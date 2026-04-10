<?php require_once("template/header.php"); ?>

<div class="main-title text-center">
    <h1><i class="fas fa-basketball"></i> Aplicación Web para Gestionar Torneos de Basket-Ball</h1>
    <p class="mb-0">Panel de Administración - Brant Santana Gonzalez Arenas | Lisiv3-1</p>
</div>

<div class="card text-center">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0"><i class="fas fa-bars"></i> MENÚ</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- CREAR TORNEO -->
            <div class="col-md-3 mb-3">
                <div class="card card-menu h-100">
                    <div class="card-header bg-success text-white">
                        <i class="fas fa-plus-circle"></i> CREAR TORNEO
                    </div>
                    <div class="card-body">
                        <a href="frmtorneos.php" class="btn btn-success">
                            <i class="fas fa-trophy fa-4x d-block mb-2"></i>
                            <span>Registrar Torneo</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- LISTA DE TORNEOS -->
            <div class="col-md-3 mb-3">
                <div class="card card-menu h-100">
                    <div class="card-header bg-info text-white">
                        <i class="fas fa-list"></i> LISTA DE TORNEOS
                    </div>
                    <div class="card-body">
                        <a href="lista_torneos.php" class="btn btn-info">
                            <i class="fas fa-table-list fa-4x d-block mb-2"></i>
                            <span>Ver Torneos</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ESTADÍSTICAS -->
            <div class="col-md-3 mb-3">
                <div class="card card-menu h-100">
                    <div class="card-header bg-warning text-dark">
                        <i class="fas fa-chart-line"></i> ESTADÍSTICAS
                    </div>
                    <div class="card-body">
                        <a href="#" class="btn btn-warning">
                            <i class="fas fa-chart-simple fa-4x d-block mb-2"></i>
                            <span>Ver Estadísticas</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ANUNCIOS -->
            <div class="col-md-3 mb-3">
                <div class="card card-menu h-100">
                    <div class="card-header bg-danger text-white">
                        <i class="fas fa-bullhorn"></i> ANUNCIOS
                    </div>
                    <div class="card-body">
                        <a href="#" class="btn btn-danger">
                            <i class="fas fa-megaphone fa-4x d-block mb-2"></i>
                            <span>Publicar Anuncios</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer bg-light">
        <i class="fas fa-cog"></i> Configuración de torneos - Web App Basket-Ball
    </div>
</div>

<?php require_once("template/footer.php"); ?>