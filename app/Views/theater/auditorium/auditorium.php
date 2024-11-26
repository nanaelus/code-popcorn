<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Page <?= isset($auditorium) ? "de modification" : "de création"; ?> de salle.
            </div>
            <div class="card-body">
               <form method="POST" action="<?= isset($auditorium) ? base_url('/admin/auditorium/update') : base_url('/admin/auditorium/create'); ?>">
                   <input type="hidden" name="id" value="<?= isset($auditorium) ? $auditorium['id']: '' ; ?>"
                   <label class="form-label" for="name">Nom de la Salle :</label>
                   <input type="text" name="name" class="form-control mt-2 mb-2" value="<?= isset($auditorium) ? $auditorium['name']: '' ; ?>" required>
                   <label class="form-label" for="capacity">Capacité de la Salle :</label>
                   <input type="number" name="capacity" class="form-control mt-2 mb-2" value="<?= isset($auditorium) ? $auditorium['capacity']: '' ; ?>" required>
                   <label class="form-label" for="theater_id">Nom du Cinéma :</label>
                   <select name="theater_id" class="form-select">
                       <option <?= isset($auditorium) ? "" : "selected"; ?> disabled>--Choisissez un Cinéma--</option>
                       <?php foreach($allTheater as $a) { ?>
                           <option value="<?= $a['id']; ?>" <?= isset($auditorium) && $auditorium['theater_id'] == $a['id'] ? 'selected' : '' ; ?>><?= $a['name']; ?></option>
                       <?php } ?>
                   </select>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><?= isset($auditorium) ? "Modifier" : "Créer"; ?></button>
            </div>
            </div>
        </form>
    </div>
</div>