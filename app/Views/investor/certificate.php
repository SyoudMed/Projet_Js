<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificat d'Investissement - StartuPInvest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }
        .certificate-container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 60px;
            border: 15px solid #0d6efd;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .certificate-watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.05;
            font-size: 150px;
            z-index: 0;
            pointer-events: none;
        }
        .content { position: relative; z-index: 1; }
        .header { text-align: center; margin-bottom: 40px; }
        .logo { font-size: 28px; font-weight: 800; color: #0d6efd; text-transform: uppercase; letter-spacing: 2px; }
        .title { font-size: 42px; font-weight: 700; color: #333; margin-top: 20px; }
        .subtitle { font-size: 18px; color: #666; margin-bottom: 30px; }
        .details { margin: 40px 0; line-height: 1.8; font-size: 18px; }
        .highlight { font-weight: 700; color: #0d6efd; border-bottom: 2px solid #0d6efd; }
        .footer-sig { margin-top: 60px; display: flex; justify-content: space-between; align-items: flex-end; }
        .signature { border-top: 1px solid #ccc; width: 200px; text-align: center; padding-top: 10px; font-size: 14px; color: #888; }
        .stamp { width: 100px; opacity: 0.8; }
        
        @media print {
            .no-print { display: none; }
            .certificate-container { margin: 0; border: none; box-shadow: none; }
            body { background: white; }
        }
    </style>
</head>
<body>

<div class="container no-print mt-4 text-center">
    <button onclick="window.print()" class="btn btn-primary px-4 me-2"><i class="fa-solid fa-print me-2"></i>Imprimer le certificat</button>
    <a href="<?= URLROOT ?>/investor/dashboard" class="btn btn-outline-secondary px-4">Retour au tableau de bord</a>
</div>

<div class="certificate-container">
    <div class="certificate-watermark"><i class="fa-solid fa-shield-halved"></i></div>
    
    <div class="content">
        <div class="header">
            <div class="logo">StartuPInvest</div>
            <h1 class="title">Certificat d'Investissement</h1>
            <p class="subtitle">Attestation Officielle de Détention d'Actions</p>
        </div>

        <div class="details">
            <p>Par la présente, la plateforme <span class="highlight">StartuPInvest</span> certifie que :</p>
            <p class="text-center my-4 fs-3 fw-bold"><?= htmlspecialchars($investment['investor_prenom'] . ' ' . $investment['investor_nom']) ?></p>
            <p>A réalisé un investissement stratégique dans le projet :</p>
            <p class="text-center my-4 fs-4 fw-bold text-primary"><?= htmlspecialchars($investment['titre']) ?> <span class="fs-6 text-muted fw-normal">(<?= htmlspecialchars($investment['startup_name']) ?>)</span></p>
            
            <div class="row mt-5 text-center bg-light p-4 rounded-3 border border-custom">
                <div class="col-6 border-end">
                    <p class="small text-muted mb-1">Nombre d'actions</p>
                    <p class="fw-bold fs-4 mb-0"><?= number_format($investment['nb_actions']) ?> Actions</p>
                </div>
                <div class="col-6">
                    <p class="small text-muted mb-1">Montant Total Investi</p>
                    <p class="fw-bold fs-4 mb-0 text-success"><?= number_format($investment['montant_total'], 2) ?> DT</p>
                </div>
            </div>
        </div>

        <div class="mt-4 small text-muted">
            <p>ID de Transaction : <span class="font-monospace"><?= strtoupper(substr(md5($investment['id']), 0, 12)) ?></span></p>
            <p>Date d'émission : <?= date('d/m/Y H:i', strtotime($investment['date_investissement'])) ?></p>
        </div>

        <div class="footer-sig">
            <div class="signature">
                <p class="mb-0">Direction StartuPInvest</p>
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=<?= URLROOT ?>/investor/certificate?id=<?= $investment['id'] ?>" class="stamp mt-2" alt="QR Code">
            </div>
            <div class="signature">
                <p class="mb-0">Sceau d'Authenticité</p>
                <i class="fa-solid fa-certificate fa-4x text-primary mt-2"></i>
            </div>
        </div>
    </div>
</div>

</body>
</html>
