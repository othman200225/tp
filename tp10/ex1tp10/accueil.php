<?php
// accueil.php
session_start(); // Démarrer la session au tout début

require_once 'config.php'; // Inclure config.php pour accéder à USER_LOGIN

// --- Étape 3 : Vérifier la session pour l'accès et rediriger si non connecté ---
// Vérifier si la variable de session 'CONNECT' existe et a la valeur 'OK'
// ET si le login stocké dans la session correspond au login valide
if (!isset($_SESSION['CONNECT']) || $_SESSION['CONNECT'] !== 'OK' || !isset($_SESSION['login']) || $_SESSION['login'] !== USER_LOGIN) {
    // Si la session n'est pas valide, rediriger vers la page de login
    header("Location: login.php");
    exit();
}

// Si la session est valide, récupérer le login pour l'affichage
$loggedInUser = htmlspecialchars($_SESSION['login']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue !</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #e6ffe6; display: flex; justify-content: center; align-items: center; flex-direction: column; min-height: 100vh; margin: 0; color: #155724; }
        .welcome-container { background-color: #d4edda; padding: 40px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); text-align: center; }
        h1 { font-size: 3em; margin-bottom: 20px; color: #28a745; }
        p { font-size: 1.2em; color: #155724; }
        .logout-link { margin-top: 30px; display: inline-block; background-color: #dc3545; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; transition: background-color 0.3s ease; }
        .logout-link:hover { background-color: #c82333; }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Hello <?php echo $loggedInUser; ?></h1>
        <p>Bienvenue sur la page d'accueil !</p>

        <a href="validation.php?afaire=deconnexion" class="logout-link">Déconnexion</a>
    </div>
</body>
</html>