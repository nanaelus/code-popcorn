<div class="container">
    <div class="row">
        <div class="col">
           <div class="card">
               <div class="card-header">
                   <h3><?= $movie['title']; ?></h3>
               </div>
               <div class="card-body">
                   <div class="d-flex justify-content-between">
                       <span>Date de Sortie : <?= $movie['release']; ?></span>
                       <span>Durée : <?= $movie['duration']; ?> minutes</span>
                   </div>
                   <?php
                   $img_src = !empty($movie['preview_url']) ? $movie['preview_url'] : base_url('assets/img/preview/flim.jpg');
                   ?>
                       <img style= width:300px height="400px" src="<?= $img_src ?>" class="card-img-top" alt="<?= $movie['title'] ?>">
                   <div class="mb-3"><?= $movie['description']; ?></div>
                   <div class="mb-3">
                       Genre :
                       <?php foreach($categories as $c) { ?>
                           <div class="ms-3"><?= $c['name']; ?></div>
                       <?php } ?>
                   </div>
                   <?php if($movie['rating'] != 'Tous Publics') { ?>
                       Film Interdit aux Moins de : <?= $movie['rating']; ?>.
                   <?php } ?>
               </div>
               <div class="card-footer d-flex flex-wrap justify-content-between">
                   <?php
                   if($showings) {
                       foreach($showings as $showing) { ?>
                           <div class="mb-2">
                               <div class="card" style="width: 25em;">
                                    <?php $date = strtotime($showing['date']); ?>
                                   <div class="ms-1">
                                       Le : <?= date('d/m/Y',$date); ?> à <?= date('H:i',$date); ?>
                                   </div>
                                   <div class="ms-1">
                                       Version : <?= $showing['version']; ?>
                                   </div>
                                   <div class="ms-1">
                                       Cinéma : <a href="<?= base_url('theater/'. $showing['theater_id']);?>" alt="Page du Cinéma"><?= $showing['theater_name']; ?></a>
                                   </div>
                               </div>
                           </div>
                       <?php }
                   }
                   ?>
               </div>
           </div>
        </div>
    </div>
</div>