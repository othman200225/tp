<?php
    // Vérifie si le formulaire a été soumis via la méthode POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire
        $civilite = isset($_POST['civilite']) ? htmlspecialchars($_POST['civilite']) : 'Non spécifié';
        $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : 'Non spécifié';
        $prenom = isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : 'Non spécifié';
        $annee_naissance = isset($_POST['annee_naissance']) ? htmlspecialchars($_POST['annee_naissance']) : 'Non spécifiée';
        $identifiant = isset($_POST['identifiant']) ? htmlspecialchars($_POST['identifiant']) : 'Non spécifié';
        $mot_de_passe = isset($_POST['mot_de_passe']) ? htmlspecialchars($_POST['mot_de_passe']) : 'Non spécifié';
        $sexe = isset($_POST['sexe']) ? htmlspecialchars($_POST['sexe']) : 'Non spécifié';
        $debut_php = isset($_POST['debut_php']) ? 'Oui' : 'Non'; // Checkbox

        // Affichage des données
        echo "<p><strong>Civilité :</strong> " . $civilite . "</p>";
        echo "<p><strong>Nom :</strong> " . $nom . "</p>";
        echo "<p><strong>Prénom :</strong> " . $prenom . "</p>";
        echo "<p><strong>Année de naissance :</strong> " . $annee_naissance . "</p>";
        echo "<p><strong>Identifiant :</strong> " . $identifiant . "</p>";
        echo "<p><strong>Mot de passe :</strong> " . $mot_de_passe . " (Pour info : ne jamais afficher un mot de passe en clair en production !)</p>";
        echo "<p><strong>Sexe :</strong> " . $sexe . "</p>";
        echo "<p><strong>Débute en PHP :</strong> " . $debut_php . "</p>";

    } else {
        echo "<p>Aucune donnée de formulaire soumise.</p>";
    }
    ?>