<?php
// validation.php
session_start(); // Démarrer la session au tout début

require_once 'config.php'; // Inclure le fichier de configuration

// --- Étape 3 : Gérer la déconnexion si 'afaire=deconnexion' est passé dans l'URL ---
if (isset($_GET['afaire']) && $_GET['afaire'] === 'deconnexion') {
    // Détruire toutes les variables de session
    $_SESSION = array();

    // Si vous voulez détruire complètement la session, effacez également le cookie de session.
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finalement, détruire la session.
    session_destroy();

    // Rediriger vers login.php avec le code d'erreur 3 pour le message de déconnexion
    header("Location: login.php?error=3");
    exit();
}

// --- Traitement du formulaire de connexion (Méthode POST) ---
// Récupérer les données soumises par le formulaire
$login_attempt = isset($_POST['login']) ? trim($_POST['login']) : '';
$password_attempt = isset($_POST['password']) ? trim($_POST['password']) : '';

// 1. Vérifier si les champs sont vides
if (empty($login_attempt) || empty($password_attempt)) {
    header("Location: login.php?error=1");
    exit();
}

// 2. Vérifier si le login et le mot de passe sont corrects
if ($login_attempt === USER_LOGIN && $password_attempt === USER_PASS) {
    // Étape 2 : Connexion réussie - Ouvrir une session et créer des variables de session
    $_SESSION['CONNECT'] = 'OK';
    $_SESSION['login'] = USER_LOGIN; // Stocker le login dans la session
    $_SESSION['password_hash'] = hash('sha256', USER_PASS); // Stocker un HASH du mot de passe (meilleur que le clair)

    // Rediriger vers la page d'accueil
    header("Location: accueil.php");
    exit();
} else {
    // Erreur de login ou de mot de passe (identifiants incorrects)
    header("Location: login.php?error=2");
    exit();
}
?>