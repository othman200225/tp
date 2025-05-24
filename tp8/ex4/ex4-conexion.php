<?php
// Démarrer la session au tout début du script
session_start();

$error_message = ''; // Variable pour stocker les messages d'erreur

// Identifiants définis dans le code (pour l'exemple sans base de données)
$valid_username = 'utilisateur';
$valid_password = 'motdepasse'; // Un mot de passe en clair pour l'exemple, JAMAIS en production !

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Vérifier les identifiants
    if ($username === $valid_username && $password === $valid_password) {
        // Connexion réussie :
        // 1. Enregistrer le nom d'utilisateur dans la session
        $_SESSION['username'] = $username;
        // 2. Rediriger vers la page de bienvenue
        header("Location: welcome.php");
        exit(); // Toujours appeler exit() après une redirection pour s'assurer que le script s'arrête
    } else {
        // Identifiants incorrects
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

// Vérifier si l'utilisateur est déjà connecté (pour éviter de montrer la page de login s'il est déjà authentifié)
if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion au Système</title>
    
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>
        <?php if ($error_message): ?>
            <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div>
                <label for="username">Identifiant :</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>