<?php
// login.php
session_start(); // Démarrer la session au tout début

$error_message = ''; // Variable pour afficher le message d'erreur

// Vérifier si un code d'erreur a été passé via l'URL (méthode GET)
if (isset($_GET['error'])) {
    $error_code = (int)$_GET['error']; // Convertir en entier

    switch ($error_code) {
        case 1:
            $error_message = "Veuillez saisir un login et un mot de passe.";
            break;
        case 2:
            $error_message = "Erreur de login/mot de passe.";
            break;
        case 3: // Nouveau message pour la déconnexion (Étape 3)
            $error_message = "Vous avez été déconnecté du service.";
            break;
        default:
            $error_message = "Une erreur inconnue est survenue.";
            break;
    }
}

// Optionnel: Si l'utilisateur est déjà connecté, le rediriger vers accueil.php
// Nous devons inclure config.php ici pour accéder à USER_LOGIN pour cette vérification.
require_once 'config.php';
if (isset($_SESSION['CONNECT']) && $_SESSION['CONNECT'] === 'OK' && isset($_SESSION['login']) && $_SESSION['login'] === USER_LOGIN) {
    header("Location: accueil.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .login-container { background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 90%; max-width: 350px; text-align: center; }
        h1 { color: #333; margin-bottom: 25px; }
        .error-message { color: red; margin-bottom: 20px; font-weight: bold; }
        /* Style spécifique pour le message de déconnexion */
        .error-message.disconnected { color: green; }
        form { display: flex; flex-direction: column; gap: 15px; }
        label { text-align: left; font-weight: bold; color: #555; }
        input[type="text"], input[type="password"] { padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 1em; width: calc(100% - 22px); box-sizing: border-box; }
        button { background-color: #007bff; color: white; padding: 12px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 1.1em; transition: background-color 0.3s ease; margin-top: 20px; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Authentification</h1>

        <?php if ($error_message): // Afficher le message d'erreur s'il existe ?>
            <p class="error-message <?php echo ($_GET['error'] == 3) ? 'disconnected' : ''; ?>">
                <?php echo htmlspecialchars($error_message); ?>
            </p>
        <?php endif; ?>

        <form action="validation.php" method="POST">
            <div>
                <label for="login">Login :</label>
                <input type="text" id="login" name="login" required>
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