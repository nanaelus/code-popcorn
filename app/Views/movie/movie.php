<form method="POST" action="<?= isset($movie)? base_url('admin/movie/update') : base_url('admin/movie/create') ; ?>" enctype="multipart/form-data">
    <div class="card">
        <div class="card-header">
            <?= isset($movie) ? "Modification" : "Ajout" ?> d'un Film
        </div>
        <div class="card-body">
            <input type="hidden" name="id" class="form-control" value="<?= isset($movie) ? $movie['id'] : ""; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Nom du Film :</label>
                <input type="text" name="title" class="form-control" value="<?= isset($movie) ? $movie['title'] : ""; ?>" placeholder="Nom du Film">
            </div>
            <div class="mb-3">
                <label for="release" class="form-label">Date de Sortie :</label>
                <input type="date" name="release" class="form-control" value="<?= isset($movie) ? $movie['release'] : ""; ?>">
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Durée en minutes :</label>
                <input type="number" name="duration" class="form-control" value="<?= isset($movie) ? $movie['duration'] : ""; ?>" placeholder="Durée en minutes">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description :</label>
                <textarea type="text" name="description" class="form-control" placeholder="Description"><?= isset($movie) ? $movie['description'] : ""; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Classification :</label>
                <select name="rating" class="form-select">
                    <?php if(!isset($movie)) { ?>
                        <option selected disabled>--Classification--</option>
                    <?php } ?>
                    <option value="Tous Publics" <?= (isset($movie) && $movie['rating'] == "Tous Publics") ? "selected" : ""; ?>>Tous Publics</option>
                    <option value="-12 ans" <?= (isset($movie) && $movie['rating'] == "-12 ans") ? "selected" : ""; ?>>-12 ans</option>
                    <option value="-16 ans" <?= (isset($movie) && $movie['rating'] == "-16 ans") ? "selected" : ""; ?>>-16 ans</option>
                    <option value="-18 ans" <?= (isset($movie) && $movie['rating'] == "-18 ans") ? "selected" : ""; ?>>-18 ans</option>
                </select>
            </div>
            <div class="mb-3 d-flex align-items-center">
                <label for="image" class="form-label me-2">Affiche</label>
                <div id="preview">
                    <?php
                    $movieImageUrl = isset($movie['preview_url']) ? base_url($movie['preview_url']) : "#";
                    ?>
                    <img class="img-thumbnail me-2"alt="Aperçu de l'image"
                         style="display: <?= isset($utilisateur['avatar_url']) ? "block" : "none" ?>; max-width: 100px;"
                         src="<?= $movieImageUrl ?>">
                </div>

                <input class="form-control" type="file" name="movie_image" id="image">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><?= isset($movie) ? "Modifer" : "Ajouter"; ?></button>
        </div>
    </div>
</form>