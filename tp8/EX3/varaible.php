<?php
    // Initialiser les variables
    $nom = '';
    $email = '';
    $message_content = ''; // Renommé pour éviter le conflit avec $message_display
    $message_display = ''; // Pour afficher les messages de succès/erreur

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire, en utilisant trim() pour nettoyer les espaces
        $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $message_content = isset($_POST['message']) ? trim($_POST['message']) : '';

        // Valider que tous les champs sont remplis
        if (empty($nom) || empty($email) || empty($message_content)) {
            $message_display = "<p style='color: red;'>Veuillez remplir tous les champs du formulaire.</p>";
        } else {
            // Tous les champs sont remplis, afficher les données
            $message_display = "<p style='color: green;'>Votre message a été envoyé avec succès !</p>";

            echo "<h2>Données reçues :</h2>";
            echo "<p><strong>Nom :</strong> " . htmlspecialchars($nom) . "</p>";
            echo "<p><strong>Email :</strong> " . htmlspecialchars($email) . "</p>";
            echo "<p><strong>Message :</strong> " . nl2br(htmlspecialchars($message_content)) . "</p>"; // nl2br pour les retours à la ligne
        }
    }

    // Afficher les messages de succès ou d'erreur
    echo $message_display;
    ?>