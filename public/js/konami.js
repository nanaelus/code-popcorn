// Code JavaScript pour le Konami Code
document.addEventListener("DOMContentLoaded", function () {
    // Séquence du Konami Code
    const konamiCode = [
        "ArrowUp", "ArrowUp", "ArrowDown", "ArrowDown",
        "ArrowLeft", "ArrowRight", "ArrowLeft", "ArrowRight",
        "b", "a"
    ];

    let userInput = []; // Tableau pour stocker l'entrée utilisateur
    const konamiSound = new Audio(base_url + "/assets/sound/20241205_154249.m4a"); // Remplacez 'votre-son.mp3' par le chemin de votre
    // fichier audio

    // Écouteur pour capturer les touches
    document.addEventListener("keydown", function (event) {
        userInput.push(event.key);

        // Vérifie si les entrées utilisateur correspondent au Konami Code
        if (userInput.slice(-konamiCode.length).join("") === konamiCode.join("")) {
            konamiSound.play(); // Joue le son
            userInput = []; // Réinitialise les entrées utilisateur
            alert("Konami Code activé !"); // Message optionnel
        }

        // Limite la taille de l'historique pour éviter une mémoire excessive
        if (userInput.length > konamiCode.length) {
            userInput.shift();
        }
    });
});