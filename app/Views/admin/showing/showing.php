<div class="container">
    <div class="row">
        <div class="col">
            <form action="<?= base_url('admin/showing/create'); ?>" method="POST">
                <div class="card">
                    <div class="card-header">
                        <h4>Ajout d'une Séance</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="date" class="form-label">Date et Heure:</label>
                            <input type="datetime-local" name="date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="movie_id" class="form-label">Film :</label>
                            <select class="form-select" name="movie_id" required>
                                <option value="" selected disabled>Séléctionnez un film</option>
                                <?php foreach ($movies as $movie){ ?>
                                    <option value="<?= $movie['id']; ?>"><?= $movie['title']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="version" class="form-label">Choix de la Version</label>
                            <select name="version" class="form-select" required>
                                <option value="">-- Choix de la Version --</option>
                                <option value="VF">VF</option>
                                <option value="VOSTFR">VOSTFR</option>
                                <option value="VFSTFR">VFSTFR</option>
                                <option value="Audiodescription">Audiodescription</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="auditorium_id" class="form-label">Choix de la Salle</label>
                            <select class="form-select" name="auditorium_id" id="auditorium_id" required>
                                <option value="" >-- Quel Salle ? --</option>
                                <?php foreach ($auditoriums as $a): ?>
                                    <option value="<?= $a['id']; ?>"><?= $a['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description de la Séance</label>
                            <textarea type="text" name="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="capacity" class="form-label">Nombre de tickets</label>
                            <input type="number" max="" class="form-control" name="capacity" required>
                        </div>
                        <div class="mb-3">
                            <label for="type_show">Type de séance</label>
                            <select name="type_show_id" class="form-select" required>
                                <option value="" >-- Type de de Séance --</option>
                                <?php foreach ($allShowingType as $type) { ?>
                                    <option value="<?= $type['id']; ?>"><?= $type['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price_id" class="form-label">Catégorie de prix de départ</label>
                            <select name="price_id" class="form-select" required>
                                <option value=""  disabled selected>Catégorie de prix</option>
                                <?php foreach($prices as $price){ ?>
                                <option value="<?= $price['id']; ?>"><?= $price['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>