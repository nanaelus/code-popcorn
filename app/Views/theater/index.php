<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header front">
                    <h2>Tout nos Cinémas pour Vous</h2>
                </div>
                <div class="card-body d-flex flex-wrap justify-content-between theaters">
                    <?php foreach ($theaters as $theater): ?>
                        <div class="card mb-3 theater" style="width: 25em;" data-id="<?= $theater['id'] ?>">
                            <div class="card-header front">
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
                            <div class="card-footer front" style="height: 105px;">
                                <div>Adresse : <?= $theater['address']; ?></div>
                                <div>Tel : <?= $theater['phone']; ?></div>
                                <div>Email : <?= $theater['email']; ?></div>
                            </div>
                        </div>
                    <?php endforeach ; ?>
                </div>
                <div class="row">
                    <div class="col text-center" id="chargerPlus" data-limit="6" data-offset="6">
                        <div class="btn btn-outline-primary" id="btnChargerPlus">Charger Plus</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        var baseUrl = "<?= base_url(); ?>";
        $('#btnChargerPlus').on('click', function(e) {
            let limit = $('#chargerPlus').data('limit');
            let offset = $('#chargerPlus').data('offset');
            $(this).attr('disabled', true);
            $.ajax({
                type: "GET",
                url: baseUrl + "theater/ajaxloadmore",
                data: {
                    limit: limit,
                    offset: offset,
                },
                success: function (data) {
                    const row = $('.theaters');
                    data = JSON.parse(data);
                    // Ajout dynamique des medias
                    data.forEach(function(theater) {
                        if (theater.preview_url) {
                            var img = baseUrl + theater.preview_url;
                        } else {
                            var img = baseUrl + 'assets/img/theater/default.jpg';
                        }
                        const theaterElement = `
                            <div class="card mb-3 theater" style="width: 25em;" data-id="${theater.id}">
                                <div class="card-header front">
                                    ${theater.name}
                                </div>
                                <div class="card-body d-flex justify-content-center">
                                    <span>
                                        <a href="${baseUrl + 'theater/' + theater.id}">
                                                <img style= width:300px height="300px" src="${img}">
                                        </a>
                                    </span>
                                </div>
                            <div class="card-footer front" style="height: 105px;">
                                <div>Adresse : ${theater.address}</div>
                                <div>Tel : ${theater.phone}</div>
                                <div>Email : ${theater.email}</div>
                            </div>
                        </div>
                        `;
                        row.append(theaterElement);
                    });
                    offset = parseInt(offset) + parseInt(limit);
                    $('#chargerPlus').data('offset', offset);
                    console.log($('#chargerPlus').data('offset'));
                }
            });
        });
    })
</script>