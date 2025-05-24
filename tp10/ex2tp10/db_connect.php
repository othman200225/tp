<?php
// db_connect.php - Connexion à la base de données MySQL avec PDO

$host = 'localhost'; // L'adresse de votre serveur de base de données (souvent 'localhost')
$db = 'TP10';       // Le nom de la base de données que nous avons créée
$user = 'root';    // Votre nom d'utilisateur MySQL (par défaut 'root' pour XAMPP/UwAmp)
$pass = '';        // Votre mot de passe MySQL (par défaut vide pour XAMPP/UwAmp)
$charset = 'utf8mb4'; // Jeu de caractères pour supporter les caractères spéciaux

// Data Source Name (DSN) - Chaîne de connexion
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Options PDO pour une meilleure gestion des erreurs et des requêtes
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Active le mode d'erreur pour les exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Définit le mode de récupération par défaut en tableau associatif
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Désactive l'émulation des requêtes préparées pour de meilleures performances et sécurité
];

try {
    // Crée une nouvelle instance PDO pour la connexion à la base de données
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // En cas d'erreur de connexion, affiche un message d'erreur et arrête le script
    // En production, il est préférable de logger l'erreur plutôt que de l'afficher directement
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>