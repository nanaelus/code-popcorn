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
            $movies = model('MovieModel')->getAllMovies();
            return $this->view('movie/index', ['movies' => $movies]);
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
