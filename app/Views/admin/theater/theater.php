<div class="row">
    <div class="col">
        <form method="POST" action="<?= isset($cinema) ? base_url('admin/theater/update') : base_url('admin/theater/create'); ?>" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <h3><?= isset($cinema) ? "Modification du Cinéma : " . $cinema['name'] : "Création d'un Cinéma"; ?></h3>
                </div>
                <div class="card-body">
                    <input type="hidden" name="id" value="<?= isset($cinema) ? $cinema['id']: '' ; ?>"
                    <label class="form-label" for="name">Nom du Cinéma :</label>
                    <input type="text" value="<?= isset($cinema) ? $cinema['name'] : "" ; ?>" name="name" class="form-control mt-2" placeholder="Entrez un nom">
                    <label class="form-label mb-2 mt-2" for="address">Adresse :</label>
                    <textarea type="text" placeholder="Entrez une adresse" name="address" class="form-control"><?= isset($cinema) ? $cinema['address'] : ""; ?></textarea>
                    <label class="form-label mb-2 mt-2" for="phone">Téléphone :</label>
                    <input type="text" value="<?= isset($cinema) ? $cinema['phone'] : ""; ?>" name="phone" class="form-control" placeholder="Entrez un numéro de téléphone">
                    <label class="form-label mb-2 mt-2" for="email">Email :</label>
                    <input type="email" value="<?= isset($cinema) ? $cinema['email'] : ""; ?>" name="email" class="form-control" placeholder="exemple@mail.com">
                    <label class="form-label mb-2 mt-2" for="city_id">Ville <?= isset($cinema) ? " actuelle : " . $cinema['city_name'] . "."  : "" ;?></label>
                    <select id="search-city-head" class="form-control me-2" name="city_id"></select>
                    <div class="mb-3 mt-3 d-flex align-items-center">
                        <label for="image" class="form-label me-2">Photos</label>
                        <div id="preview">
                            <?php
                            $theaterImageUrl = isset($cinema['preview_url']) ? base_url($cinema['preview_url']) : "#";
                            ?>
                            <img class="img-thumbnail me-2"alt="Aperçu de l'image"
                                 style="display: <?= isset($cinema['preview_url']) ? "block" : "none" ?>; max-width: 100px;"
                                 src="<?= $theaterImageUrl ?>">
                        </div>
                        <input class="form-control" type="file" name="theater_image" id="image">
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary"><?= isset($cinema) ? "Modifier" : "Créer"; ?></button>
                </div>
            </div>
        </form>
    </div>
</div>