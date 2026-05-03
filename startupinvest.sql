-- Database creation
CREATE DATABASE IF NOT EXISTS startupinvest;
USE startupinvest;

-- Users table
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `cin` varchar(8) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('startuper', 'capital_risque', 'admin') NOT NULL,
  `nom_entreprise` varchar(255) DEFAULT NULL,
  `adresse_entreprise` text DEFAULT NULL,
  `registre_commerce` varchar(100) DEFAULT NULL,
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Projects table
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startuper_id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `secteur` varchar(100) NOT NULL,
  `nb_actions` int(11) NOT NULL,
  `prix_unitaire` decimal(10,2) NOT NULL,
  `date_limite` date NOT NULL,
  `business_plan_path` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `statut` enum('en_attente', 'actif', 'suspendu', 'cloture') DEFAULT 'en_attente',
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `startuper_id` (`startuper_id`),
  CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`startuper_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Investments table
CREATE TABLE `investments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investor_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `nb_actions` int(11) NOT NULL,
  `montant_total` decimal(15,2) NOT NULL,
  `date_investissement` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `investor_id` (`investor_id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `investments_ibfk_1` FOREIGN KEY (`investor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `investments_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Favorites table
CREATE TABLE `favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investor_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_favorite` (`investor_id`, `project_id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`investor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Reviews table
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `note` int(1) NOT NULL CHECK (`note` >= 1 AND `note` <= 5),
  `commentaire` text DEFAULT NULL,
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Messages table
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert an initial admin user (password is 'password')
INSERT INTO `users` (`nom`, `prenom`, `email`, `pseudo`, `password`, `role`) VALUES
('Admin', 'Super', 'admin@startupinvest.com', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
