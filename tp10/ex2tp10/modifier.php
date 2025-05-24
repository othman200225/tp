<?php
// modifier.php - Page pour modifier un exercice existant (CRUD - Update)

require_once 'db_connect.php'; // Inclure le fichier de connexion à la base de données

$exercice = null; // Variable pour stocker les données de l'exercice à modifier
$message = '';    // Message de succès ou d'erreur
$message_type = ''; // 'success' ou 'error'

// --- Traitement de la soumission du formulaire de modification (POST) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = (int)$_POST['id']; // L'ID de l'exercice à modifier
    $titre = trim($_POST['titre']);
    $auteur = trim($_POST['auteur']);

    if (empty($titre) || empty($auteur)) {
        $message = "Le titre et l'auteur ne peuvent pas être vides.";
        $message_type = 'error';
    } else {
        try {
            // Préparer la requête SQL pour mettre à jour l'exercice
            $stmt = $pdo->prepare("UPDATE exercice SET titre = ?, auteur = ? WHERE id = ?");
            $stmt->execute([$titre, $auteur, $id]);

            // Vérifier si la mise à jour a affecté une ligne
            if ($stmt->rowCount() > 0) {
                $message = "Exercice modifié avec succès !";
                $message_type = 'success';
            } else {
                $message = "Aucune modification effectuée ou exercice non trouvé.";
                $message_type = 'info'; // 'info' pour indiquer qu'il n'y a pas eu de changement
            }
            // Rediriger vers la page principale avec un message
            header("Location: index.php?message=" . urlencode($message) . "&type=" . $message_type);
            exit();
        } catch (PDOException $e) {
            $message = "Erreur lors de la modification de l'exercice : " . $e->getMessage();
            $message_type = 'error';
        }
    }
}

// --- Récupération de l'exercice par son ID (GET) ---
// Ce bloc s'exécute lorsque la page est chargée via le lien "Modifier"
if (isset($_GET['id'])) {
    $id_to_edit = (int)$_GET['id']; // Récupérer l'ID de l'URL

    try {
        // Préparer et exécuter la requête pour récupérer l'exercice spécifique
        $stmt = $pdo->prepare("SELECT id, titre, auteur FROM exercice WHERE id = ?");
        $stmt->execute([$id_to_edit]);
        $exercice = $stmt->fetch(); // Récupérer la première ligne (l'exercice)

        if (!$exercice) {
            // Si aucun exercice n'est trouvé avec cet ID
            $message = "Exercice non trouvé.";
            $message_type = 'error';
            // Rediriger vers la page principale si l'exercice n'existe pas
            header("Location: index.php?message=" . urlencode($message) . "&type=" . $message_type);
            exit();
        }
    } catch (PDOException $e) {
        $message = "Erreur lors de la récupération de l'exercice : " . $e->getMessage();
        $message_type = 'error';
        header("Location: index.php?message=" . urlencode($message) . "&type=" . $message_type);
        exit();
    }
} else {
    // Si aucun ID n'est fourni dans l'URL, rediriger vers la page principale
    header("Location: index.php?message=" . urlencode("ID d'exercice manquant pour la modification.") . "&type=error");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Exercice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Modifier l'Exercice</h1>

        <?php if ($message): // Afficher les messages d'erreur (si l'ID est manquant ou autre) ?>
            <div class="message <?php echo $message_type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <?php if ($exercice): // Afficher le formulaire seulement si l'exercice a été trouvé ?>
            <form action="modifier.php" method="POST">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($exercice['id']); ?>">

                <div class="form-group">
                    <label for="titre">Titre :</label>
                    <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($exercice['titre']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="auteur">Auteur :</label>
                    <input type="text" id="auteur" name="auteur" value="<?php echo htmlspecialchars($exercice['auteur']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                <a href="index.php" class="btn btn-secondary">Annuler</a>
            </form>
        <?php else: ?>
            <p>Impossible de charger l'exercice pour modification.</p>
            <a href="index.php" class="btn btn-secondary">Retour à la liste</a>
        <?php endif; ?>
    </div>
</body>
</html>