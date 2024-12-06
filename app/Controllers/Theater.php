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
            return $this->view('theater/theater', ['theater' => $theater]);
            } else {
                $this->error('Mauvaise pioche');
            }
            $this->redirect('theater');
        }
    }
}
