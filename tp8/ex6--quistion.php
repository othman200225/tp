<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Quiz (Sans CSS)</title>
</head>
<body>

    <h1>Mini Quiz de Culture Générale</h1>

    <?php
    // Définir les questions du quiz, leurs options et la bonne réponse
    // Utilisation d'un tableau associatif pour stocker toutes les données du quiz
    $questions = [
        [
            'question' => "Quelle est la capitale de la France ?",
            'options' => ['Berlin', 'Madrid', 'Paris', 'Rome'],
            'correct_answer_index' => 2 // Paris
        ],
        [
            'question' => "Quel est le plus grand océan du monde ?",
            'options' => ['Atlantique', 'Indien', 'Arctique', 'Pacifique'],
            'correct_answer_index' => 3 // Pacifique
        ],
        [
            'question' => "Qui a écrit 'Don Quichotte' ?",
            'options' => ['William Shakespeare', 'Miguel de Cervantes', 'Victor Hugo', 'Léon Tolstoï'],
            'correct_answer_index' => 1 // Miguel de Cervantes
        ],
        [
            'question' => "Quelle est la planète la plus proche du Soleil ?",
            'options' => ['Vénus', 'Mars', 'Mercure', 'Terre'],
            'correct_answer_index' => 2 // Mercure
        ],
        [
            'question' => "En quelle année le premier homme a marché sur la lune ?",
            'options' => ['1965', '1969', '1971', '1975'],
            'correct_answer_index' => 1 // 1969
        ]
    ];

    $score = 0;
    $quiz_submitted = false; // Indique si le quiz a été soumis

    // --- Traitement des réponses si le formulaire a été soumis ---
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $quiz_submitted = true;
        echo "<h2>Vos Résultats :</h2>";

        // Parcourir chaque question pour vérifier la réponse
        foreach ($questions as $q_index => $q_data) {
            $question_text = htmlspecialchars($q_data['question']);
            $correct_option_text = htmlspecialchars($q_data['options'][$q_data['correct_answer_index']]);
            $user_answer_index = isset($_POST['q' . $q_index]) ? (int)$_POST['q' . $q_index] : null; // Récupérer l'index de la réponse de l'utilisateur

            $is_correct = false;
            $user_choice_text = "Pas de réponse"; // Texte par défaut si aucune réponse n'est sélectionnée

            // Vérifier si l'utilisateur a répondu à la question
            if ($user_answer_index !== null && isset($q_data['options'][$user_answer_index])) {
                $user_choice_text = htmlspecialchars($q_data['options'][$user_answer_index]);

                // --- Logique d'évaluation (Condition) ---
                if ($user_answer_index === $q_data['correct_answer_index']) {
                    $score++;
                    $is_correct = true;
                }
            }

            // Afficher le résultat pour chaque question
            $status_color = $is_correct ? 'green' : 'red';
            $status_text = $is_correct ? 'Correct' : 'Faux';

            echo "<p>";
            echo "<strong>Question " . ($q_index + 1) . ":</strong> " . $question_text . "<br>";
            echo "Votre réponse : <em>" . $user_choice_text . "</em> - <strong style='color: " . $status_color . ";'>" . $status_text . "</strong><br>";
            if (!$is_correct) {
                echo "<span style='font-style: italic; color: blue;'>La bonne réponse était : " . $correct_option_text . "</span><br>";
            }
            echo "</p>";
            echo "<hr>"; // Ligne de séparation
        }

        // Afficher le score final
        $total_questions = count($questions);
        $passing_score = ceil($total_questions * 0.6); // Par exemple, 60% pour réussir
        $score_color = ($score >= $passing_score) ? 'green' : 'red';

        echo "<h2>Score Final : <span style='color: " . $score_color . ";'>" . $score . " / " . $total_questions . "</span></h2>";
        if ($score >= $passing_score) {
            echo "<p style='color: green;'>Félicitations, vous avez réussi !</p>";
        } else {
            echo "<p style='color: red;'>Désolé, vous n'avez pas atteint le score de passage (" . $passing_score . "/" . $total_questions . ").</p>";
        }
        echo "<p><a href='quiz_nocss.php'>Refaire le quiz</a></p>";
    }

    // --- Affichage du formulaire du quiz si non soumis ---
    if (!$quiz_submitted) {
        echo '<form action="" method="POST">';
        // Utilisation d'une boucle foreach pour afficher chaque question et ses options
        foreach ($questions as $q_index => $q_data) {
            echo "<h3>Question " . ($q_index + 1) . ": " . htmlspecialchars($q_data['question']) . "</h3>";
            echo "<div>";
            // Boucle pour afficher les options de réponse pour la question actuelle
            foreach ($q_data['options'] as $opt_index => $option_text) {
                echo "<label>";
                echo "<input type='radio' name='q" . $q_index . "' value='" . $opt_index . "' required>";
                echo htmlspecialchars($option_text);
                echo "</label><br>";
            }
            echo "</div>";
            echo "<br>"; // Saut de ligne pour séparer les questions
        }
        echo '<button type="submit">Soumettre le Quiz</button>';
        echo '</form>';
    }
    ?>

</body>
</html>