<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Films en salle actuellement
                </div>
                <div class="card-body">
                    <?php foreach (array_chunk($movies, 4) as $chunk) { ?>
                        <div class="row shelf-row px-4">
                            <?php foreach ($chunk as $movie) { ?>
                                <div class="col-md-3 col-6">
                                    <div class="card h-100">
                                        <span>
                                        <?php
                                        $img_src = !empty($movie['preview_url']) ? $movie['preview_url'] : base_url('assets/img/preview/flim.jpg');
                                        ?>
                                        <a href="<?= base_url('movie/' . $movie['slug']) ?>">
                                            <img src="<?= $img_src ?>" class="card-img-top" alt="<?= $movie['title'] ?>">
                                        </a></span>
                                        <span class=" d-flex align-content-between"><?= $movie['title']; ?></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
</div>