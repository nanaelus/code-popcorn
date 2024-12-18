<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Liste des Films</h4>
        <a href="<?= base_url('admin/movie/new'); ?>"><i class="fa-solid fa-circle-plus"></i></a>
    </div>
    <div class="card-body">
        <table class="table table-sm table-hover" id="tableMovies">
            <thead>
            <tr>
                <th>ID</th>
                <th>Affiche</th>
                <th>Titre</th>
                <th>Date de Sortie</th>
                <th>Durée en minutes</th>
                <th>Description</th>
                <th>Classification</th>
                <th>Modifier</th>
                <th>Disponibilité</th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        let baseUrl = "<?= base_url(); ?>";
        let dataTable = $("#tableMovies").DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "language": {
                url: baseUrl + "/js/datatable/datatable-2.1.4-fr-FR.json",
            },
            "ajax": {
                "url": baseUrl + "admin/theater/searchdatatable",
                "type": "POST",
                "data": {'model' : 'MovieModel'},
            },
            "columns": [
                {"data" : "id"},
                {
                    data : "preview_url",
                    sortable : false,
                    render: function(data) {
                        if (data) {
                            return `<img src="${baseUrl}${data}" alt="Avatar" style="max-width: 20px; height: auto;">`;
                        } else {
                            return '<img src="' + baseUrl + 'assets/img/preview/movie.jpg" alt="Default Avatar" style="max-width: 20px; height: auto;">';
                        }
                    }
                },
                {"data" : "title"},
                {"data" : "release"},
                {"data" : "duration"},
                {"data" : "description"},
                {"data" : "rating"},
                {
                    data : "id",
                    sortable : false,
                    render : function(data) {
                        return `<a href="${baseUrl}admin/movie/${data}"><i class="fa-solid fa-pencil"></i></a>`
                    },
                },
                {
                    data : "id",
                    sortable : false,
                    render : function(data, type, row) {
                        return (row.deleted_at === null ?
                        `<a title="Rendre indisponible" href="${baseUrl}admin/movie/deactivate/${row.id}"><i class="fa-solid fa-xl fa-toggle-off text-success"></i></a>` : `<a title="Rendre disponible" href="${baseUrl}admin/movie/activate/${row.id}"><i class="fa-solid fa-xl fa-toggle-on text-danger"></i></a>`);
                    }
                },
            ]
        })
    })
</script>