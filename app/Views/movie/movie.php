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
                   <img src="<?=base_url($movie['preview_url']); ?>">
                   <p><?= $movie['description']; ?></p>
                   <?php if($movie['rating'] != 'Tous Publics') { ?>
                       Film Interdit aux Moins de : <?= $movie['rating']; ?>.
                   <?php } ?>
               </div>
           </div>
        </div>
    </div>
</div>