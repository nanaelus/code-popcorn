<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Movie extends BaseController
{
    protected $require_auth = false;
    public function getindex($slug = null)
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
            $showings = model('ShowingModel')->getShowingByMovieSlug($slug);
            return $this->view('movie/movie', ['movie' => $movie, 'showings' => $showings]);
        } else {
            $this->error('Pas de film correspondant');
            $this->redirect('movie');
        }
    }

    public function getautocompletecity() {
        $searchValue = $this->request->getGet('q'); // Récupère le terme de recherche envoyé par Select2

        // Appelle la méthode de recherche dans le modèle
        $movies = model('MovieModel')->searchMoviesByName($searchValue);

        // Formatage des résultats pour Select2
        $results = [];
        foreach ($movies as $movie) {
            $date = strtotime($movie['release']);
            $results[] = [
                'id' => $movie['slug'],  // Utilise le slug comme ID pour redirection ultérieure
                'text' => $movie['title'] . " - " . date('Y',$date), // Ce texte sera affiché dans le dropdown de Select2
            ];
        }

        // Retourne les résultats sous forme JSON pour Select2
        return $this->response->setJSON($results);
    }
}
