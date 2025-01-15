<?php

namespace App\Models;

use CodeIgniter\Model;

class MovieModel extends Model
{
    protected $table            = 'movie';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'release', 'duration', 'description', 'slug', 'category_id', 'rating', 'created_at', 'updated_at', 'deleted_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;


    public function getMovieById($id) {
        $this->select('movie.*, media.file_path as preview_url');
        $this->join('media', 'movie.id = media.entity_id AND media.entity_type = "movie"', 'left');
        return $this->find($id);
    }

    public function getPaginated($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        $builder->select('movie.*, media.file_path as preview_url');
        $builder->join('media', 'movie.id = media.entity_id AND media.entity_type = "movie"', 'left');
        // Recherche
        if ($searchValue != null) {
            $builder->like('title', $searchValue);
            $builder->orLike('release', $searchValue);
            $builder->orLike('movie.id', $searchValue);
            $builder->orLike('rating', $searchValue);
            $builder->orLike('description', $searchValue);
        }

        // Tri
        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        $builder->limit($length, $start);

        return $builder->get()->getResultArray();
    }

    public function getTotal()
    {
        $builder = $this->builder();
        $builder->select('movie.*, media.file_path as preview_url');
        $builder->join('media', 'movie.id = media.entity_id AND media.entity_type = "movie"', 'left');
        return $builder->countAllResults();
    }

    public function getFiltered($searchValue)
    {
        $builder = $this->builder();
        $builder->select('movie.*, media.file_path as preview_url');
        $builder->join('media', 'movie.id = media.entity_id AND media.entity_type = "movie"', 'left');
        if (!empty($searchValue)) {
            $builder->like('title', $searchValue);
            $builder->orLike('release', $searchValue);
            $builder->orLike('movie.id', $searchValue);
            $builder->orLike('rating', $searchValue);
            $builder->orLike('description', $searchValue);
        }

        return $builder->countAllResults();
    }

    public function createMovie($data) {
        $data['slug'] = $this->generateUniqueSlug($data['title']);
        return $this->insert($data);
    }

    public function updateMovie($id, $data) {
        if (isset($data['title'])) {
            $data['slug'] = $this->generateUniqueSlug($data['title'],$id);
        }
        return $this->update($id, $data);
    }

    public function deleteMovie($id) {
        return $this->delete($id);
    }

    public function activateMovie($id) {
        return $this->update($id, ['deleted_at' => null]);
    }

    public function getAllMovies() {
        $builder = $this->builder();
        $builder->select('movie.*, media.file_path as preview_url');
        $builder->join('media', 'movie.id = media.entity_id AND media.entity_type = "movie"', 'left');
        return $this->findAll();
    }

    public function getMovieBySlug($slug) {
        $builder = $this->builder();
        $builder->select('movie.*, media.file_path as preview_url');
        $builder->join('media', 'movie.id = media.entity_id AND media.entity_type = "movie"', 'left');
        $builder->where('slug', $slug);
        return $builder->get()->getRowArray();
    }

    private function generateUniqueSlug($name)
    {
        $slug = generateSlug($name);
        $builder = $this->builder();
        $count = $builder->where('slug', $slug)->countAllResults();
        if ($count === 0) {
            return $slug;
        }
        $i = 1;
        while ($count > 0) {
            $newSlug = $slug . '-' . $i;
            $count = $builder->where('slug', $newSlug)->countAllResults();
            $i++;
        }
        return $newSlug;
    }

    public function getAllMoviesFiltered($data, $deleted = null, $perPage = 8) {
        $this->select('movie.id, movie.title, movie.slug, showing.date, media.file_path as preview_url');
        $this->join('media', 'media.entity_id = movie.id AND entity_type = "movie"', 'left');
        $this->join('showing', 'showing.movie_id = movie.id');
        foreach ($data as $filter =>$slug) {
            switch($filter) {
                case 'rating':
                    $this->where('movie.rating', $slug);
                    break;
                case 'version':
                    $this->where('showing.version', $slug);
                    break;
                case 'category':
                    $this->join('category_movie', 'movie.id = category_movie.movie_id');
                    $this->join('category', 'category.id = category_movie.category_id', 'left');
                    $this->where('category.slug', $slug);
                    break;
            }
        }
        $this->where('movie.deleted_at', $deleted)->where('showing.date >= NOW()');
        $this->distinct();

        return $this->paginate($perPage);
    }

    public function searchMoviesByName($searchValue, $limit = 10) {
        // On effectue la requête sur la base de données
        $builder = $this->db->table('movie');
        $builder->like('title', $searchValue); // On recherche les villes dont le nom contient $searchValue
        $builder->orLike('release', $searchValue); // On recherche les villes dont le nom contient $searchValue
        $query = $builder->get();
        return $query->getResultArray(); // Retourne les résultats sous forme de tableau
    }
}
