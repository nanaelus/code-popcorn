<div class="row">
    <div class="col">
        <form method="POST" action="<?= isset($categ) ? base_url('admin/movie/updatecategory') : base_url('/admin/movie/createcategory') ?>">
            <div class="card">
                <div class="card-header">
                    <?= isset($categ) ? 'Modification de la catégorie : "'.$categ['name'] .'"' : 'Création d\'une Catégorie'; ?>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Nom de la Catégorie
                        </label>
                        <input type="text" name="name" class="form-control" placeholder="Entrez le nom" <?= isset($categ) ? 'value="'.$categ['name'].'"' : '' ?>>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" value="<?= isset($categ) ? $categ['id'] : "";?>" name="id">
                    <button type="submit" class=" btn btn-primary"><?= isset($categ)? "Modifier" : "Créer"; ?></button>
                </div>
            </div>
        </form>
    </div>
</div>