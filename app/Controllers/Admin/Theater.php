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
        $cities = model('CityModel')->getAllCities();
        if($id == 'new') {
            return $this->view('theater/theater', ['cities' => $cities], true);
        }
        $theater = model('TheaterModel')->getTheaterById($id);
        if($theater) {
            $auditorium = model('AuditoriumModel')->getAllAuditorium();
            return $this->view('theater/theater', ['theater' => $theater, 'cities' => $cities, 'auditorium' => $auditorium], true);
        } else {
            $this->error(' Aucun Cinéma associé');
            $this->redirect('admin/theater', [], true);
        }
    }

    public function postcreate() {
        $data = $this->request->getPost();
        if(model('TheaterModel')->createTheater($data)) {
            $this->success('Cinéma créé avec succès');
        } else {
            $this->error('Erreur lors de la création du cinéma');
        }
        $this->redirect('admin/theater');
    }

    public function postupdate() {
        $data = $this->request->getPost();
        if(model('TheaterModel')->updateTheater($data['id'],$data)) {
            $this->success('Données du cinéma mises à jour avec succès!');
        } else {
            $this->error('Une erreur est survenue lors de la mise à jour des données du cinéma');
        }
        $this->redirect('admin/theater');
    }

    public function getdeactivate($id){
        $um = Model('TheaterModel');
        if ($um->deleteTheater($id)) {
            $this->success("Cinéma désactivé");
        } else {
            $this->error("Cinéma non désactivé");
        }
        $this->redirect('/admin/theater');
    }

    public function getactivate($id){
        $um = Model('TheaterModel');
        if ($um->activateTheater($id)) {
            $this->success("Cinéma activé");
        } else {
            $this->error("Cinéma non activé");
        }
        $this->redirect('/admin/theater');
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

    public function searchcity() {
        $term = $this->request->getGet('term');

        $city = model('CityModel')->like('label', $term)->findAll(10);

        return $this->response->setJSON($city);
    }
}
