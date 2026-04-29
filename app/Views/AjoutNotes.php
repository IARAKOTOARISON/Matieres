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

            <!-- Formulaire d'ajout de notes -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-plus"></i> Ajouter une Note</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('notes/add') ?>" method="POST">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="idEleve" class="form-label">Élève <span class="text-danger">*</span></label>
                                <select class="form-select <?= isset($errors['idEleve']) ? 'is-invalid' : '' ?>" id="idEleve" name="idEleve" required>
                                    <option value="">-- Sélectionner un élève --</option>
                                    <?php foreach ($eleves as $eleve): ?>
                                        <option value="<?= $eleve['id'] ?>" <?= old('idEleve') == $eleve['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($eleve['nom'] ?? '') ?> (ETU: <?= htmlspecialchars($eleve['ETU'] ?? '') ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($errors['idEleve'])): ?>
                                    <div class="invalid-feedback"><?= $errors['idEleve'] ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="idMatiere" class="form-label">Matière <span class="text-danger">*</span></label>
                                <select class="form-select <?= isset($errors['idMatiere']) ? 'is-invalid' : '' ?>" id="idMatiere" name="idMatiere" required>
                                    <option value="">-- Sélectionner une matière --</option>
                                    <?php foreach ($matieres as $matiere): ?>
                                        <option value="<?= $matiere['id'] ?>" <?= old('idMatiere') == $matiere['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($matiere['codeMatiere'] ?? '') ?> - <?= htmlspecialchars($matiere['intituleMatiere'] ?? '') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($errors['idMatiere'])): ?>
                                    <div class="invalid-feedback"><?= $errors['idMatiere'] ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="valeurNote" class="form-label">Note <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" max="20" class="form-control <?= isset($errors['valeurNote']) ? 'is-invalid' : '' ?>" id="valeurNote" name="valeurNote" placeholder="Ex: 15.50" value="<?= old('valeurNote') ?>" required>
                                <?php if (isset($errors['valeurNote'])): ?>
                                    <div class="invalid-feedback"><?= $errors['valeurNote'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Ajouter la Note
                            </button>
                            <a href="<?= base_url('/') ?>" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Liste des notes en attente (NULL) -->
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-hourglass-half"></i> Notes en Attente (Non encore insérer)</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($notes)): ?>
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle"></i> Aucune note en attente.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Élève</th>
                                        <th>Matière</th>
                                        <th>Note</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($notes as $note): ?>
                                        <?php 
                                            $eleve = array_filter($eleves, fn($e) => $e['id'] == $note['idEleve']);
                                            $matiere = array_filter($matieres, fn($m) => $m['id'] == $note['idMatiere']);
                                            $eleve = reset($eleve);
                                            $matiere = reset($matiere);
                                        ?>
                                        <tr>
                                            <td><?= htmlspecialchars($note['id']) ?></td>
                                            <td><?= $eleve ? htmlspecialchars($eleve['nom'] ?? '') : 'N/A' ?></td>
                                            <td><?= $matiere ? htmlspecialchars($matiere['codeMatiere'] ?? '') : 'N/A' ?></td>
                                            <td>
                                                <span class="badge bg-danger">NULL</span>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('notes/update/' . $note['id']) ?>" class="btn btn-sm btn-warning" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('notes/delete/' . $note['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
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
