    <div class="row">
        <div class="col">
           <div class="card">
               <div class="card-header front">
                   <h3><?= $movie['title']; ?></h3>
               </div>
               <div class="card-body" style="background-color: #f2eade">
                   <div class="row">
                       <div class="col-md-4">
                           <div class="card h-100 text-center">
                               <?php
                               $img_src = !empty($movie['preview_url']) ? $movie['preview_url'] : base_url('assets/img/preview/flim.jpg');
                               ?>
                                <img style= width:300px height="400px" src="<?= $img_src ?>" class="card-img-top mx-auto d-block mt-2 mb-2" alt="<?= $movie['title'] ?>">
                           </div>
                       </div>
                       <div class="col-md-8">
                           <div class="card h-100">
                               <div class="row mt-2 h-25">
                                   <div class="col ms-2">
                                       Date de sortie : <?= $movie['release']; ?>
                                   </div>
                                   <div class="col">
                                       Durée : <?= $movie['duration']; ?> minutes
                                   </div>
                               </div>
                               <div class="row h-50">
                                   <div class="col ms-2">
                                   Synopsis :
                                       <p class="ms-4"><?= $movie['description']; ?></p>
                                   </div>
                               </div>
                               <div class="row h-25">
                                   <div class="col ms-2">
                                       Genre :
                                       <?php foreach($categories as $c) { ?>
                                           <div class="ms-3"><?= $c['name']; ?></div>
                                       <?php } ?>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
                   <?php
                   if($showings) { ?>
                       <div class="card-footer front d-flex flex-wrap justify-content-between">
                       <?php foreach($showings as $showing) { ?>
                           <form action="<?= base_url('showing/reserver'); ?>" method="POST">
                               <div class="mb-2">
                                   <div class="card" style="width: 25em; background-color: #fff5e7">
                                        <?php $date = strtotime($showing['date']); ?>
                                       <div class="row">
                                           <div class="col-8">
                                               <div class="ms-1">
                                                   Le : <?= date('d/m/Y',$date); ?> à <?= date('H:i',$date); ?>
                                               </div>
                                               <div class="ms-1">
                                                   Version : <?= $showing['version']; ?>
                                               </div>
                                               <div class="ms-1">
                                                   Cinéma : <a href="<?= base_url('theater/'. $showing['theater_slug']);?>" alt="Page du Cinéma"><?= $showing['theater_name']; ?></a>
                                               </div>
                                           </div>
                                           <div class="col-4 d-flex justify-content-center align-items-center">
                                               <a href="<?= base_url('showing/reserver');?>" type="submit" class="btn btn-primary">Réserver</a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </form>
                       <?php }
                   } else { ?>
                           <div class="card-footer front text-center"><h4>Pas de Séance Prévue</h4></div>
                   <?php } ?>
               </div>
           </div>
        </div>
    </div>
