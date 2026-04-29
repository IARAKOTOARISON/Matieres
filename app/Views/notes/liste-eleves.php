<?php include APPPATH . 'Views/layouts/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">
                <i class="fas fa-graduation-cap"></i> Gestion des Notes - Sélectionner un Étudiant
            </h1>

            <!-- Messages d'alerte -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Liste des étudiants -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-users"></i> Liste des Étudiants</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($eleves)): ?>
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle"></i> Aucun étudiant trouvé.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Numéro ETU</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($eleves as $eleve): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($eleve['id']) ?></td>
                                            <td><?= htmlspecialchars($eleve['nom'] ?? 'N/A') ?></td>
                                            <td><?= htmlspecialchars($eleve['ETU'] ?? 'N/A') ?></td>
                                            <td>
                                                <a href="<?= base_url('notes/formulaire/' . $eleve['id']) ?>" class="btn btn-sm btn-primary" title="Gérer les notes">
                                                    <i class="fas fa-edit"></i> Gérer les notes
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include APPPATH . 'Views/layouts/footer.php'; ?>
