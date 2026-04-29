<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login SysInfo</title>

  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

<div class="login-page">

  <div class="login-card">

    <div class="login-logo">
      <div class="logo-icon">
        <svg viewBox="0 0 24 24" width="22" height="22">
          <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
        </svg>
      </div>
      <div>
        <h1>SysInfo</h1>
        <span>Système d'Information</span>
      </div>
    </div>

    <h2>Connexion</h2>
    <p class="subtitle">Connectez-vous à votre espace</p>

    <!-- ERREUR -->
    <?php if(session()->getFlashdata('error')): ?>
      <div style="color:red; margin-bottom:15px;">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <!-- FORM -->
    <form method="post" action="<?= base_url('login') ?>">
      <?= csrf_field() ?>

      <div class="field-group">
        <label>Email</label>
        <div class="input-wrap">
          <input type="email" name="email" placeholder="admin@sysinfo.mg">
        </div>
      </div>

      <div class="field-group">
        <label>Mot de passe</label>
        <div class="input-wrap">
          <input type="password" name="password" placeholder="••••••••">
        </div>
      </div>

      <button type="submit" class="btn btn-primary btn-full">
        Se connecter
      </button>

    </form>

    <div class="login-footer">
      © SysInfo - Gestion système
    </div>

  </div>

</div>

</body>
</html>