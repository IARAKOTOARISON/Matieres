<?php if (!empty($message)): ?>
    <p style="color:red; font-weight:bold;">
        <?= esc($message) ?>
    </p>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <p style="color:green; font-weight:bold;">
        <?= session()->getFlashdata('success') ?>
    </p>
<?php endif; ?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SysInfo — Utilisateurs</title>
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
        <div class="brand-name">SysInfo</div>
        <div class="brand-sub">v2.4.0</div>
      </div>
    </div>

    <div class="sidebar-section">Navigation</div>

    <a href="list.html" class="nav-item active">
      <svg viewBox="0 0 24 24"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
      Liste des eleves
      
    </a>

    <div class="sidebar-section">Modules</div>

    <a href="/notes/S3" class="nav-item">
      <svg viewBox="0 0 24 24"><path d="M3 3h7v7H3zM14 3h7v7h-7zM14 14h7v7h-7zM3 14h7v7H3z"/></svg>
      S3
    </a>
    <a href="/notes/S4" class="nav-item">
      <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
      S4
    </a>
    <a href="/notes/L2" class="nav-item">
      <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      L2
    </a>


    <div class="sidebar-bottom">
      <a href="login.html" class="user-row">
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
      <div class="topbar-title">Liste des étudiants</div>
      <div class="topbar-actions">
        <button class="icon-btn">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
        </button>
      </div>
    </div>

    <div class="content">

      <div class="page-header">
        <div>
          <h2>Liste des étudiants</h2>
          <div class="breadcrumb">Accueil / <span>Utilisateurs</span></div>
        </div>
      </div>

      <!-- Tableau -->
      <div class="table-card">
        <table>
          <thead>
            <tr>
              <th class="sortable">Etudiants</th>
              <th class="sortable">Matricule</th>
              <th class="sortable">Parcours</th>
              <th>Actions (voir et inserer les notes)</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($eleves)):  ?>
                <?php foreach ($eleves as $eleve): ?>
                  <tr>
                    <td>
                      <div style="display:flex;align-items:center;gap:10px">
                      <div class="avatar-sm">
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
                          <div style="font-weight:600"><?= esc($eleve['nom']) ?></div>
                          <div style="font-size:11px;color:var(--c-muted)"><?= esc($eleve['nom']) ?>@si.mg</div>
                        </div>
                      </div>
                    </td>
                    <td style="color:var(--c-muted);font-family:monospace"><?= esc($eleve['ETU']) ?></td>
                    <td><span class="badge badge-blue"><?= esc($eleve['nomParcours']) ?></span></td>
                    <td>
                    <div class="td-actions">
                      <a href="<?= base_url('notes/formulaire/' . $eleve['id']) ?>" class="action-btn" title="Gérer les notes" ><svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/> <circle cx="12" cy="12" r="3"/></svg></a>
                    </div>
              </td>
                  </tr>
                <?php endforeach; ?>
            <?php endif; ?>

          </tbody>
        </table>

        <?php if (isset($pager)) : ?>

        <?php
        $perPage = $pager->getPerPage();
        $currentPage = $pager->getCurrentPage();
        $total = $pager->getTotal();
        $pageCount = $pager->getPageCount();

        $start = ($currentPage - 1) * $perPage + 1;
        $end = min($currentPage * $perPage, $total);
        ?>

        <div class="pagination">
          <span>
            Affichage de <strong><?= $start ?>–<?= $end ?></strong>
            sur <strong><?= $total ?></strong> entrées
          </span>

          <div class="page-btns">

            <!-- précédent -->
            <?php if ($currentPage > 1): ?>
                <a href="<?= base_url('list') . '?page=' . ($currentPage - 1) ?>" class="page-btn">‹</a>
            <?php else: ?>
                <span class="page-btn disabled">‹</span>
            <?php endif; ?>

            <!-- pages -->
            <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                <?php if ($i == $currentPage): ?>
                    <span class="page-btn active"><?= $i ?></span>
                <?php else: ?>
                    <a href="<?= base_url('list') . '?page=' . $i ?>" class="page-btn"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <!-- suivant -->
            <?php if ($currentPage < $pageCount): ?>
                <a href="<?= base_url('list') . '?page=' . ($currentPage + 1) ?>" class="page-btn">›</a>
            <?php else: ?>
                <span class="page-btn disabled">›</span>
            <?php endif; ?>

          </div>
        </div>

        <?php endif; ?>

      </div><!-- /table-card -->

    </div><!-- /content -->
  </div><!-- /main -->
</div><!-- /app -->

</body>
</html>
