<?php
    require_once("template/header.php");
    require_once("../controllers/torneosController.php");
    
    $objTorneosController = new torneosController();
    $rows = $objTorneosController->readTorneos();
    
    // Mostrar mensaje de éxito si se actualizó correctamente
    if (isset($_GET['update']) && $_GET['update'] == 'success') {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> <strong>¡Éxito!</strong> Torneo actualizado correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
    
    // Mostrar mensaje de éxito si se eliminó correctamente
    if (isset($_GET['delete']) && $_GET['delete'] == 'success') {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> <strong>¡Éxito!</strong> Torneo eliminado correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
?>

<div class="card text-center">
    <div class="card-header bg-info text-white">
        <h3 class="mb-0"><i class="fas fa-list"></i> LISTADO DE TORNEOS</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">TORNEO</th>
                        <th scope="col">ORGANIZADOR</th>
                        <th scope="col">SEDE</th>
                        <th scope="col">CATEGORÍA</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($rows && count($rows) > 0): ?>
                        <?php foreach($rows as $row): ?>
                            <tr>
                                <td class="fw-bold"><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['nombreTorneo']) ?></td>
                                <td><?= htmlspecialchars($row['organizador']) ?></td>
                                <td><?= htmlspecialchars($row['sede']) ?></td>
                                <td><?= htmlspecialchars($row['categoria']) ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <!-- Botón VER DETALLE -->
                                        <a href="readOneTorneo.php?id=<?= $row['id'] ?>" 
                                           class="btn btn-sm btn-primary" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <!-- Botón EDITAR -->
                                        <a href="editTorneo.php?id=<?= $row['id'] ?>" 
                                           class="btn btn-sm btn-success" title="Editar">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        
                                        <!-- Botón ELIMINAR con Modal -->
                                        <button type="button" class="btn btn-sm btn-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalEliminar<?= $row['id'] ?>"
                                                title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    
                                    <!-- Modal de confirmación para eliminar -->
                                    <div class="modal fade" id="modalEliminar<?= $row['id'] ?>" 
                                         tabindex="-1" aria-labelledby="modalLabel<?= $row['id'] ?>" 
                                         aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h4 class="modal-title fs-5" id="modalLabel<?= $row['id'] ?>">
                                                        <i class="fas fa-exclamation-triangle"></i> Confirmar Eliminación
                                                    </h4>
                                                    <button type="button" class="btn-close" 
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <p>¿Está seguro que desea eliminar el siguiente torneo?</p>
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th class="bg-light">ID:</th>
                                                            <td><?= htmlspecialchars($row['id']) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg-light">Torneo:</th>
                                                            <td><?= htmlspecialchars($row['nombreTorneo']) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg-light">Organizador:</th>
                                                            <td><?= htmlspecialchars($row['organizador']) ?></td>
                                                        </tr>
                                                    </table>
                                                    <p class="text-danger mt-2">
                                                        <i class="fas fa-skull-crosswalk"></i> <strong>¡Esta acción no se puede deshacer!</strong>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" 
                                                            data-bs-dismiss="modal">
                                                        <i class="fas fa-times"></i> Cancelar
                                                    </button>
                                                    <a href="deleteTorneo.php?id=<?= $row['id'] ?>" 
                                                       class="btn btn-danger">
                                                        <i class="fas fa-trash"></i> Sí, Eliminar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-database fa-2x d-block mb-2"></i>
                                <strong>No hay torneos registrados aún.</strong><br>
                                <a href="frmtorneos.php" class="btn btn-primary btn-sm mt-2">
                                    <i class="fas fa-plus"></i> Crear primer torneo
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <?php if($rows && count($rows) > 0): ?>
            <div class="alert alert-info mt-3">
                <i class="fas fa-chart-simple"></i> <strong>Total de torneos:</strong> <?= count($rows) ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="card-footer text-body-secondary bg-light">
        <strong><i class="fas fa-trophy"></i> GESTIÓN DE TORNEOS - Brant Santana Gonzalez Arenas | Lisiv3-1</strong>
    </div>
</div>

<?php
    require_once("template/footer.php");
?>