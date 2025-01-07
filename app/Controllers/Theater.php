<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Theater extends BaseController
{
    protected $require_auth = false;
    protected $title = "Nos Cinémas";
    public function getindex($slug = null)
    {
        if($slug == null) {
            $this->redirect('theater/tout-nos-cinemas');
        }
        if($slug == "tout-nos-cinemas") {
            $theaters = model('TheaterModel')->getAllTheaters(6);
            return $this->view('theater/index', ['theaters' => $theaters]);
        }
        if($slug) {
            $theater = model('TheaterModel')->getTheaterBySlug($slug);
            $this->title = $theater['name'];
            if($theater) {
                $showing = model('ShowingModel')->getShowingByTheaterId($theater['id']);
            return $this->view('theater/theater', ['theater' => $theater, 'showing' => $showing]);
            } else {
                $this->error('Mauvaise pioche');
                $this->redirect('theater/tout-nos-cinemas');
            }
        }
    }

    public function posttheater() {
        $theaterId = $this->request->getPost('theater_id');
        $theater = model('TheaterModel')->getTheaterById($theaterId);
        if($theater){
        $this->session->set('theater', $theater);
        $this->redirect('theater/'. $theater['slug']);
        } else {
            $this->redirect('theater');
        }
    }

    //Fonction permettant de mettre les infos d'un cinéma en session pour les réutiliser partout
    public function getajaxloadmore(){
        $limit = $this->request->getGet('limit');
        $offset = $this->request->getGet('offset');
        return json_encode(model('TheaterModel')->getAllTheaters($limit,$offset));
    }

    public function getautocompletetheater() {
        $searchValue = $this->request->getGet('q'); // Récupère le terme de recherche envoyé par Select2

        // Appelle la méthode de recherche dans le modèle
        $theaters = model('TheaterModel')->searchTheatersByName($searchValue);

        // Formatage des résultats pour Select2
        $results = [];
        foreach ($theaters as $theater) {
            $results[] = [
                'id' => $theater['slug'],  // Utilise le slug comme ID pour redirection ultérieure
                'text' => $theater['name'], // Ce texte sera affiché dans le dropdown de Select2
            ];
        }

        // Retourne les résultats sous forme JSON pour Select2
        return $this->response->setJSON($results);
    }
}
