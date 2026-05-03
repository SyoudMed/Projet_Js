<?php
// Register a simple autoloader for the seed script
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/app/';
    
    if (strncmp($prefix, $class, strlen($prefix)) === 0) {
        $relative_class = substr($class, strlen($prefix));
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
    
    // Config namespace
    if (strncmp('Config\\', $class, 7) === 0) {
        $relative_class = substr($class, 7);
        $file = __DIR__ . '/config/' . str_replace('\\', '/', $relative_class) . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }
});

use Config\Database;

$db = Database::getInstance()->getConnection();

function createUser($role, $nom, $prenom, $email, $pseudo, $password, $nom_ent = null, $adr_ent = null, $reg_com = null) {
    global $db;
    
    $stmt = $db->prepare("SELECT id FROM users WHERE email = ? OR pseudo = ?");
    $stmt->execute([$email, $pseudo]);
    if ($stmt->rowCount() > 0) return $stmt->fetchColumn();

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $cin = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
    
    $stmt = $db->prepare("INSERT INTO users (role, nom, prenom, cin, email, pseudo, password, nom_entreprise, adresse_entreprise, registre_commerce) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$role, $nom, $prenom, $cin, $email, $pseudo, $hashed_password, $nom_ent, $adr_ent, $reg_com]);
    
    return $db->lastInsertId();
}

$startuperId = createUser('startuper', 'Jobs', 'Steve', 'steve@apple.com', 'steve_jobs', 'password123', 'Apple Inc', 'Cupertino, CA', 'RC-12345');
$startuper2Id = createUser('startuper', 'Musk', 'Elon', 'elon@tesla.com', 'elon_musk', 'password123', 'SpaceX', 'Boca Chica, TX', 'RC-98765');
$investorId = createUser('capital_risque', 'Buffett', 'Warren', 'warren@berkshire.com', 'warren_b', 'password123');
$adminId = createUser('admin', 'Admin', 'Super', 'admin@startupinvest.com', 'admin_super', 'admin123');

function createProject($startuper_id, $titre, $desc, $secteur, $nb_actions, $prix, $statut) {
    global $db;
    
    $stmt = $db->prepare("SELECT id FROM projects WHERE titre = ?");
    $stmt->execute([$titre]);
    if ($stmt->rowCount() > 0) return $stmt->fetchColumn();

    $date_limite = date('Y-m-d', strtotime('+30 days'));
    
    $stmt = $db->prepare("INSERT INTO projects (startuper_id, titre, description, secteur, nb_actions, prix_unitaire, date_limite, statut) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$startuper_id, $titre, $desc, $secteur, $nb_actions, $prix, $date_limite, $statut]);
    
    return $db->lastInsertId();
}

if ($startuperId) {
    createProject($startuperId, 'NextGen AI Device', "Un appareil portable révolutionnaire qui utilise l'Intelligence Artificielle pour assister les malvoyants au quotidien en analysant l'environnement en temps réel.", 'Technologie', 5000, 100.00, 'actif');
}
if ($startuper2Id) {
    createProject($startuper2Id, 'EcoFarm Solar', "Ferme agricole 100% autonome en énergie grâce à des panneaux solaires innovants couplés à un système d'irrigation intelligent.", 'Énergie', 10000, 50.00, 'actif');
    createProject($startuper2Id, 'MediTrack Pro', "Une application de suivi médical permettant aux patients diabétiques de partager instantanément leurs données avec leurs médecins.", 'Santé', 2000, 75.00, 'actif');
}

echo "Dummy data seeded successfully!\n";
?>
