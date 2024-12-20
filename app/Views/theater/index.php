<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h2>Tout nos Cinémas pour Vous</h2>
                </div>
                <div class="card-body d-flex flex-wrap justify-content-between">
                    <?php foreach ($theaters as $theater): ?>
                        <div class="card mb-3" style="width: 25em;">
                            <div class="card-header">
                                <?= $theater["name"]; ?>
                            </div>
                            <div class="card-body d-flex justify-content-center">
                            <span>
                                <a href="<?= base_url('theater/' . $theater['id']); ?>">
                                    <?php
                                    if($theater['preview_url']) { ?>
                                        <img style= width:300px height="300px" src="<?= base_url($theater['preview_url']) ?>">
                                    <?php } else { ?>
                                        <img style= width:300px height="300px" src="<?= base_url('assets/img/theater/default.jpg') ?>">
                                    <?php } ?>
                                </a>
                            </span>
                            </div>
                            <div class="card-footer">
                                Adresse : <?= $theater['address']; ?>
                                Tel : <?= $theater['phone']; ?>
                                Email : <?= $theater['email']; ?>
                            </div>
                        </div>
                    <?php endforeach ; ?>
                </div>
            </div>
        </div>
    </div>
</div>