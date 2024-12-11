$(document).ready(function() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    // Initialisation du composant Select2 sur l'élément avec l'ID 'search-city-head'
    $('#search-city-head').select2({
        theme: 'bootstrap-5', // Applique le thème Bootstrap 5 à Select2 pour un style visuel compatible avec Bootstrap
        placeholder: 'Rechercher une ville', // Texte par défaut dans le champ avant toute sélection ou recherche
        ajax: { // Configuration pour la recherche asynchrone via Ajax
            url: base_url + "admin/theater/autocompletecity", // URL vers le contrôleur qui gère la recherche de ville (base_url est une variable contenant l'URL de base du site)
            dataType: 'json', // Les résultats de la requête sont attendus au format JSON
            delay: 500, // Ajoute un délai de 500 ms avant d'envoyer la requête pour limiter les requêtes fréquentes
            data: function (params) {
                // Retourne les données envoyées à chaque requête, ici 'q' est le terme de recherche saisi par l'utilisateur
                return {
                    q: params.term // Le terme de recherche saisi par l'utilisateur (via le champ Select2)
                };
            },
            processResults: function (data, params) {
                // Gère les résultats de la requête et les formate pour Select2
                searchTerm = params.term; // Stocke le terme de recherche pour une utilisation future
                return {
                    results: [
                        {id: 'search_all', text: 'Rechercher tous les objets contenant "' + searchTerm + '"'},
                        {id: 'search_user', text: 'Voir la collection de l\'utilisateur "' + searchTerm + '"'},
                        ...data // Ajoute les résultats de la recherche dans Select2 (les suggestions)
                    ]
                };
            },
            cache: true // Active la mise en cache des requêtes pour optimiser les performances et éviter des appels redondants
        },
        minimumInputLength: 2, // Définit un seuil minimal de caractères à saisir avant de déclencher une recherche
    });

    $('#search-movie-head').select2({
        theme: 'bootstrap-5', // Applique le thème Bootstrap 5 à Select2 pour un style visuel compatible avec Bootstrap
        placeholder: 'Rechercher un film', // Texte par défaut dans le champ avant toute sélection ou recherche
        ajax: { // Configuration pour la recherche asynchrone via Ajax
            url: base_url + "movie/autocompletecity", // URL vers le contrôleur qui gère la recherche de ville (base_url est une variable contenant l'URL de base du site)
            dataType: 'json', // Les résultats de la requête sont attendus au format JSON
            delay: 500, // Ajoute un délai de 500 ms avant d'envoyer la requête pour limiter les requêtes fréquentes
            data: function (params) {
                // Retourne les données envoyées à chaque requête, ici 'q' est le terme de recherche saisi par l'utilisateur
                return {
                    q: params.term // Le terme de recherche saisi par l'utilisateur (via le champ Select2)
                };
            },
            processResults: function (data, params) {
                // Gère les résultats de la requête et les formate pour Select2
                searchTerm = params.term; // Stocke le terme de recherche pour une utilisation future
                return {
                    results: [
                        {id: 'search_all', text: 'Rechercher tous les objets contenant "' + searchTerm + '"'},
                        {id: 'search_user', text: 'Voir la collection de l\'utilisateur "' + searchTerm + '"'},
                        ...data // Ajoute les résultats de la recherche dans Select2 (les suggestions)
                    ]
                };
            },
            cache: true // Active la mise en cache des requêtes pour optimiser les performances et éviter des appels redondants
        },
        minimumInputLength: 2, // Définit un seuil minimal de caractères à saisir avant de déclencher une recherche
    });
    $('#search-movie-head').on('select2:select', function (e) {
        var data = e.params.data; // Récupère les données de l'élément sélectionné

        if (data.id === 'search_all') {
            // Si l'utilisateur a sélectionné l'option "Rechercher tous les objets contenant", redirige vers la page des résultats avec la recherche globale
            window.location.href = base_url + 'movie?search=' + encodeURIComponent(searchTerm);
        } else {
            // Sinon, redirige vers la page spécifique de l'item sélectionné
            window.location.href = base_url + 'movie/' + data.id;
        }
    });
});