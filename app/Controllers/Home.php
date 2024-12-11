<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $require_auth = false;
    public function index($slug = null): string
    {
        $categories = model('CategoryModel')->getAllCategories();
        if($slug == null) {
            $moviesShowing = model('MovieModel')->getAllMoviesShowing();
            $perPage = 8;
            $pager = model('MovieModel')->pager;
            return $this->view('movie/index', ['movies' => $moviesShowing, 'pager' => $pager, 'categories' => $categories]);
        }
        if($slug == "new") {
            return $this->view('movie/movie');
        }
        $movie = model('MovieModel')->getMovieBySlug($slug);
        if($movie) {
            return $this->view('movie/movie', ['movie' => $movie]);
        } else {
            $this->error('Pas de film correspondant');
            $this->redirect('home');
        }
    }

    public function getforbidden() : string
    {
        return view('/templates/forbidden');
    }
}
