<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Showing extends BaseController
{
    protected $require_auth = true;
    protected $requiredPermissions = ['administrateur'];
    protected $breadcrumb =  [['text' => 'Tableau de Bord','url' => '/admin/dashboard'], ['text' => 'Gestion des Séances','url' => '']];
    protected $title = "Gestion des Séances";
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
            $this->breadcrumb =  [['text' => 'Tableau de Bord','url' => '/admin/dashboard'], ['text' => 'Gestion des Séances','url' => '/admin/showing'], ['text' => ' Ajout d\'une séance', 'url' => '']];
            $this->title = "Ajout d'une Séance";
            $auditoriums = model('AuditoriumModel')->getAuditoriumByTheaterId($this->session->theater['id']);
            return $this->view('admin/showing/showing', ['movies' => $movies, 'allShowingType' => $allShowingType, 'theaters' => $theaters, 'auditoriums' =>$auditoriums, 'prices' => $prices], true);
        } else {
            $this->error('何をこれ');
            $this->redirect('/admin/showing');
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

    public function getdelete($id) {
        if(model('ShowingModel')->deleteShowing($id)) {
            $this->success('Séance supprimée');
        } else {
            $this->error('Une erreur est survenue');
        }
        $this->redirect('/admin/showing');
    }

    public function gettypeshowing() {
        $allTypesShowing = model('TypeShowingModel')->getAllTypeShowing();
        return $this->view('admin/showing/typeshowing', ['allTypesShowing' => $allTypesShowing], true);
    }

    public function postcreatetypeshowing() {
        $data = $this->request->getPost();
        if(model('TypeShowingModel')->createTypeShowing($data)) {
            return $this->success('Type créé');
        } else {
            $this->error('Une erreur est survenue lors de la création du type');
        }
    }

    public function postupdatetypeshowing() {
        $data = $this->request->getPost();
        if(model('TypeShowingModel')->updateTypeShowing($data['id'], $data)) {
            $this->success('Type mise à jour');
        } else {
            $this->error('Une erreur est survenue lors de la mise à jour du type');
        }
        return json_encode($data);
    }

    public function getdeletetypeshowing($id) {
        if(model('TypeShowingModel')->deleteTypeShowing($id)) {
            $this->success('Type supprimé!');
        } else {
            $this->error('Une erreur est survenue lors de la suppression du type');
        }
        $this->redirect('/admin/showing/typeshowing');
    }

    public function getprice() {
        return $this->view('admin/price', ['prices' => model('PriceModel')->getAllPrices()], true);
    }

    public function postcreateprice() {
        $data = $this->request->getPost();
        if(model('PriceModel')->createPrice($data)) {
            $this->success('Tarif créé');
        } else {
            $this->error('Une erreur est survenue lors de la création du tarif');
        }
    }

    public function postupdateprice() {
        $data = $this->request->getPost();
        if(model('PriceModel')->updatePrice($data['id'], $data)) {
            $this->success('Tarif mise à jour');
        } else {
            $this->error('Erreur lors de la mise à jour du tarif');
        }
        return json_encode($data);
    }

    public function getdeleteprice($id) {
        if(model('PriceModel')->deletePrice($id)) {
            $this->success('Tarif supprimé avec succès');
        } else {
            $this->error('Une erreur est survenue lors de la suppression du tarif');
        }
        $this->redirect('/admin/showing/price');
    }
}
