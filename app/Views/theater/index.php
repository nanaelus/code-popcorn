<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des Cinémas</h4>
        <a href="<?= base_url('/admin/theater/new'); ?>"><i class="fa-solid fa-user-plus"></i></a>
    </div>
    <div class="card-body">
        <table class="table table-sm table-hover" id="tableTheaters">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Ville</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Modifier</th>
                <th>Actif/Inactif</th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        var baseUrl = "<?= base_url(); ?>";
        var dataTable = $("#tableTheaters").DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "language": {
                url: baseUrl + "/js/datatable/datatable-2.1.4-fr-FR.json",
            },
            "ajax": {
                "url": baseUrl + "/admin/theater/searchdatatable",
                "type": "POST",
                "data": { 'model' : 'TheaterModel'}
            },
            "columns": [
                {"data" : "id"},
                {"data" : "name"},
                {"data" : "city_name"},
                {"data" : "phone"},
                {"data" : "email"},
                {
                    data : "id",
                    sortable : false,
                    render : function(data) {
                        return `<a href="${baseUrl}/admin/theater/${data}"><i class="fa-solid fa-pencil"></i></a>`
                    },
                },
                {
                    data : 'id',
                    sortable : false,
                    render : function(data, type, row) {
                        return (row.deleted_at === null ?
                            `<a title="Désactiver le cinéma" href="${baseUrl}/admin/theater/desactivate/${row.id}"><i class="fa-solid fa-xl fa-toggle-off text-success"></i></a>`: `<a title="Activer le cinéma"href="${baseUrl}/admin/theater/activate/${row.id}"><i class="fa-solid fa-toggle-on fa-xl text-danger"></i></a>`);
                    }
                }
            ]
        })
    })
</script>
