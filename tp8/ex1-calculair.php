<?php

echo "--- Calculatrice en PHP ---\n";
echo "Entrez le premier nombre : ";
$nombre1 = (float)trim(fgets(STDIN));

echo "Choisissez l'opération (+, -, *, /) : ";
$operation = trim(fgets(STDIN));

echo "Entrez le deuxième nombre : ";
$nombre2 = (float)trim(fgets(STDIN));

$resultat = null;
$erreur = null;

switch ($operation) {
    case '+':
        $resultat = $nombre1 + $nombre2;
        break;
    case '-':
        $resultat = $nombre1 - $nombre2;
        break;
    case '*':
        $resultat = $nombre1 * $nombre2;
        break;
    case '/':
        if ($nombre2 != 0) {
            $resultat = $nombre1 / $nombre2;
        } else {
            $erreur = "Erreur : Division par zéro impossible.";
        }
        break;
    default:
        $erreur = "Opération non valide. Veuillez utiliser +, -, * ou /.";
        break;
}

if ($erreur) {
    echo "Erreur : " . $erreur . "\n";
} else {
    echo "Résultat : " . $resultat . "\n";
}

?>