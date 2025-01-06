<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $require_auth = false;
    public function index($slug = null): string
    {
        $categories = model('CategoryModel')->getAllCategories();
        if($slug == null) {
            $this->redirect('movie/a-l-affiche');
        }
        if($slug == "new") {
            return $this->view('movie/movie');
        }
        $movie = model('MovieModel')->getMovieBySlug($slug);
        if($movie) {
            return $this->view('movie/movie', ['movie' => $movie]);
        } else {
            $this->error('Pas de film correspondant');
            $this->redirect('');
        }
    }

    public function getforbidden() : string
    {
        return view('/templates/forbidden');
    }
}
