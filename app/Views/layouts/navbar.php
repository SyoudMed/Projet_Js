<nav class="navbar navbar-expand-lg sticky-top navbar-custom shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary fs-4" href="/js_project/public/">
        <i class="fa-solid fa-bolt text-primary me-2"></i>StartuPInvest
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto ps-lg-4">
        <li class="nav-item">
          <a class="nav-link fw-medium" href="/js_project/public/">Accueil</a>
        </li>
      </ul>
      <ul class="navbar-nav align-items-center">
        <?php if(isset($_SESSION['user_id'])): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle fw-medium" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fa-regular fa-circle-user me-1"></i> <?= htmlspecialchars($_SESSION['pseudo'] ?? 'Mon Compte') ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-custom mt-2">
                    <?php if($_SESSION['role'] === 'startuper'): ?>
                        <li><a class="dropdown-item py-2" href="/js_project/public/startuper/dashboard"><i class="fa-solid fa-chart-line me-2 text-muted-custom"></i>Tableau de bord</a></li>
                    <?php elseif($_SESSION['role'] === 'capital_risque'): ?>
                        <li><a class="dropdown-item py-2" href="/js_project/public/investor/dashboard"><i class="fa-solid fa-wallet me-2 text-muted-custom"></i>Tableau de bord</a></li>
                    <?php elseif($_SESSION['role'] === 'admin'): ?>
                        <li><a class="dropdown-item py-2" href="/js_project/public/admin/dashboard"><i class="fa-solid fa-shield-halved me-2 text-muted-custom"></i>Administration</a></li>
                    <?php endif; ?>
                    <li><hr class="dropdown-divider border-custom"></li>
                    <li><a class="dropdown-item py-2 text-danger" href="/js_project/public/auth/logout"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Déconnexion</a></li>
                </ul>
            </li>
        <?php else: ?>
            <li class="nav-item me-2">
                <a class="nav-link fw-medium" href="/js_project/public/auth/login">Connexion</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary px-4 py-2 shadow-sm" href="/js_project/public/auth/registerInvestor">Créer un compte</a>
            </li>
        <?php endif; ?>
        <li class="nav-item ms-3 border-start border-custom ps-3">
            <button id="theme-toggle" class="btn btn-link text-muted-custom p-0 text-decoration-none fs-5">
                <i class="fa-solid fa-moon"></i>
            </button>
        </li>
      </ul>
    </div>
  </div>
</nav>
