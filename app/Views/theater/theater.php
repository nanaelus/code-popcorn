<div class="row">
    <div class="col">
        <h4><?= $theater['name']; ?></h4>
        <div class="card">
            <div class="card-header">
                A l'affiche :
            </div>
            <div class="card-body d-flex flex-wrap justify-content-between">
                <?php if($showing) { ?>
                <?php foreach ($showing as $show) { ?>
                        <div class="card mb-3" style="width: 25em;">
                            <div class="card-header h5">
                                <?= $show['title']; ?>
                            </div>
                            <div class="card-body d-flex justify-content-center">
                                <span>
                                    <a href="<?= base_url('movie/' . $show['slug']); ?>">
                                <?php if($show['preview_url']) { ?>
                                    <img style= width:300px height="300px" src="<?= base_url($show['preview_url']); ?>">
                                <?php } else { ?>
                                    <img style= width:300px height="300px" src="<?= base_url('assets/img/preview/flim.jpg'); ?>">
                                <?php } ?>
                                </a>
                                </span>
                            </div>
                            <div class="card-footer">
                                <?php $date = strtotime($show['date']); ?>
                                Le : <?= date('d/m/Y',$date); ?> à <?= date('H:i',$date); ?>
                            </div>
                        </div>
                <?php }
                } else { ?>
                    <div class="text-center">
                        Pas de films programmés pour le moment.
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
