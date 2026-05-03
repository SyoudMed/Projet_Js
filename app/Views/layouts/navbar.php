<nav class="navbar navbar-expand-lg sticky-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary" href="/js_project/public/">
        <i class="fa-solid fa-rocket me-2"></i>StartuPInvest
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="/js_project/public/">Accueil</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <?php if(isset($_SESSION['user_id'])): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <?= htmlspecialchars($_SESSION['pseudo'] ?? 'Mon Compte') ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <?php if($_SESSION['role'] === 'startuper'): ?>
                        <li><a class="dropdown-item" href="/js_project/public/startuper/dashboard">Tableau de bord</a></li>
                    <?php elseif($_SESSION['role'] === 'capital_risque'): ?>
                        <li><a class="dropdown-item" href="/js_project/public/investor/dashboard">Tableau de bord</a></li>
                    <?php elseif($_SESSION['role'] === 'admin'): ?>
                        <li><a class="dropdown-item" href="/js_project/public/admin/dashboard">Administration</a></li>
                    <?php endif; ?>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="/js_project/public/auth/logout">Déconnexion</a></li>
                </ul>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="/js_project/public/auth/login">Connexion</a>
            </li>
        <?php endif; ?>
        <li class="nav-item ms-3 d-flex align-items-center">
            <button id="theme-toggle" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 32px; height: 32px; padding: 0;">
                <i class="fa-solid fa-moon"></i>
            </button>
        </li>
      </ul>
    </div>
  </div>
</nav>
