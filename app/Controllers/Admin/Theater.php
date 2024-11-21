<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Theater extends BaseController
{
    public function getindex($id = null )
    {
        if($id == null) {
            $allTheaters = model('TheaterModel')->getAllTheaters();
            return $this->view('theater/index', ['allTheaters' => $allTheaters], true);
        }
        if($id == 'new') {
            return $this->view('theater/theater', [], true);
        }
        $theater = model('TheaterModel')->getTheaterById($id);
        if($theater) {
            return $this->view('theater/theater', ['theater' => $theater], true);
        } else {
            $this->error('Aucun Cinéma associé');
            return $this->view('theater/index', [], true);
        }
    }

    public function postsearchdatatable()
    {
        $model_name = $this->request->getPost('model');
        $model = model($model_name);
        // Paramètres de pagination et de recherche envoyés par DataTables
        $draw        = $this->request->getPost('draw');
        $start       = $this->request->getPost('start');
        $length      = $this->request->getPost('length');
        $searchValue = $this->request->getPost('search')['value'];


        // Obtenez les informations sur le tri envoyées par DataTables
        $orderColumnIndex = $this->request->getPost('order')[0]['column'] ?? 0;
        $orderDirection = $this->request->getPost('order')[0]['dir'] ?? 'asc';
        $orderColumnName = $this->request->getPost('columns')[$orderColumnIndex]['data'] ?? 'id';

        // Obtenez les données triées et filtrées
        $data = $model->getPaginated($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $model->getTotal();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $model->getFiltered($searchValue);

        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }
}
