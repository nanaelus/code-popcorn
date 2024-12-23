<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des Catégories</h4>
        <a href="<?= base_url('admin/movie/category/new'); ?>" alt="Création de catégorie"><i class="fa-solid fa-circle-plus"></i></a>
    </div>
    <table class="table table-hover" id="tableCategory">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Slug</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal" tabindex="-1" id="modalType">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modification d'une Catégorie</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <form method="POST" action="<?= base_url('admin/movie/updatecategory'); ?>" id="formModal">
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
        var dataTable = $('#tableCategory').DataTable({
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
                "data": {'model' : 'CategoryModel'},
            },
            "columns" : [
                {"data" : "id"},
                {
                    data : 'name',
                    render : function(data) {
                        return `<span class='name-categ'>${data}</span>`;
                    }
                },
                {
                    data : 'slug',
                    render : function(data) {
                        return `<span class='slug-categ'>${data}</span>`;
                    }
                },
                {
                    data : "id",
                    sortable : false,
                    render : function(data) {
                        return `<a href="${baseUrl}admin/movie/category/${data}" id="${data}" alt="Modifier" class="champagne"><i class="fa-solid fa-pencil" ></i></a>`;
                    }
                },
                {
                    data : "id",
                    sortable : false,
                    render : function(data) {
                        return `<a href="${baseUrl}admin/movie/deletecategory/${data}"  alt="Supprimer"><i class="fa-solid fa-trash"></i></a>`;
                    }
                }
            ]
        });
        // Ouverture de ma Modal
        const modalType = new bootstrap.Modal('#modalType');
        $('body').on('click', '.champagne', function(event) {
            event.preventDefault();
            modalType.show();
            let categ_id = $(this).attr('id');
            let categ_name = $(this).closest('tr').find(".name-categ").html();
            $('.modal input[name="id"]').val(categ_id);
            $('.modal input[name="name"]').val(categ_name);         
        });
        $('#formModal').on('submit', function(event){
            event.preventDefault();
            let categ_id = $('.modal input[name="id"]').val();
            let categ_name = $('.modal input[name="name"]').val()
            console.log(categ_id + " " + categ_name);
            $.ajax({
                type : "POST",
                url: $(this).attr("action"),
                data : {
                    id : categ_id,
                    name : categ_name,
                },
                success : function(data) {
                    var json = JSON.parse(data);
                    const ligne = $('#'+categ_id).closest('tr');
                    ligne.find('.slug-categ').html(json.slug);
                    ligne.find('.name-categ').html(json.name);
                    modalType.hide();
                }
            })
        })
    })
</script>