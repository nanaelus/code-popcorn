<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $require_auth = false;
    public function index(): string
    {
        $movies = model('MovieModel')->getAllMovies();
        return $this->view('movie/index', ['movies' => $movies]);
    }

    public function getforbidden() : string
    {
        return view('/templates/forbidden');
    }
}
