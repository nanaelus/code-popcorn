<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Showing extends BaseController
{
    public function getindex($id = null)
    {
        if($id == null) {
            return $this->view('admin/showing/index',[], true);
        }
        $movies = model('MovieModel')->getAllMovies();
        $allShowingType = model('TypeShowingModel')->getAllTypeShowing();
        $theaters = model('TheaterModel')->getAllTheaters();

        $prices = model('PriceModel')->getAllPrices();
        if($id == 'new' && isset($this->session->theater['id'])) {
            $auditoriums = model('AuditoriumModel')->getAuditoriumByTheaterId($this->session->theater['id']);
            return $this->view('admin/showing/showing', ['movies' => $movies, 'allShowingType' => $allShowingType, 'theaters' => $theaters, 'auditoriums' =>$auditoriums, 'prices' => $prices], true);
        } else {
            $this->error('Pas de cinéma sélectionné');
            $this->redirect('/admin/showing');
        }
        if($id) {
            $showing = model('ShowingModel')->getShowingById($id);
            if($showing) {
                return $this->view('admin/showing/showing', ['showing' => $showing, 'movies' => $movies], true);
            } else {
                $this->error('Aucune séance ne correspond à l\'id');
                $this->redirect('/admin/showing');
            }
        }
    }

    public function postcreate() {
        $data = $this->request->getPost();
        if(model('ShowingModel')->createShowing($data)) {
            $this->success('Séance Ajoutée');
        } else {
            $this->error('Une erreur est survenue lors de l\'ajout de la séance');
        }
        $this->redirect('/admin/showing');
    }
}
