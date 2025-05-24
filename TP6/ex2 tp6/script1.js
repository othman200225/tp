document.addEventListener('DOMContentLoaded', () => {
    const taskForm = document.getElementById('task-form');
    const newTaskInput = document.getElementById('new-task-input');
    const taskList = document.getElementById('task-list');

    // Fonction pour créer un nouvel élément de tâche
    function createTaskElement(taskText) {
        const listItem = document.createElement('li');
        const taskSpan = document.createElement('span');
        taskSpan.textContent = taskText;

        const completeButton = document.createElement('button');
        completeButton.textContent = 'Accomplir';
        completeButton.classList.add('complete-btn');

        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Supprimer';
        deleteButton.classList.add('delete-btn');

        // Ajout des gestionnaires d'événements aux boutons
        completeButton.addEventListener('click', () => {
            listItem.classList.toggle('completed'); // Bascule la classe 'completed'
        });

        deleteButton.addEventListener('click', () => {
            taskList.removeChild(listItem); // Supprime l'élément de la liste
        });

        listItem.appendChild(taskSpan);
        listItem.appendChild(completeButton);
        listItem.appendChild(deleteButton);

        return listItem;
    }

    // Gérer la soumission du formulaire
    taskForm.addEventListener('submit', (event) => {
        event.preventDefault(); // Empêche le rechargement de la page

        const taskText = newTaskInput.value.trim(); // Récupère la valeur de l'input et supprime les espaces
        
        if (taskText !== '') {
            const newTask = createTaskElement(taskText);
            taskList.appendChild(newTask);
            newTaskInput.value = ''; // Réinitialise le champ de texte
        } else {
            alert('Veuillez entrer une tâche !');
        }
    });
});