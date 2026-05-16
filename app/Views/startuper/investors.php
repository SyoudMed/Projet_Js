<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1">
    <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom border-custom">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item small"><a href="<?= URLROOT ?>/startuper/dashboard" class="text-decoration-none">Tableau de bord</a></li>
                    <li class="breadcrumb-item active small" aria-current="page">Actionnaires</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-1">Table de Capitalisation</h2>
            <p class="text-muted-custom mb-0">Projet : <span class="text-main fw-semibold"><?= htmlspecialchars($project['titre']) ?></span></p>
        </div>
        <div class="text-end">
            <h4 class="fw-bold mb-0 text-success"><?= number_format($totalRaised, 2) ?> DT</h4>
            <p class="small text-muted-custom mb-0">Levée de fonds totale</p>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="saas-card border-0 p-4">
                <h6 class="text-muted-custom text-uppercase small fw-bold mb-3">Actions Vendues</h6>
                <div class="d-flex align-items-end">
                    <h2 class="fw-bold mb-0 me-2"><?= number_format($totalSold) ?></h2>
                    <p class="text-muted-custom mb-1">/ <?= number_format($project['nb_actions']) ?></p>
                </div>
                <div class="progress mt-3 bg-bg-color rounded-pill" style="height: 6px;">
                    <?php $percent = round(($totalSold / $project['nb_actions']) * 100); ?>
                    <div class="progress-bar bg-primary" style="width: <?= $percent ?>%"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="saas-card border-0 p-4">
                <h6 class="text-muted-custom text-uppercase small fw-bold mb-3">Nombre d'Investisseurs</h6>
                <h2 class="fw-bold mb-0"><?= count($investors) ?></h2>
                <p class="text-muted-custom small mt-2 mb-0"><i class="fa-solid fa-users me-1"></i> Soutien de la communauté</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="saas-card border-0 p-4">
                <h6 class="text-muted-custom text-uppercase small fw-bold mb-3">Statut du Projet</h6>
                <div class="d-flex align-items-center">
                    <?php if($project['statut'] === 'cloture'): ?>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2">
                            <i class="fa-solid fa-check-double me-1"></i> Financement Réussi
                        </span>
                    <?php else: ?>
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2">
                            <i class="fa-solid fa-spinner fa-spin me-1"></i> En cours de levée
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Investors Table -->
    <div class="saas-card border-0 overflow-hidden mb-5">
        <div class="bg-surface px-4 py-3 border-bottom border-custom d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold mb-0">Liste des Actionnaires</h5>
        </div>
        <div class="p-0">
            <?php if(empty($investors)): ?>
                <div class="text-center py-5">
                    <p class="text-muted-custom mb-0">Aucun investisseur pour le moment.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-saas table-borderless align-middle w-100">
                        <thead>
                            <tr>
                                <th>Investisseur</th>
                                <th>Email</th>
                                <th>Actions Détenues</th>
                                <th>Montant</th>
                                <th>Date d'entrée</th>
                                <th class="text-end">Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($investors as $inv): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                                            <span class="small fw-bold"><?= substr($inv['prenom'], 0, 1) ?></span>
                                        </div>
                                        <span class="fw-medium text-main"><?= htmlspecialchars($inv['prenom'] . ' ' . $inv['nom']) ?></span>
                                    </div>
                                </td>
                                <td class="text-muted-custom small"><?= htmlspecialchars($inv['email']) ?></td>
                                <td class="fw-bold"><?= number_format($inv['nb_actions']) ?></td>
                                <td class="text-success fw-bold"><?= number_format($inv['montant_total'], 2) ?> DT</td>
                                <td class="text-muted-custom small"><?= date('d/m/Y', strtotime($inv['date_investissement'])) ?></td>
                                <td class="text-end">
                                    <a href="<?= URLROOT ?>/messages/chat?project_id=<?= $inv['project_id'] ?>&other_id=<?= $inv['investor_id'] ?>" class="btn btn-sm btn-outline-primary py-1 px-2">
                                        <i class="fa-regular fa-message"></i>
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
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
