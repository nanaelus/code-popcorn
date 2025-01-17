<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Theater extends BaseController
{
    protected $require_auth = true;
    protected $requiredPermissions = ['administrateur'];
    protected $breadcrumb =  [['text' => 'Tableau de Bord','url' => '/admin/dashboard'], ['text' => 'Gestion des Cinémas', 'url' => '']];
    protected $title = "Gestion des Cinémas";
    public function getindex($id = null )
    {
        if($id == null) {
            $allTheaters = model('TheaterModel')->getAllTheaters(12);
            return $this->view('admin/theater/index', ['allTheaters' => $allTheaters], true);
        }
        if($id == 'new') {
            $this->breadcrumb =  [['text' => 'Tableau de Bord','url' => '/admin/dashboard'], ['text' => 'Gestion des Cinémas', 'url' => '/admin/theater'],['text' => 'Nouveau Cinéma', 'url' => '']];
            $this->title = "Page de Création Cinéma";
            return $this->view('admin/theater/theater', [], true);
        }
        $cinema = model('TheaterModel')->getTheaterById($id);
        if($cinema) {
            $this->breadcrumb =  [['text' => 'Tableau de Bord','url' => '/admin/dashboard'], ['text' => 'Gestion des Cinémas', 'url' => '/admin/theater'],['text' => 'Edition d\'un Cinéma', 'url' => '']];
            $this->title = "Modification du Cinéma : " . $cinema['name'];
            $auditorium = model('AuditoriumModel')->getAllAuditorium();
            return $this->view('admin/theater/theater', ['cinema' => $cinema, 'auditorium' => $auditorium], true);
        } else {
            $this->error(' Aucun Cinéma associé');
            $this->redirect('admin/theater', [], true);
        }
    }

    public function postcreate() {
        $data = $this->request->getPost();
        $newTheaterId = model('TheaterModel')->createTheater($data);
        if($newTheaterId) {

            // Gestion des images
            $file = $this->request->getFile('theater_image');
            if($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                $mediaData = [
                    'entity_type' => 'theater',
                    'entity_id' => $newTheaterId,
                ];
                $uploadResult = upload_file($file, 'theater_preview', $data['name'], $mediaData, false, ['image/jpeg', 'image/png','image/jpg']);
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

            // Gestion des Images
            $file = $this->request->getFile('theater_image');
            if($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                $old_media = model('MediaModel')->getMediaByEntityIdAndType($data['id'], 'theater');
                $mediaData = [
                    'entity_type' => 'theater',
                    'entity_id' => $data['id'],
                ];
                $uploadResult = upload_file($file, 'theater_preview', $data['name'], $mediaData, false, ['image/jpeg', 'image/png','image/jpg']);
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

    public function posttheater() {
        $theaterId = $this->request->getPost('theater_id');
        $theater = model('TheaterModel')->getTheaterById($theaterId);
        $this->session->set('theater', $theater);

        // Récupérer l'URL de la page précédente
        $redirectUrl = $this->request->getServer('HTTP_REFERER') ?? '/';

        // Rediriger vers la page précédente ou vers la page d'accueil par défaut
        return $this->response->redirect($redirectUrl);
    }
}
