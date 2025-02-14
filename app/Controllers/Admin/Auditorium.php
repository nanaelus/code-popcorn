<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auditorium extends BaseController
{
    protected $require_auth = true;
    protected $requiredPermissions = ['administrateur'];
    protected $breadcrumb =  [['text' => 'Tableau de Bord','url' => '/admin/dashboard'], ['text' => 'Gestion des Salles', 'url' => '']];
    protected $title = 'Gestion des Salles';
    public function getindex($id = null)
    {
        if ($id == null) {
            return $this->view('admin/theater/auditorium/index.php',[], true);
        }
        $allTheater = model('TheaterModel')->getAllTheaters();
        if ($id == "new") {
            $this->breadcrumb =  [['text' => 'Tableau de Bord','url' => '/admin/dashboard'], ['text' => 'Gestion des Salles', 'url' => '/admin/auditorium'],['text' => 'Nouvelle Salle', 'url' => '']];
            $this->title = "Création de Salle";
            return $this->view('admin/theater/auditorium/auditorium.php',['allTheater' => $allTheater], true);
        }
        $auditorium = model('AuditoriumModel')->getAuditoriumById($id);
        if($auditorium){
            $this->breadcrumb = [['text' => 'Tableau de bord', 'url' => '/admin/dashboard'], ['text' => 'Gestion des Salles', 'url' => '/admin/auditorium'],['text' => 'Edition de la Salle', 'url' => '']];
            $this->title = "Edition de la Salle : " . $auditorium['name'];
            return $this->view('admin/theater/auditorium/auditorium.php',['auditorium' => $auditorium, 'allTheater' => $allTheater], true);
        } else {
            $this->error('Cette salle n\'existe pas');
            $this->redirect('admin/auditorium');
        }
    }

    public function postcreate() {
        $data = $this->request->getPost();
        if(model('AuditoriumModel')->createAuditorium($data)) {
            $this->success('Salle créée avec succès');
        } else {
            $this->error('Erreur lors de la création de la salle');
        }
        $this->redirect('admin/auditorium');
    }

    public function postupdate() {
        $data = $this->request->getPost();
        if(model('AuditoriumModel')->updateAuditorium($data['id'], $data)) {
            $this->success('Salle mise à jour avec succès');
        } else {
            $this->error('Erreur lors de la mise à jour de la salle');
        }
        $this->redirect('admin/auditorium');
    }

    public function getdeactivate($id){
        $um = Model('AuditoriumModel');
        if ($um->deleteAuditorium($id)) {
            $this->success("Salle désactivée");
        } else {
            $this->error("Salle non désactivée");
        }
        $this->redirect('admin/auditorium');
    }

    public function getactivate($id){
        $um = Model('AuditoriumModel');
        if ($um->activateAuditorium($id)) {
            $this->success("Salle activée");
        } else {
            $this->error("Salle non activée");
        }
        $this->redirect('admin/auditorium');
    }
}