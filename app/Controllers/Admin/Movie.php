<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Movie extends BaseController
{
    public function getindex($id = null)
    {
        if($id == null) {
            return $this->view('/movie/index', [],true);
        }
        if($id == "new") {
            return $this->view('/movie/movie', [],true);
        }
        if($id) {
            $movie = model('MovieModel')->getMovieById($id);
            if($movie) {
                return $this->view('/movie/movie', [],true);
            } else {
                $this->error('Aucun film correspondant à cet ID');
                $this->redirect('/admin/movie');
            }
        }
    }

    public function getdeactivate($id){
        $um = Model('MovieModel');
        if ($um->deleteMovie($id)) {
            $this->success("Film maintenant Indisponible");
        } else {
            $this->error("Erreur lors de la mise à jour");
        }
        $this->redirect('/admin/movie');
    }

    public function getactivate($id){
        $um = Model('MovieModel');
        if ($um->activateMovie($id)) {
            $this->success("Film maintenant Disponible");
        } else {
            $this->error("Erreur lors de la mise à jour");
        }
        $this->redirect('/admin/movie');
    }
}
