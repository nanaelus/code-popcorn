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
                        <div class="card">
                            <div class="card-header h5">
                                <?= $show['title']; ?>
                            </div>
                            <div class="card-body">

                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </div>
