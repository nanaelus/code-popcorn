<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des Prix</h4>
        <a href="" alt="Création de Tarifs"><i class="createchampagne fa-solid fa-circle-plus"></i></a>
    </div>
    <table class="table table-hover" id="tablePrice">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Amount</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- Modal Create Price -->
<div class="modal createmodal" tabindex="-1" id="modalType2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Création d'un Tarif</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('admin/showing/createprice'); ?>" id="formModal2">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Nom du Tarif
                            </label>
                            <input type="text" name="name" class="form-control" value="" placeholder="Entrez le nom" >
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">
                                Montant (en Euros)
                            </label>
                            <input type="text" name="amount" class="form-control" value="" placeholder="Entrez le montant" >
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary">Créer</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update Price -->
<div class="modal updatemodal" tabindex="-1" id="modalType">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modification d'un Tarif</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('admin/showing/updateprice'); ?>" id="formModal">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Nom du tarif
                            </label>
                            <input type="text" name="name" class="form-control" value="" placeholder="Entrez le nom" >
                            <input type="hidden" value="" name="id">
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">
                                Montant (en Euros)
                            </label>
                            <input type="text" name="amount" class="form-control" value="" placeholder="Entrez le montant" >
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var baseUrl = "<?= base_url(); ?>";
        var dataTable = $('#tablePrice').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "language": {
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json',
            },
            "ajax": {
                "url": baseUrl + "/admin/theater/searchdatatable",
                "type": "POST",
                "data": {'model' : 'PriceModel'},
            },
            "columns" : [
                {"data" : "id"},
                {
                    data : 'name',
                    render : function(data) {
                        return `<span class='name-price'>${data}</span>`;
                    }
                },
                {
                    data : 'amount',
                    render : function(data) {
                        return `<span class='amount-price'>${data}</span>`;
                    }
                },
                {
                    data : "id",
                    sortable : false,
                    render : function(data) {
                        return `<a href="" id="${data}" alt="Modifier" class="champagne"><i class="fa-solid fa-pencil" ></i></a>`;
                    }
                },
                {
                    data : "id",
                    sortable : false,
                    render : function(data) {
                        return `<a href="${baseUrl}admin/showing/deleteprice/${data}"  alt="Supprimer"><i class="fa-solid fa-trash"></i></a>`;
                    }
                }
            ]
        });
        // Ouverture de ma Modal d'Update
        const modalType = new bootstrap.Modal('#modalType');
        $('body').on('click', '.champagne', function(event) {
            event.preventDefault();
            modalType.show();
            let price_id = $(this).attr('id');
            let price_name = $(this).closest('tr').find(".name-price").html();
            let price_amount = $(this).closest('tr').find(".amount-price").html();
            $('.updatemodal input[name="id"]').val(price_id);
            $('.updatemodal input[name="name"]').val(price_name);
            $('.updatemodal input[name="amount"]').val(price_amount);
        });
        $('#formModal').on('submit', function(event){
            event.preventDefault();
            let price_id = $('.updatemodal input[name="id"]').val();
            let price_name = $('.updatemodal input[name="name"]').val();
            let amount_name = $('.updatemodal input[name="amount"]').val();
            $.ajax({
                type : "POST",
                url: $(this).attr("action"),
                data : {
                    id : price_id,
                    name : price_name,
                    amount : amount_name
                },
                success : function(data) {
                    var json = JSON.parse(data);
                    const ligne = $('#'+price_id).closest('tr');
                    ligne.find('.amount-price').html(json.amount);
                    ligne.find('.name-price').html(json.name);
                    modalType.hide();
                }
            })
        });

        //Ouverture de Modal de Création
        const modalType2 = new bootstrap.Modal('#modalType2');
        $('body').on('click', '.createchampagne', function(event) {
            event.preventDefault();
            modalType2.show();
        });
        $('#formModal2').on('submit', function(event){
            event.preventDefault();
            let price_name = $('.createmodal input[name="name"]').val();
            $.ajax({
                type : "POST",
                url: $(this).attr("action"),
                data : {
                    name : price_name,
                },
                success : function(data) {
                    location.reload();
                }
            });
            // Cache la modale après l'ajout de la catégorie
            modalType2.hide();
        });
    });
</script>