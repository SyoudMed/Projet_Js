<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1 pb-5">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
        <div>
            <h2 class="fw-bold mb-1 h1">Console Fondateur</h2>
            <p class="text-muted-custom mb-0">Pilotez votre croissance et gérez vos levées de fonds.</p>
        </div>
        <a href="<?= URLROOT ?>/startuper/create" class="btn btn-primary px-4 py-2 shadow-sm rounded-3">
            <i class="fa-solid fa-plus me-2"></i>Lancer une campagne
        </a>
    </div>

    <!-- Status Messages -->
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-5 p-3" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>
            <?php 
                if($_GET['success'] == 'updated') echo "Projet mis à jour avec succès !";
                if($_GET['success'] == 'abandoned') echo "Le projet a été abandonné.";
            ?>
        </div>
    <?php elseif(isset($_GET['error'])): ?>
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-5 p-3" role="alert">
            <i class="fa-solid fa-circle-exclamation me-2"></i>
            <?php 
                if($_GET['error'] == 'restricted') echo "Action impossible : ce projet a déjà reçu des investissements.";
                else echo "Une erreur est survenue.";
            ?>
        </div>
    <?php endif; ?>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="saas-card border-0 p-4 position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 p-3 opacity-10">
                    <i class="fa-solid fa-rocket fa-4x"></i>
                </div>
                <h6 class="text-muted-custom text-uppercase small fw-bold mb-3" style="letter-spacing: 0.05em;">Projets Actifs</h6>
                <h2 class="fw-bold mb-0 text-main"><?= $totalProjects ?></h2>
                <p class="small text-muted-custom mt-2 mb-0">Campagnes en cours</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="saas-card border-0 p-4 position-relative overflow-hidden bg-primary bg-opacity-10 border-primary border-opacity-10">
                <div class="position-absolute top-0 end-0 p-3 opacity-10">
                    <i class="fa-solid fa-coins fa-4x text-primary"></i>
                </div>
                <h6 class="text-primary text-uppercase small fw-bold mb-3" style="letter-spacing: 0.05em;">Fonds Totaux Levés</h6>
                <h2 class="fw-bold mb-0 text-primary"><?= number_format($totalRaised, 2) ?> <span class="fs-4 fw-medium">DT</span></h2>
                <p class="small text-primary mt-2 mb-0 opacity-75">Impact généré</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="saas-card border-0 p-4 position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 p-3 opacity-10">
                    <i class="fa-solid fa-users fa-4x"></i>
                </div>
                <h6 class="text-muted-custom text-uppercase small fw-bold mb-3" style="letter-spacing: 0.05em;">Base Investisseurs</h6>
                <h2 class="fw-bold mb-0 text-main"><?= $totalInvestors ?></h2>
                <p class="small text-muted-custom mt-2 mb-0">Partenaires uniques</p>
            </div>
        </div>
    </div>

    <!-- Projects Table -->
    <div class="saas-card border-0 overflow-hidden shadow-sm">
        <div class="px-4 py-4 border-bottom border-custom d-flex justify-content-between align-items-center bg-surface">
            <h5 class="fw-bold mb-0 text-main">Gestion des Campagnes</h5>
        </div>
        <div class="p-0">
            <?php if(empty($projects)): ?>
                <div class="text-center py-5">
                    <i class="fa-solid fa-folder-open fa-3x text-muted-custom opacity-25 mb-3"></i>
                    <p class="text-muted-custom">Vous n'avez pas encore publié de projets.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-saas table-borderless align-middle w-100 mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">PROJET</th>
                                <th>SECTEUR</th>
                                <th>OBJECTIF</th>
                                <th>STATUT / ACTIONNAIRES</th>
                                <th>ÉCHÉANCE</th>
                                <th class="text-end pe-4">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($projects as $p): ?>
                            <tr class="hover-elevate">
                                <td class="ps-4">
                                    <div class="fw-bold text-main"><?= htmlspecialchars($p['titre']) ?></div>
                                    <div class="small text-muted-custom opacity-75">ID: #<?= $p['id'] ?></div>
                                </td>
                                <td><span class="badge bg-light text-muted-custom border border-custom px-2 py-1"><?= htmlspecialchars($p['secteur']) ?></span></td>
                                <td class="fw-bold text-main"><?= number_format($p['nb_actions'] * $p['prix_unitaire'], 2) ?> DT</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <?php if($p['statut'] === 'en_attente'): ?>
                                            <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 border border-warning border-opacity-25"><i class="fa-solid fa-clock me-1"></i>En attente</span>
                                        <?php elseif($p['statut'] === 'actif'): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 border border-success border-opacity-25"><i class="fa-solid fa-check-circle me-1"></i>Actif</span>
                                        <?php elseif($p['statut'] === 'cloture'): ?>
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1 border border-secondary border-opacity-25"><i class="fa-solid fa-lock me-1"></i>Clôturé</span>
                                        <?php elseif($p['statut'] === 'abandonne'): ?>
                                            <span class="badge bg-dark bg-opacity-10 text-muted px-2 py-1 border border-secondary border-opacity-25"><i class="fa-solid fa-circle-xmark me-1"></i>Abandonné</span>
                                        <?php endif; ?>

                                        <?php if($p['statut'] !== 'en_attente'): ?>
                                            <a href="<?= URLROOT ?>/startuper/investors?project_id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-primary py-1 px-2 rounded-pill small" style="font-size: 0.7rem;">
                                                <i class="fa-solid fa-users-viewfinder me-1"></i>Actionnaires
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="small text-muted-custom"><?= date('d M Y', strtotime($p['date_limite'])) ?></td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <a href="<?= URLROOT ?>/startuper/show?id=<?= $p['id'] ?>" class="btn btn-sm btn-light border-custom" title="Aperçu"><i class="fa-solid fa-eye"></i></a>
                                        
                                        <?php if($p['sold_actions'] == 0): ?>
                                            <a href="<?= URLROOT ?>/startuper/edit?id=<?= $p['id'] ?>" class="btn btn-sm btn-light border-custom" title="Modifier"><i class="fa-solid fa-pen"></i></a>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-light border-custom opacity-50" title="Modification impossible (actions vendues)" disabled><i class="fa-solid fa-pen"></i></button>
                                        <?php endif; ?>

                                        <button onclick="confirmAbandon(<?= $p['id'] ?>)" class="btn btn-sm btn-light border-custom text-danger" title="Abandonner"><i class="fa-solid fa-ban"></i></button>
                                    </div>
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

<script>
function confirmAbandon(id) {
    if(confirm('Êtes-vous sûr de vouloir abandonner ce projet ? Cette action est irréversible.')) {
        window.location.href = '<?= URLROOT ?>/startuper/abandon?id=' + id;
    }
}
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
