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
                {"data" : "name"},
                {"data" : "slug"},
                {
                    data : "id",
                    sortable : false,
                    render : function(data) {
                        return `<a href="${baseUrl}admin/movie/category/${data}" alt="Modifier"><i class="fa-solid fa-pencil"></i></a>`;
                    }
                },
                {
                    data : "id",
                    sortable : false,
                    render : function(data) {
                        return `<a href="${baseUrl}admin/movie/deletecategory/${data}" alt="Supprimer"><i class="fa-solid fa-trash"></i></a>`;
                    }
                }
            ]
        })
    })
</script>