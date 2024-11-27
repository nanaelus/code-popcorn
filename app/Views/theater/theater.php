<div class="row">
    <div class="col">
        <form method="POST" action="<?= isset($theater) ? base_url('admin/theater/update') : base_url('admin/theater/create'); ?>">
            <div class="card">
                <div class="card-header">
                    <h3><?= isset($theater) ? "Modification" : "Création"; ?> d'une fiche Cinéma</h3>
                </div>
                <div class="card-body">
                    <input type="hidden" name="id" value="<?= isset($theater) ? $theater['id']: '' ; ?>"
                    <label class="form-label" for="name">Nom du Cinéma :</label>
                    <input type="text" value="<?= isset($theater) ? $theater['name'] : "" ; ?>" name="name" class="form-control mt-2" placeholder="Entrez un nom">
                    <label class="form-label mb-2 mt-2" for="address">Adresse :</label>
                    <textarea type="text" placeholder="Entrez une adresse" name="address" class="form-control"><?= isset($theater) ? $theater['address'] : ""; ?></textarea>
                    <label class="form-label mb-2 mt-2" for="phone">Téléphone :</label>
                    <input type="text" value="<?= isset($theater) ? $theater['phone'] : ""; ?>" name="phone" class="form-control" placeholder="Entrez un numéro de téléphone">
                    <label class="form-label mb-2 mt-2" for="email">Email :</label>
                    <input type="email" value="<?= isset($theater) ? $theater['email'] : ""; ?>" name="email" class="form-control" placeholder="exemple@mail.com">
                    <label class="form-label mb-2 mt-2" for="city_id">Ville <?= isset($theater) ? " actuelle : " . $theater['city_name'] . "."  : "" ;?></label>
                    <select id="search-city-head" class="form-control me-2" name="city_id"></select>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary"><?= isset($theater) ? "Modifier" : "Créer"; ?></button>
                </div>
            </div>
        </form>
    </div>
</div>