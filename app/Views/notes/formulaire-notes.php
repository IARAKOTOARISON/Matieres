<?php
if (session()->getFlashdata('success')): ?>
  <div style="background-color: #d4edda; color: #155724; padding: 12px; margin-bottom: 16px; border-radius: 4px;">
    <?= session()->getFlashdata('success') ?>
  </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
  <div style="background-color: #f8d7da; color: #721c24; padding: 12px; margin-bottom: 16px; border-radius: 4px;">
    <?= session()->getFlashdata('error') ?>
  </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulaire de Notes — Gestion des Notes</title>
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>" />
</head>
<body>

<div class="app">

  <!-- ── Sidebar ──────────────────────────────────────────────────────────── -->
  <aside class="sidebar">
    <div class="sidebar-brand">
      <div class="logo-icon">
        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
      </div>
      <div>
        <div class="brand-name">Gestion Notes</div>
        <div class="brand-sub">v2.4.0</div>
      </div>
    </div>

    <div class="sidebar-section">Navigation</div>

    <a href="<?= base_url('list') ?>" class="nav-item">
      <svg viewBox="0 0 24 24"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
      Étudiants
    </a>
    <a href="#" class="nav-item active">
      <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
      Notes
      <span class="nav-badge">1</span>
    </a>

    <div class="sidebar-section">Système</div>

    <a href="#" class="nav-item">
      <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/></svg>
      Paramètres
    </a>

    <div class="sidebar-bottom">
      <a href="#" class="user-row">
        <div class="avatar">AD</div>
        <div class="user-info">
          <div class="name">Admin Sys</div>
          <div class="role">Super administrateur</div>
        </div>
      </a>
    </div>
  </aside>

  <!-- ── Main ─────────────────────────────────────────────────────────────── -->
  <div class="main">

    <div class="topbar">
      <div class="topbar-title">Saisie des Notes - <?= htmlspecialchars($eleve['nom']) ?></div>
      <div class="topbar-actions">
        <button class="icon-btn">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
        </button>
      </div>
    </div>

    <div class="content">

      <div class="page-header">
        <div>
          <h2>Saisie des Notes</h2>
          <div class="breadcrumb">Étudiants / <span><?= htmlspecialchars($eleve['nom']) ?></span></div>
        </div>
      </div>

      <!-- Carte d'information étudiant -->
      <div style="background: #fff; border: 1px solid var(--c-border); border-radius: 8px; padding: 20px; margin-bottom: 24px;">
        <div style="display: flex; align-items: center; gap: 16px;">
          <div style="width: 48px; height: 48px; border-radius: 50%; background: var(--c-primary); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 18px;">
            <?php
            $nomComplet = $eleve['nom'];
            $mots = explode(' ', trim($nomComplet));
            $initiales = '';
            foreach ($mots as $mot) {
                if (!empty($mot)) {
                    $initiales .= strtoupper($mot[0]);
                }
            }
            echo $initiales;
            ?>
          </div>
          <div>
            <h3 style="margin: 0; font-size: 18px; font-weight: 700;"><?= htmlspecialchars($eleve['nom']) ?></h3>
            <p style="margin: 4px 0 0 0; color: var(--c-muted); font-size: 13px;">ETU: <?= htmlspecialchars($eleve['ETU']) ?></p>
          </div>
        </div>
      </div>

      <!-- Tableau des notes -->
      <div class="table-card">
        <form action="<?= base_url('notes/add') ?>" method="POST" id="notesForm">
          <?= csrf_field() ?>
          <input type="hidden" name="idEleve" value="<?= htmlspecialchars($eleve['id']) ?>">

          <?php if (empty($matieres_avec_notes)): ?>
            <div style="text-align: center; padding: 40px; color: var(--c-muted);">
              <p><i style="font-size: 32px;">ℹ️</i></p>
              <p>Aucune matière trouvée</p>
            </div>
          <?php else: ?>
            <table>
              <thead>
                <tr>
                  <th>Code</th>
                  <th>Matière</th>
                  <th>Crédits</th>
                  <th>Semestre</th>
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
                    <td style="color:var(--c-muted);font-family:monospace;font-weight:600;"><?= htmlspecialchars($matiere['codeMatiere'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($matiere['intituleMatiere'] ?? 'N/A') ?></td>
                    <td style="text-align: center;"><?= htmlspecialchars($matiere['nombreCredit'] ?? 'N/A') ?></td>
                    <td>
                      <select 
                        name="semesters[<?= htmlspecialchars($matiere['id']) ?>]"
                        style="width: 70px; padding: 8px 6px; border: 1.5px solid var(--c-border); border-radius: 6px; font-size: 14px;">
                        <option value="">--</option>
                        <?php foreach ([3, 4] as $s): ?>
                          <option value="<?= $s ?>" <?= ($note && $note['numSemestre'] == $s) ? 'selected' : '' ?>>S<?= $s ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td>
                      <input 
                        type="number" 
                        step="0.01" 
                        min="0" 
                        max="20" 
                        name="notes[<?= htmlspecialchars($matiere['id']) ?>]" 
                        style="width: 80px; padding: 8px 12px; border: 1.5px solid var(--c-border); border-radius: 6px; font-size: 14px;"
                        placeholder="--"
                        value="<?= $note ? htmlspecialchars($note['valeurNote']) : '' ?>"
                      >
                    </td>
                    <td>
                      <div class="td-actions">
                        <?php if ($note): ?>
                          <a href="<?= base_url('notes/delete/' . $note['id']) ?>" class="action-btn" onclick="return confirm('Êtes-vous sûr?')" title="Supprimer la note" style="color: var(--c-danger);">
                            <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                          </a>
                        <?php else: ?>
                          <span style="display: inline-block; padding: 2px 8px; background: var(--c-border); border-radius: 4px; font-size: 11px; color: var(--c-muted);">Nouveau</span>
                        <?php endif; ?>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

            <div style="display: flex; gap: 12px; padding: 14px 18px; border-top: 1px solid var(--c-border);">
              <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24" width="15" height="15"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Enregistrer les Notes
              </button>
              <a href="<?= base_url('list') ?>" class="btn btn-secondary" style="text-decoration: none;">
                <svg viewBox="0 0 24 24" width="15" height="15"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                Retour à la liste
              </a>
            </div>
          <?php endif; ?>
        </form>
      </div>

    </div><!-- /content -->
  </div><!-- /main -->
</div><!-- /app -->

</body>
</html>

<?php include APPPATH . 'Views/layouts/footer.php'; ?>
