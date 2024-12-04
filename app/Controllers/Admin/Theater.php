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
            return $this->view('theater/theater', [], true);
        }
        $theater = model('TheaterModel')->getTheaterById($id);
        if($theater) {
            $auditorium = model('AuditoriumModel')->getAllAuditorium();
            return $this->view('theater/theater', ['theater' => $theater, 'auditorium' => $auditorium], true);
        } else {
            $this->error(' Aucun Cinéma associé');
            $this->redirect('admin/theater', [], true);
        }
    }

    public function postcreate() {
        $data = $this->request->getPost();
        $newTheaterId = model('TheaterModel')->createTheater($data);
        if($newTheaterId) {
            $file = $this->request->getFile('theater_image');
            if($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                $mediaData = [
                    'entity_type' => 'theater',
                    'entity_id' => $newTheaterId,
                ];
                $uploadResult = upload_file($file, 'theater_preview', $data['name'], $mediaData, true, ['image/jpeg', 'image/png','image/jpg']);
                if(is_array($uploadResult) && $uploadResult['status'] === 'error') {
                    $this->error("Une erreur est survenue lors de l'upload de l'image");
                }
            }
            $this->success('Cinéma créé avec succès');
        } else {
            $this->error('Erreur lors de la création du cinéma');
        }
        $this->redirect('admin/theater');
    }

    public function postupdate() {
        $data = $this->request->getPost();
        if(model('TheaterModel')->updateTheater($data['id'],$data)) {
            $file = $this->request->getFile('theater_image');
            if($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                $old_media = model('MediaModel')->getMediaByEntityIdAndType($data['id'], 'theater');
                $mediaData = [
                    'entity_type' => 'theater',
                    'entity_id' => $data['id'],
                ];
                $uploadResult = upload_file($file, 'theater_preview', $data['name'], $mediaData, true, ['image/jpeg', 'image/png','image/jpg']);
                if(is_array($uploadResult) && $uploadResult['status'] === 'error') {
                    $this->error("Une erreur est survenue lors de l'upload de l'image");
                }
                if($old_media) {
                    model('MediaModel')->deleteMedia($old_media[0]['id']);
                }
            }
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

    public function getautocompletecity() {
        $searchValue = $this->request->getGet('q'); // Récupère le terme de recherche envoyé par Select2

        // Appelle la méthode de recherche dans le modèle
        $cities = model('CityModel')->searchCitiesByName($searchValue);

        // Formatage des résultats pour Select2
        $results = [];
        foreach ($cities as $city) {
            $results[] = [
                'id' => $city['id'],  // Utilise le slug comme ID pour redirection ultérieure
                'text' => $city['label'] . " - " . $city['zip_code'] // Ce texte sera affiché dans le dropdown de Select2
            ];
        }

        // Retourne les résultats sous forme JSON pour Select2
        return $this->response->setJSON($results);
    }
}
