// 1. Créez une nouvelle div dans le document HTML.
const newDiv = document.createElement('div');
newDiv.id = 'maDiv'; // Optionnel: pour faciliter la sélection si besoin

// 2. À l'intérieur de cette div, créez un paragraphe p.
const newParagraph = document.createElement('p');

// 3. Ajoutez du texte initial à ce paragraphe
newParagraph.textContent = 'Ceci est un paragraphe';

// Ajoutez le paragraphe à la div
newDiv.appendChild(newParagraph);

// Ajoutez la div au corps du document
document.body.appendChild(newDiv);

// 4. Modification le texte:
// Après avoir créé le paragraphe, modifiez son texte pour dire : « Le texte a été modifié ».
newParagraph.textContent = 'Le texte a été modifié';

// 5. Modification du style CSS :
// Changez le style du paragraphe pour qu'il ait une couleur de fond « lightblue » et que le texte soit centré.
newParagraph.style.backgroundColor = 'lightblue';
newParagraph.style.textAlign = 'center';
newParagraph.style.padding = '10px'; // Un peu de padding pour une meilleure visibilité

// 6. Ajout d'un événement:
// Ajoutez un événement « click » à la div. Lorsqu'un utilisateur clique sur la div,
// le texte du paragraphe doit changer pour « Un clic a été détecté ».
newDiv.addEventListener('click', () => {
    newParagraph.textContent = 'Un clic a été détecté';
    newParagraph.style.backgroundColor = 'lightcoral'; // Optionnel: pour montrer le changement
});s