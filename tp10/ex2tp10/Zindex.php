<?php
// index.php - Page principale pour ajouter, afficher et supprimer des exercices (CRUD - Create, Read, Delete)

// Inclure le fichier de connexion à la base de données
require_once 'db_connect.php';

$message = ''; // Variable pour stocker les messages de succès ou d'échec
$message_type = ''; // 'success' ou 'error'

// --- Traitement de l'ajout d'un nouvel exercice (CREATE) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $titre = trim($_POST['titre']);
    $auteur = trim($_POST['auteur']);

    if (empty($titre) || empty($auteur)) {
        $message = "Le titre et l'auteur ne peuvent pas être vides.";
        $message_type = 'error';
    } else {
        try {
            // Préparer la requête SQL pour insérer un nouvel exercice
            // Les requêtes préparées sont essentielles pour prévenir les injections SQL
            $stmt = $pdo->prepare("INSERT INTO exercice (titre, auteur) VALUES (?, ?)");
            // Exécuter la requête avec les valeurs fournies par l'utilisateur
            $stmt->execute([$titre, $auteur]);

            $message = "Exercice ajouté avec succès !";
            $message_type = 'success';
        } catch (PDOException $e) {
            $message = "Erreur lors de l'ajout de l'exercice : " . $e->getMessage();
            $message_type = 'error';
        }
    }
}

// --- Traitement de la suppression d'un exercice (DELETE) ---
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id_to_delete = (int)$_GET['id']; // Convertir l'ID en entier pour plus de sécurité

    try {
        // Préparer la requête SQL pour supprimer un exercice par son ID
        $stmt = $pdo->prepare("DELETE FROM exercice WHERE id = ?");
        $stmt->execute([$id_to_delete]);

        // Vérifier si une ligne a été affectée (si l'exercice existait et a été supprimé)
        if ($stmt->rowCount() > 0) {
            $message = "Exercice supprimé avec succès !";
            $message_type = 'success';
        } else {
            $message = "L'exercice avec l'ID " . $id_to_delete . " n'existe pas.";
            $message_type = 'error';
        }
    } catch (PDOException $e) {
        $message = "Erreur lors de la suppression de l'exercice : " . $e->getMessage();
        $message_type = 'error';
    }
    // Rediriger pour nettoyer l'URL après la suppression
    header("Location: index.php?message=" . urlencode($message) . "&type=" . $message_type);
    exit();
}

// --- Récupération des messages de redirection (après modification ou suppression) ---
if (isset($_GET['message']) && isset($_GET['type'])) {
    $message = htmlspecialchars($_GET['message']);
    $message_type = htmlspecialchars($_GET['type']);
}

// --- Récupération de la liste de tous les exercices (READ) ---
$exercices = []; // Initialiser un tableau vide pour stocker les exercices
try {
    // Préparer et exécuter la requête SQL pour sélectionner tous les exercices
    // Ordonner par ID décroissant pour voir les plus récents en premier
    $stmt = $pdo->query("SELECT id, titre, auteur, date_creation FROM exercice ORDER BY id DESC");
    $exercices = $stmt->fetchAll(); // Récupérer toutes les lignes
} catch (PDOException $e) {
    $message = "Erreur lors de la récupération des exercices : " . $e->getMessage();
    $message_type = 'error';
}
?