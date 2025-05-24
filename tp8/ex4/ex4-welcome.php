<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur n'est PAS connecté
if (!isset($_SESSION['username'])) {
    // Rediriger vers la page de connexion
    header("Location: login.php");
    exit();
}

$username = htmlspecialchars($_SESSION['username']); // Récupérer le nom d'utilisateur de la session
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue !</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .container { background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 90%; max-width: 500px; text-align: center; }
        h1 { color: #28a745; margin-bottom: 20px; }
        p { color: #555; font-size: 1.1em; margin-bottom: 30px; }
        .logout-link { background-color: #dc3545; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; transition: background-color 0.3s ease; }
        .logout-link:hover { background-color: #c82333; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue, <?php echo $username; ?> !</h1>
        <p>Vous êtes maintenant connecté(e) à votre espace personnel.</p>
        <a href="logout.php" class="logout-link">Déconnexion</a>
    </div>
</body>
</html>