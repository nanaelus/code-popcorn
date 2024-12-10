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

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

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
}
