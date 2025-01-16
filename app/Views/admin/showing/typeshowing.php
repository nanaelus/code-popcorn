<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des Types de Séances</h4>
        <a href="" alt="Création de Type de Séance"><i class="createchampagne fa-solid fa-circle-plus"></i></a>
    </div>
    <table class="table table-hover" id="tableTypeShowing">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- Modal Create Category-->
<div class="modal createmodal" tabindex="-1" id="modalType2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Création d'un Type de Séance</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('admin/showing/createtypeshowing'); ?>" id="formModal2">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Nom du Type
                            </label>
                            <input type="text" name="name" class="form-control" value="" placeholder="Entrez le nom" >
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

<!-- Modal Update Type-->
<div class="modal updatemodal" tabindex="-1" id="modalType">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modification d'un Type</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('admin/showing/updatetypeshowing'); ?>" id="formModal">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Nom de la Catégorie
                            </label>
                            <input type="text" name="name" class="form-control" value="" placeholder="Entrez le nom" >
                            <input type="hidden" value="" name="id">
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
        var dataTable = $('#tableTypeShowing').DataTable({
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
                "data": {'model' : 'TypeShowingModel'},
            },
            "columns" : [
                {"data" : "id"},
                {
                    data : 'name',
                    render : function(data) {
                        return `<span class='name-type'>${data}</span>`;
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
                        return `<a href="${baseUrl}admin/showing/deletetypeshowing/${data}"  alt="Supprimer"><i class="fa-solid fa-trash"></i></a>`;
                    }
                }
            ]
        });
        // Ouverture de ma Modal d'Update
        const modalType = new bootstrap.Modal('#modalType');
        $('body').on('click', '.champagne', function(event) {
            event.preventDefault();
            modalType.show();
            let type_id = $(this).attr('id');
            let type_name = $(this).closest('tr').find(".name-type").html();
            $('.updatemodal input[name="id"]').val(type_id);
            $('.updatemodal input[name="name"]').val(type_name);
        });
        $('#formModal').on('submit', function(event){
            event.preventDefault();
            let type_id = $('.updatemodal input[name="id"]').val();
            let type_name = $('.updatemodal input[name="name"]').val();
            $.ajax({
                type : "POST",
                url: $(this).attr("action"),
                data : {
                    id : type_id,
                    name : type_name,
                },
                success : function(data) {
                    var json = JSON.parse(data);
                    const ligne = $('#'+type_id).closest('tr');
                    ligne.find('.name-type').html(json.name);
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
            let type_name = $('.createmodal input[name="name"]').val();
            $.ajax({
                type : "POST",
                url: $(this).attr("action"),
                data : {
                    name : type_name,
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