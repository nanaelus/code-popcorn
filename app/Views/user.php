<div class="row">
    <div class="col">
        <form method="POST" action="<?= base_url('user/update'); ?>" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <div class="card-title text-center h3">
                        Mon Profil
                    </div>
                    <div class="dropdown start-100">
                        <button class="btn btn-secondary nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                        <ul class="dropdown-menu">
                            <li class="small"><a href="<?= base_url('user/delete/'. $user->id); ?>" class="dropdown-item"><i class="fa-solid fa-trash text-danger"></i> Suppression du Compte</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="username" placeholder="username" value="<?= isset($utilisateur) ? $utilisateur['username'] : ""; ?>" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="firstname" placeholder="firstname" value="<?= isset($utilisateur) ? $utilisateur['firstname'] : ""; ?>" name="firstname" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Nom de Famille</label>
                        <input type="text" class="form-control" id="lastname" placeholder="lastname" value="<?= isset($utilisateur) ? $utilisateur['lastname'] : ""; ?>" name="lastname" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Numéro de Téléphone</label>
                        <input type="text" class="form-control" id="phone" placeholder="phone" value="<?= isset($utilisateur) ? $utilisateur['phone'] : ""; ?>" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date de Naissance</label>
                        <input type="date" class="form-control" id="dob" placeholder="dob" value="<?= isset($utilisateur) ? $utilisateur['dob'] : ""; ?>" name="dob" required>
                    </div>

                    <div class="mb-3">
                        <label for="mail" class="form-label">E-mail</label>
                        <input type="text" class="form-control" <?= isset($utilisateur) ? "" : 'name="email"' ; ?> id="mail" placeholder="mail" value="<?= isset($utilisateur) ? $utilisateur['email'] : "" ?>" <?= isset($utilisateur) ? "readonly" : "required" ?>>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" placeholder="password" value="" name="password" <?= isset($utilisateur) ? "" : "required"; ?>>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <label for="image" class="form-label me-2">Avatar</label>
                        <div id="preview">
                            <?php
                            $profileImageUrl = isset($utilisateur['avatar_url']) ? base_url($utilisateur['avatar_url']) : "#";
                            ?>
                            <img class="img-thumbnail me-2"alt="Aperçu de l'image"
                                 style="display: <?= isset($utilisateur['avatar_url']) ? "block" : "none" ?>; max-width: 100px;"
                                 src="<?= $profileImageUrl ?>">
                        </div>
                        <input class="form-control" type="file" name="profile_image" id="image">
                    </div>
                </div>
                <div class="card-footer text-end">
                    <input type="hidden" name="id" value="<?= $user->id ?>">
                    <input type="hidden" name="id_permission" value="<?= $user->id_permission ?>">
                    <button type="submit" class="btn btn-primary ">Enregister</button>
                </div>
            </div>
        </form>
    </div>
</div>