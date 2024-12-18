<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des Salles</h4>
        <a href="<?= base_url('/admin/auditorium/new'); ?>"><i class="fa-solid fa-user-plus"></i></a>
    </div>
    <div class="card-body">
        <table class="table table-hover" id="tableAuditorium">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Cinéma</th>
                <th>Capacité</th>
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
        var dataTable = $("#tableAuditorium").DataTable({
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
                "data": { 'model' : 'AuditoriumModel'}
            },
            "columns": [
                {"data" : "id"},
                {"data" : "name"},
                {"data" : "theater_name"},
                {"data" : "capacity"},
                {
                    data : "id",
                    sortable : false,
                    render : function(data) {
                        return `<a href="${baseUrl}admin/auditorium/${data}"><i class="fa-solid fa-pencil"></i></a>`
                    },
                },
                {
                    data : 'id',
                    sortable : false,
                    render : function(data, type, row) {
                        return (row.deleted_at === null ?
                            `<a title="Désactiver le cinéma" href="${baseUrl}admin/auditorium/deactivate/${row.id}"><i class="fa-solid fa-xl fa-toggle-off text-success"></i></a>`: `<a title="Activer le cinéma"href="${baseUrl}admin/auditorium/activate/${row.id}"><i class="fa-solid fa-toggle-on fa-xl text-danger"></i></a>`);
                    }
                }
            ]
        })
    })
</script>