<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réponse du Formulaire TP</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="ico.png">
</head>
<body>
    <h1>Traitement du Formulaire (reponse.php)</h1>

    <?php
    // Première étape du TP : Afficher les informations reçues par le script PHP
    // Affichage brut du tableau $_POST
    echo "<h2>Contenu brut de \$_POST (Avant tout traitement) :</h2>";
    echo "<pre>"; // Utilise <pre> pour préserver le formatage de print_r
    print_r($_POST);
    echo "</pre>";
    echo "<hr>"; // Ligne de séparation

    // Deuxième étape du TP : Créer une réponse plus élaborée (Méthode 1 : HTML dans PHP)
    echo "<h2>Réponse élaborée (Méthode 1 : HTML dans PHP)</h2>";

    // Récupération des variables et "sécurisation" avec strip_tags()
    // Utilisation de isset() pour vérifier si la variable est définie
    $nom = isset($_POST['nom']) ? strip_tags(trim($_POST['nom'])) : 'Non renseigné';
    $prenom = isset($_POST['prenom']) ? strip_tags(trim($_POST['prenom'])) : 'Non renseigné';
    $mdp = isset($_POST['mdp']) ? strip_tags(trim($_POST['mdp'])) : 'Non renseigné'; // Note: En production, les mots de passe ne sont JAMAIS affichés en clair.

    echo "<p>Bonjour " . $prenom . " " . $nom . " !</p>";
    echo "<p>Votre mot de passe est : <b>" . $mdp . "</b></p>";
    echo "<br/> Encore du html... <br/>"; // Exemple de br et texte simple

    echo "<hr>"; // Ligne de séparation

    // Simulation de la "seconde page" (reponse2.php) en utilisant la Méthode 2
    // C'est le code que vous mettriez dans reponse2.php si vous créiez ce fichier séparément.
    echo "<h2>Réponse élaborée (Méthode 2 : PHP dans HTML - Simulation de reponse2.php)</h2>";
    ?>
    <h1>Bonjour, <?php echo htmlspecialchars($prenom); ?> <?php echo htmlspecialchars($nom); ?></h1>
    <h2>Votre mot de passe est: <?php echo htmlspecialchars($mdp); ?> </h2>
    <p>Cette partie est un exemple de la méthode où le PHP est inséré directement dans le HTML.</p>

    <hr>
    <p><a href="index.html">Retour au formulaire</a></p>

</body>
</html>