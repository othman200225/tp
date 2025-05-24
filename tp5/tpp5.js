// Exercice 1: Opérations sur deux nombres

function effectuerOperations() {
  const nombre1 = parseFloat(prompt("Entrez le premier nombre :"));
  const nombre2 = parseFloat(prompt("Entrez le deuxième nombre :"));

  if (!isNaN(nombre1) && !isNaN(nombre2)) {
    const somme = nombre1 + nombre2;
    const difference = nombre1 - nombre2;
    const produit = nombre1 * nombre2;
    const quotient = nombre2 === 0 ? "Division par zéro impossible" : nombre1 / nombre2;

    console.log("Somme : " + somme);
    console.log("Différence : " + difference);
    console.log("Produit : " + produit);
    console.log("Quotient : " + quotient);
  } else {
    console.log("Veuillez entrer des nombres valides.");
  }
}

// effectuerOperations(); // Décommenter pour exécuter l'exercice 1


// Exercice 2: Jeu de devinette

function jeuDevinette() {
  const nombreAleatoire = Math.floor(Math.random() * 10) + 1;
  let tentative;
  let nombreTentatives = 0;

  do {
    tentative = parseInt(prompt("Devinez un nombre entre 1 et 10 :"));
    nombreTentatives++;

    if (isNaN(tentative) || tentative < 1 || tentative > 10) {
      console.log("Veuillez entrer un nombre entre 1 et 10.");
    } else if (tentative < nombreAleatoire) {
      console.log("C'est plus grand.");
    } else if (tentative > nombreAleatoire) {
      console.log("C'est plus petit.");
    }
  } while (tentative !== nombreAleatoire);

  console.log("« Score » : Vous avez trouvé le nombre " + nombreAleatoire + " en " + nombreTentatives + " tentatives.");
}

// jeuDevinette(); // Décommenter pour exécuter l'exercice 2


// Exercice 3: Création d'un quiz interactif en JavaScript

function lancerQuiz() {
  const QUESTIONS = [
    ["Quelle est la capitale de la France ?", "Paris"],
    ["Combien font 2 + 2 ?", "4"],
    ["Quel est le symbole chimique de l'eau ?", "H2O"],
    ["Quel est le plus grand océan du monde ?", "Océan Pacifique"]
  ];

  let score = 0;

  for (let i = 0; i < QUESTIONS.length; i++) {
    const question = QUESTIONS[i][0];
    const reponseCorrecte = QUESTIONS[i][1];
    const reponseUtilisateur = prompt(question);

    if (reponseUtilisateur !== null) {
      if (reponseUtilisateur.toLowerCase() === reponseCorrecte.toLowerCase()) {
        console.log("Réponse juste !");
        score++;
      } else {
        console.log("Réponse fausse. La réponse correcte était : " + reponseCorrecte);
      }
    } else {
      console.log("Question ignorée.");
    }
  }

  console.log("--- Fin du quiz ---");
  console.log("Votre score final est de : " + score + " sur " + QUESTIONS.length);
}

lancerQuiz(); // Décommenter pour exécuter l'exercice 3

  let score = 0;

  for (let i = 0; i < QUESTIONS.length; i++) {
    const question = QUESTIONS[i][0];
    const reponseCorrecte = QUESTIONS[i][1];
    const reponseUtilisateur = prompt(question);

    if (reponseUtilisateur !== null) {
      if (reponseUtilisateur.toLowerCase() === reponseCorrecte.toLowerCase()) {
        console.log("Réponse juste !");
        score++;
      } else {
        console.log("Réponse fausse. La réponse correcte était : " + reponseCorrecte);
      }
    } else {
      console.log("Question ignorée.");
    }
  }

  console.log("--- Fin du quiz ---");
  console.log("Votre score final est de : " + score + " sur " + QUESTIONS.length);
}

lancerQuiz(); // Décommenter pour exécuter l'exercice 3
 /*<!DOCTYPE html>
<html>
<head>
  <title>Quiz Interactif</title>
  <style>
    body {
      font-family: sans-serif;
    }
    .quiz-container {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    h1 {
      text-align: center;
    }
    .question {
      margin-bottom: 15px;
      font-weight: bold;
    }
    input[type="text"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ddd;
      border-radius: 3px;
      box-sizing: border-box;
    }
    button {
      padding: 10px 20px;
      margin-top: 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }
    button:hover {
      background-color: #0056b3;
    }
    #resultat {
      margin-top: 20px;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="quiz-container">
    <h1>Quiz Interactif</h1>
    <button onclick="lancerQuiz()">Démarrer le Quiz</button>
    <div id="quiz-questions" style="display: none;">
      </div>
    <div id="resultat" style="display: none;"></div>
  </div>

  <script>
    const QUESTIONS = [
      ["Quelle est la capitale de la France ?", "Paris"],
      ["Combien font 2 + 2 ?", "4"],
      ["Quel est le symbole chimique de l'eau ?", "H2O"],
      ["Quel est le plus grand océan du monde ?", "Océan Pacifique"]
    ];

    let questionIndex = 0;
    let score = 0;
    const quizQuestionsDiv = document.getElementById("quiz-questions");
    const resultatDiv = document.getElementById("resultat");

    function lancerQuiz() {
      document.querySelector("button").style.display = "none";
      quizQuestionsDiv.style.display = "block";
      afficherQuestion();
    }

    function afficherQuestion() {
      quizQuestionsDiv.innerHTML = ""; // Effacer la question précédente

      if (questionIndex < QUESTIONS.length) {
        const questionData = QUESTIONS[questionIndex];
        const questionText = questionData[0];

        const questionDiv = document.createElement("div");
        questionDiv.classList.add("question");
        questionDiv.textContent = questionText;

        const inputReponse = document.createElement("input");
        inputReponse.type = "text";
        inputReponse.id = "reponse-utilisateur";

        const boutonValider = document.createElement("button");
        boutonValider.textContent = "Valider";
        boutonValider.onclick = verifierReponse;

        quizQuestionsDiv.appendChild(questionDiv);
        quizQuestionsDiv.appendChild(inputReponse);
        quizQuestionsDiv.appendChild(boutonValider);
      } else {
        afficherResultats();
      }
    }

    function verifierReponse() {
      const reponseUtilisateur = document.getElementById("reponse-utilisateur").value;
      const reponseCorrecte = QUESTIONS[questionIndex][1];

      if (reponseUtilisateur.toLowerCase() === reponseCorrecte.toLowerCase()) {
        alert("Réponse juste !");
        score++;
      } else {
        alert("Réponse fausse. La réponse correcte était : " + reponseCorrecte);
      }

      questionIndex++;
      afficherQuestion();
    }

    function afficherResultats() {
      quizQuestionsDiv.style.display = "none";
      resultatDiv.style.display = "block";
      resultatDiv.textContent = `Vous avez répondu correctement à ${score} questions sur ${QUESTIONS.length}.`;
    }
  </script>

</body>
</html>