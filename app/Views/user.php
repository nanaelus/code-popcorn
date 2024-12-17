<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-center h3">
                    Mon Profile
                </div>
                <div class="dropdown start-100">
                    <button class="btn btn-secondary nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                    <ul class="dropdown-menu">
                        <li class="small"><a href="<?= base_url('user/delete/'. $user->id); ?>" class="dropdown-item"><i class="fa-solid fa-trash text-danger"></i> Suppression du Compte</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                USERNAME
                PRENOM
                NOM DE FAMILLE
                EMAIL
                TEL
                Date de naissance
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary ">Enregister</button>
            </div>
        </div>
    </div>
</div>