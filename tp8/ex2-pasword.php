<?php


function generateStrongPassword(int $length): ?string
{
    
    // Vérifier que la longueur est dans une plage sécurisée et raisonnable.
    if ($length < 8 || $length > 128) {
        return null; // Indique une longueur invalide ou non sécurisée.
    }

    // --- Chaînes de caractères ---
    $lowercase_letters = 'abcdefghijklmnopqrstuvwxyz';
    $uppercase_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $digits = '0123456789';
    // Utiliser une liste complète de caractères spéciaux courants.
    // Attention à l'échappement si certains caractères ont une signification spéciale dans la chaîne PHP.
    $special_characters = '!@#$%^&*()_+-=[]{}|;:",.<>/?`~';

    // Combiner tous les ensembles de caractères possibles pour le remplissage aléatoire.
    $all_characters = $lowercase_letters . $uppercase_letters . $digits . $special_characters;

    // Initialiser un tableau pour construire le mot de passe caractère par caractère.
    $password_chars = [];

    
    // Chaque ajout est un choix aléatoire basé sur sa catégorie.
    $password_chars[] = $lowercase_letters[random_int(0, strlen($lowercase_letters) - 1)];
    $password_chars[] = $uppercase_letters[random_int(0, strlen($uppercase_letters) - 1)];
    $password_chars[] = $digits[random_int(0, strlen($digits) - 1)];
    $password_chars[] = $special_characters[random_int(0, strlen($special_characters) - 1)];

    // Remplir le reste du mot de passe jusqu'à la longueur désirée.
    // Utilisation d'une boucle `for`.
    for ($i = 0; $i < $length - 4; $i++) { // On soustrait 4 car les 4 premiers caractères sont déjà ajoutés.
        // Choisir un caractère aléatoire parmi tous les types combinés.
        $password_chars[] = $all_characters[random_int(0, strlen($all_characters) - 1)];
    }

    
    // `shuffle` est une fonction qui manipule le tableau en interne via des boucles.
    shuffle($password_chars);

    // --- Chaînes de caractères (finalisation) ---
    // Joindre tous les caractères du tableau pour former la chaîne de caractères finale du mot de passe.
    return implode('', $password_chars);
}


if (php_sapi_name() == 'cli') { // Vérifie si le script est exécuté en ligne de commande.
    echo "Générateur de Mot de Passe (CLI)\n";
    echo "---------------------------------\n";

    $requested_length = null;
    // Tenter de récupérer la longueur des arguments de la ligne de commande
    if (isset($argv[1]) && is_numeric($argv[1])) {
        $requested_length = (int)$argv[1];
    } else {
        // Sinon, demander à l'utilisateur
        echo "Entrez la longueur désirée du mot de passe (entre 8 et 128) : ";
        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);
        $requested_length = (int)trim($line);
        fclose($handle);
    }

    $password = generateStrongPassword($requested_length);

    if ($password) {
        echo "Mot de passe généré : " . $password . "\n";
    } else {
        echo "Erreur : La longueur du mot de passe doit être entre 8 et 128 caractères.\n";
    }
}



?>