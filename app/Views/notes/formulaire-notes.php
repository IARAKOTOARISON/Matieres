<?php include APPPATH . 'Views/layouts/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">
                <i class="fas fa-edit"></i> Gestion des Notes
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

            <!-- En-tête de l'étudiant -->
            <div class="card mb-4 bg-light">
                <div class="card-body">
                    <h3 class="card-title">
                        <i class="fas fa-user-circle"></i> 
                        <?= htmlspecialchars($eleve['nom'] ?? 'N/A') ?>
                    </h3>
                    <p class="card-text mb-0">
                        <strong>Numéro ETU:</strong> <?= htmlspecialchars($eleve['ETU'] ?? 'N/A') ?>
                    </p>
                    <a href="<?= base_url('notes') ?>" class="btn btn-secondary btn-sm mt-3">
                        <i class="fas fa-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </div>

            <!-- Formulaire des notes -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-graduation-cap"></i> Matières et Notes</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('notes/add') ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="idEleve" value="<?= htmlspecialchars($eleve['id']) ?>">

                        <?php if (empty($matieres_avec_notes)): ?>
                            <div class="alert alert-info" role="alert">
                                <i class="fas fa-info-circle"></i> Aucune matière trouvée.
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Code</th>
                                            <th>Intitulé</th>
                                            <th>Crédits</th>
                                            <th>Note</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($matieres_avec_notes as $item): ?>
                                            <?php 
                                                $matiere = $item['matiere'];
                                                $note = $item['note'];
                                            ?>
                                            <tr>
                                                <td>
                                                    <strong><?= htmlspecialchars($matiere['codeMatiere'] ?? 'N/A') ?></strong>
                                                </td>
                                                <td><?= htmlspecialchars($matiere['intituleMatiere'] ?? 'N/A') ?></td>
                                                <td><?= htmlspecialchars($matiere['nombreCredit'] ?? 'N/A') ?></td>
                                                <td>
                                                    <input 
                                                        type="number" 
                                                        step="0.01" 
                                                        min="0" 
                                                        max="20" 
                                                        name="notes[<?= htmlspecialchars($matiere['id']) ?>]" 
                                                        class="form-control form-control-sm" 
                                                        placeholder="--"
                                                        value="<?= $note ? htmlspecialchars($note['valeurNote']) : '' ?>"
                                                    >
                                                </td>
                                                <td>
                                                    <?php if ($note): ?>
                                                        <a href="<?= base_url('notes/delete/' . $note['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')" title="Supprimer la note">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary">--</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex gap-2 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Enregistrer les Notes
                                </button>
                                <a href="<?= base_url('notes') ?>" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Annuler
                                </a>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include APPPATH . 'Views/layouts/footer.php'; ?>
