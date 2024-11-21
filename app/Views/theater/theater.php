<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3>Modification d'un Cinéma</h3>
            </div>
            <div class="card-body">
                <label class="form-label mb-2" for="name">Nom du Cinéma :</label>
                <input type="text" value="<?= $theater['name']; ?>" name="name" class="form-control">
                <label class="form-label mb-2" for="city_name">Ville :</label>
                <input type="text" value="<?= $theater['city_name']; ?>" name="city_name" class="form-control">
                <label class="form-label mb-2" for="phone">Téléphone :</label>
                <input type="text" value="<?= $theater['phone']; ?>" name="phone" class="form-control">
                <label class="form-label mb-2" for="email">Ville :</label>
                <input type="email" value="<?= $theater['email']; ?>" name="email" class="form-control">
            </div>
        </div>
    </div>
</div>