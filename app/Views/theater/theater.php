<div class="container">
    <div class="rox">
        <div class="col">
            <div class="card>">
                <div class="card-header">
                    <h4><?= $theater['name']; ?></h4>
                </div>
                <div class="card-body">
                    A l'affiche :
                    <?php foreach ($showing as $show) { ?>
                        <div class="card">
                            <p><?= $show['title']; ?></p>
                            <a href="<?= base_url('movie/' . $show['slug']); ?>">
                            <?php if($show['preview_url']) { ?>
                                <img style= width:300px height="300px" src="<?= base_url($show['preview_url']); ?>">
                            <?php } else { ?>
                                <img style= width:300px height="300px" src="<?= base_url('assets/img/preview/flim.jpg'); ?>">
                            <?php } ?>
                            </a>
                            <p> Le : <?= $show['date']; ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>