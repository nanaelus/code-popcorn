<?php
$router = service('router');
$controller = strtolower(basename(str_replace('\\', '/', $router->controllerName())));
if($controller == '' || 'home'){
    $controller = 'movie';
}
?>
<div class="row">
    <div class="col-md-3">

        <!--Filtres -->
        <div class="card h-auto">
            <div class="card-header front">Filtre de recherche</div>
                <div class="card-body">
                    <form method="get" action="<?= base_url($controller); ?>/a-l-affiche">

                        <!--Filtre pour la classification -->
                        <div class="mb-3">
                            <label class="form-label" for="rating">Classification</label>
                            <select class="form-select" name="rating" id="rating">
                                <option selected disabled value="">Aucun</option>
                                <option value="Tous Publics">Tous Publics</option>
                                <option value="-12 ans">-12 ans</option>
                                <option value="-16 ans">-16 ans</option>
                                <option value="-18 ans">-18 ans</option>
                            </select>
                        </div>

                        <!--Filtre pour les versions -->
                        <div class="mb-3">
                            <label class="form-label" for="version">Version</label>
                            <select class="form-select" name="version" id="version">
                                <option selected disabled value="">Aucun</option>
                                <option value="VF">VF</option>
                                <option value="VOSTFR">VOSTFR</option>
                                <option value="VFSTFR">VFSTFR</option>
                                <option value="Audiodescription">Audiodescription</option>
                            </select>
                        </div>

                        <!-- Filtre pour les catégories -->
                        <label class="form-label" for="category">Catégories</label>
                        <select class="form-select mb-3" name="category" id="category">
                            <option selected disabled value="">Aucun</option>
                            <!-- Boucle à travers toutes les marques pour les afficher en options -->
                            <?php foreach($categories as $category): ?>
                                <option value="<?= $category['slug']; ?>" <?= (isset($data['category']) && $data['category']['slug'] == $category['slug']) ? "selected" : ""; ?>><?= $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($data['page'])) { ?>
                            <input type="hidden" value="<?= $data['page']; ?>" name="page">
                        <?php }?>
                        <?php if (isset($data['search'])) { ?>
                            <input type="hidden" value="<?= $data['search']; ?>" name="search">
                        <?php }?>
                        <div class="d-grid mt-3">
                            <button class="btn btn-primary" type="submit">Valider mes filtres</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <!--Tous les films ayant une séance d'attribuée ou une release à venir -->
    <div class="col-md-9">
        <div class="card h-100">
                <div class="card-header front">
                    Films en salle actuellement et prochainement
                </div>
                <div class="card-body">
                    <?php foreach (array_chunk($movies, 4) as $chunk) { ?>
                        <div class="row shelf-row px-4">
                            <?php foreach ($chunk as $movie) { ?>
                                <div class="col-md-3 col-6">
                                    <div class="card h-100">
                                        <span>
                                        <?php
                                        $img_src = !empty($movie['preview_url']) ? $movie['preview_url'] : base_url('assets/img/preview/flim.jpg');
                                        ?>
                                        <a href="<?= base_url('movie/' . $movie['slug']) ?>">
                                            <img src="<?= $img_src ?>" class="card-img-top" alt="<?= $movie['title'] ?>">
                                        </a>
                                        </span>
                                        <span class=" d-flex align-content-between"><?= $movie['title']; ?></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="card-footer front text-center">
                    <div class="row">
                        <div class="col">
                            <div class="pagination justify-content-center">
                                <?= $pager->links('default', 'bootstrap_pagination'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<a class="link-underline-opacity-0 position-fixed bottom-0 end-0 m-4" data-bs-toggle="offcanvas" href="<?=base_url('#offcanvasItem')?>" role="button" aria-controls="offcanvasExample" id="nowel" title="Un problème? Contactez nous!">
    <i class="fa-solid fa-paper-plane fa-2xl"></i>
</a>

<!-- Style Etagère, à revoir -->
<style>
    .shelf-row {
        position: relative; /* Positionnement nécessaire pour le pseudo-élément */
        margin-bottom: 50px; /* Assurez-vous d'avoir un espace en bas pour l'étagère */
    }

    .shelf-row::after {
        content: '';
        display: block; /* Rendre le pseudo-élément un bloc pour pouvoir ajuster la largeur */
        background-image: url("https://www4-static.gog-statics.com/bundles/gogwebsiteaccount/img/shelf/wood.png"); /* Lien vers l'image de l'étagère */
        background-size: cover; /* S'assurer que l'image couvre toute la largeur */
        background-repeat: no-repeat; /* Éviter que l'image se répète */
        position: absolute; /* Positionnement absolu par rapport au conteneur */
        bottom: -57px; /* Positionner l'étagère en bas du conteneur */
        left: 0; /* Aligné à gauche */
        width: 100%; /* Largeur de l'étagère à 100% */
        height: 85px; /* Ajuster la hauteur de l'étagère selon vos besoins */
        z-index: 0; /* Mettre l'étagère derrière les cartes */
    }
    /* Ajustement des étagères pour les petits écrans */
    @media(max-width: 768px) {
        .shelf-row::after {
            content: none;
        }
        .shelf-row {
            margin-bottom: 0;
        }
        .shelf-row .col-6 {
            margin-bottom: 1em;
        }
    }
    .shelf-row .col-md-3 {
        z-index: 1;
    }
    .shelf-row .card {
        box-shadow: 0 1px 5px rgba(0,0,0,.15);
        overflow: hidden;
    }

    .shelf-row .card-footer {
        position: absolute; /* Nécessaire pour l'effet */
        bottom: -50px; /* Ajustez cette valeur pour que le footer soit hors de la carte initialement */
        left: 0;
        right: 0;
        opacity: 0; /* Caché par défaut */
        transition: opacity 0.3s ease; /* Effet de transition pour la visibilité */
    }
</style>