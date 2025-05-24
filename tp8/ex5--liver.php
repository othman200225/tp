<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'Or Simple (Sans CSS)</title>
</head>
<body>

    <h1>Livre d'Or</h1>

    <?php
    // Nom du fichier pour stocker les messages
    $guestbook_file = 'messages_nocss.txt'; // Nom différent pour ne pas mélanger avec l'autre exemple

    // Variables pour les messages d'état
    $status_message = '';
    $name = '';
    $email = '';
    $message_content = '';

    // --- Traitement du formulaire de soumission ---
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $message_content = isset($_POST['message']) ? trim($_POST['message']) : '';

        // Validation des champs
        if (empty($name) || empty($email) || empty($message_content)) {
            $status_message = "<p style='color: red;'>Veuillez remplir tous les champs.</p>";
        } else {
            // Obtenir la date et l'heure actuelles
            $date = date("Y-m-d H:i:s");

            // Formater le message pour l'enregistrement (utiliser un séparateur peu commun)
            // Nettoyer le contenu du message pour éviter les problèmes de formatage
            $clean_message = str_replace(["\r\n", "\r", "\n", "|"], [" ", " ", " ", "/"], $message_content);
            $entry_data = $name . '|' . $email . '|' . $date . '|' . $clean_message . "\n";

            // Enregistrer le message dans le fichier
            if (file_put_contents($guestbook_file, $entry_data, FILE_APPEND | LOCK_EX)) {
                $status_message = "<p style='color: green;'>Votre message a été enregistré avec succès !</p>";
                // Effacer les champs du formulaire après succès
                $name = '';
                $email = '';
                $message_content = '';
            } else {
                $status_message = "<p style='color: red;'>Erreur lors de l'enregistrement de votre message.</p>";
            }
        }
    }

    // Afficher les messages d'état (succès ou erreur)
    echo $status_message;
    ?>

    <form action="" method="POST">
        <h2>Laisser un message</h2>
        <p>
            <label for="name">Votre Nom :</label><br>
            <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($name); ?>">
        </p>
        <p>
            <label for="email">Votre Email (ne sera pas affiché publiquement) :</label><br>
            <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>">
        </p>
        <p>
            <label for="message">Votre Message :</label><br>
            <textarea id="message" name="message" rows="5" required><?php echo htmlspecialchars($message_content); ?></textarea>
        </p>
        <p>
            <button type="submit">Envoyer le message</button>
        </p>
    </form>

    <hr> <h2>Messages Précédents</h2>
    <?php
    // Vérifier si le fichier existe et est lisible
    if (file_exists($guestbook_file) && is_readable($guestbook_file)) {
        // Lire tout le contenu du fichier et le diviser par ligne
        $entries = file($guestbook_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Inverser l'ordre pour afficher les messages les plus récents en premier
        $entries = array_reverse($entries);

        if (empty($entries)) {
            echo "<p>Aucun message pour le moment. Soyez le premier !</p>";
        } else {
            foreach ($entries as $entry_line) {
                // Diviser chaque ligne par le séparateur '|'
                $parts = explode('|', $entry_line, 4); // Limite à 4 parties : nom, email, date, message

                if (count($parts) === 4) {
                    list($name_stored, $email_stored, $date_stored, $message_stored) = $parts;

                    echo "<div>";
                    echo "<h3>" . htmlspecialchars($name_stored) . "</h3>";
                    echo "<p>" . nl2br(htmlspecialchars($message_stored)) . "</p>";
                    echo "<small>Posté le " . htmlspecialchars($date_stored) . "</small>";
                    echo "<hr>"; // Ligne de séparation entre les messages
                    echo "</div>";
                }
            }
        }
    } else {
        echo "<p>Le fichier des messages n'existe pas ou n'est pas accessible en écriture.</p>";
        echo "<p>Veuillez vous assurer que le fichier '{$guestbook_file}' existe et que le serveur a les permissions d'écrire dedans.</p>";
    }
    ?>

</body>
</html>