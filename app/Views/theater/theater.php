<div class="container">
    <div class="rox">
        <div class="col">
            <div class="card>">
                <div class="card-header">
                    <h4><?= $theater['name']; ?></h4>
                </div>
                    <div class="card">
                        <div class="card-header">
                            A l'affiche :
                        </div>
                        <div class="card-body">
                        <?php if($showing) { ?>
                        <?php foreach ($showing as $show) { ?>
                            <div class="card mb-3">
                                <p><?= $show['title']; ?></p>
                                <div class="col">
                                <a href="<?= base_url('movie/' . $show['slug']); ?>">
                                <?php if($show['preview_url']) { ?>
                                    <img style= width:300px height="300px" src="<?= base_url($show['preview_url']); ?>">
                                <?php } else { ?>
                                    <img style= width:300px height="300px" src="<?= base_url('assets/img/preview/flim.jpg'); ?>">
                                <?php } ?>
                                </a>
                                </div>
                                <p> Le : <?= $show['date']; ?></p>
                            </div>
                        <?php }
                        } else { ?>
                        <div class="card-footer">
                            Pas de films programmés pour le moment.
                        </div>
                    <?php }?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>