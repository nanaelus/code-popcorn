<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Theater extends BaseController
{
    protected $require_auth = false;
    public function getindex($id = null)
    {
        if($id == null) {
            $theaters = model('TheaterModel')->getAllActiveTheater();
            return $this->view('theater/index', ['theaters' => $theaters]);
        }
        if($id) {
            $theater = model('TheaterModel')->getTheaterById($id);
            if($theater) {
                $showing = model('ShowingModel')->getShowingByTheaterId($theater['id']);
            return $this->view('theater/theater', ['theater' => $theater, 'showing' => $showing]);
            } else {
                $this->error('Mauvaise pioche');
                $this->redirect('theater');
            }
        }
    }

    public function posttheater() {
        $theaterId = $this->request->getPost('theater_id');
        $theater = model('TheaterModel')->getTheaterById($theaterId);
        if($theater){
        $this->session->set('theater', $theater);
        $this->redirect('theater/'. $theater['id']);
        } else {
            $this->redirect('theater');
        }
    }
}
