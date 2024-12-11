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
                   <p><?= $movie['description']; ?></p>
                   <?php if($movie['rating'] != 'Tous Publics') { ?>
                       Film Interdit aux Moins de : <?= $movie['rating']; ?>.
                   <?php } ?>
               </div>
               <div class="card-footer">
                   <?php
                   if($showings) {
                       foreach($showings as $showing) { ?>
                           <div class="mb-3">
                               <div class="card">
                                    <?php $date = strtotime($showing['date']); ?>
                                   <p>Le : <?= date('d/m/Y',$date); ?> à <?= date('H:i',$date); ?></p>
                                   <p>Version : <?= $showing['version']; ?></p>
                                   <p>Cinéma : <?= $showing['theater_name']; ?> METTRE UN LIEN VERS LE CINOCHE</p>
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