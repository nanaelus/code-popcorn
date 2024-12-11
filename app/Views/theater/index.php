<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h2>Tout nos Cinémas pour Vous</h2>
                </div>
                <div class="card-body">
                    <?php foreach ($theaters as $theater): ?>
                        <div class="card mb-3">
                            <div class="col">
                                <a href="<?= base_url('theater/' . $theater['id']); ?>">
                                    <?php
                                        if($theater['preview_url']) { ?>
                                            <img style= width:300px height="300px" src="<?= base_url($theater['preview_url']) ?>">
                                        <?php } else { ?>
                                            <img style= width:300px height="300px" src="<?= base_url('assets/img/theater/default.jpg') ?>">
                                    <?php } ?>
                                </a>
                            </div>
                            <p><?= $theater["name"]; ?></p>
                            <p>Adresse : <?= $theater['address']; ?> <?= $theater['city_name']; ?></p>
                            <p>Tel : <?= $theater['phone']; ?></p>
                            <p>Email : <?= $theater['email']; ?></p>
                        </div>
                    <?php endforeach ; ?>
                </div>
            </div>
        </div>
    </div>
</div>