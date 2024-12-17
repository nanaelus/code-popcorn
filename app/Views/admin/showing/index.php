<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des Séances</h4>
        <a href="<?= base_url('admin/showing/new'); ?>"><i class="fa-regular fa-clock"></i></a>
    </div>
    <div class="card-body">
        <table class="table table-sm table-hover" id="tableShowings">
            <thead>
            <tr>
                <th>ID</th>
                <th>Date de la Séance</th>
                <th>Description</th>
                <th>Nom du Film</th>
                <th>Nom du Cinéma</th>
                <th>Nom de la Salle</th>
                <th>Nombre de places</th>
                <th>Type de Séance</th>
                <th>Version</th>
                <th>Catégorie de Prix</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        var baseUrl = "<?= base_url(); ?>";
        var dataTable = $('#tableShowings').DataTable({
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
                "data": { 'model' : 'ShowingModel'}
            },
            "columns": [
                {"data" : "id"},
                {"data" : "date"},
                {"data" : "description"},
                {"data" : "movie_name"},
                {"data" : "theater_name"},
                {"data" : "auditorium_name"},
                {"data" : "capacity"},
                {"data" : "type_name"},
                {"data" : "version"},
                {"data" : "categ_price"},
                {
                    data : "id",
                    sortable : false,
                    render: function(data) {
                        return `<a href="${baseUrl}/admin/showing/delete/${data}"><i class="fa-solid fa-trash"></i></a>`
                    }
                },
                ]
        })
    })
</script>