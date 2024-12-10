<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Movie extends BaseController
{
    protected $require_auth = false;
    public function getindex($slug = null)
    {
        if($slug == null) {
            $moviesShowing = model('MovieModel')->getAllMoviesShowing();
            $perPage = 8;
            $pager = model('MovieModel')->pager;
            return $this->view('movie/index', ['movies' => $moviesShowing, 'pager' => $pager]);
        }
        if($slug == "new") {
            return $this->view('movie/movie');
        }
        $movie = model('MovieModel')->getMovieBySlug($slug);
        if($movie) {
            return $this->view('movie/movie', ['movie' => $movie]);
        } else {
            $this->error('Pas de film correspondant');
            $this->redirect('movie');
        }
    }
}
