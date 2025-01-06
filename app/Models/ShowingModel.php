<?php

namespace App\Models;

use CodeIgniter\Model;

class ShowingModel extends Model
{
    protected $table            = 'showing';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['date', 'description', 'movie_id', 'auditorium_id', 'capacity', 'type_show_id', 'version', 'price_id'];

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

    public function getShowingByTheaterId($theater_id) {
        $builder = $this->builder();
        $builder->select('showing.*,t.name as theater_name, a.name as auditorium_name, movie.*, media.file_path as preview_url');
        $builder->join('auditorium a', 'a.id = showing.auditorium_id', 'inner');
        $builder->join('movie', 'showing.movie_id = movie.id', 'inner');
        $builder->join('media', 'movie.id = media.entity_id AND media.entity_type = "movie"', 'left');
        $builder->join('theater t', 't.id = a.theater_id', 'left');
        $builder->where('a.theater_id', $theater_id)->where('showing.date >= NOW()');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getShowingById($id) {
        return $this->find($id);
    }

    public function getAllShowing() {
        return $this->findAll();
    }

    public function createShowing($data) {
        return $this->insert($data);
    }
    public function getPaginated($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        $builder->select('showing.*, movie.title as movie_name, auditorium.name as auditorium_name, ts.name as type_name, price.name as categ_price, theater.name as theater_name');
        $builder->join('movie', 'movie.id = showing.movie_id');
        $builder->join('auditorium', 'auditorium.id = showing.auditorium_id');
        $builder->join('theater', 'theater.id = auditorium.theater_id');
        $builder->join('type_showing ts', 'ts.id = showing.type_show_id');
        $builder->join('price', 'price.id = showing.price_id');
        // Recherche
        if ($searchValue != null) {
            $builder->like('date', $searchValue);
            $builder->orLike('showing.id', $searchValue);
            $builder->orLike('showing.description', $searchValue);
            $builder->orLike('movie.title', $searchValue);
            $builder->orLike('theater.name', $searchValue);
            $builder->orLike('auditorium.name', $searchValue);
            $builder->orLike('ts.name', $searchValue);
            $builder->orLike('version', $searchValue);
            $builder->orLike('price.name', $searchValue);

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
        $builder->select('showing.*, movie.title as movie_name, auditorium.name as auditorium_name, ts.name as type_name, price.name as categ_price, theater.name as theater_name');
        $builder->join('movie', 'movie.id = showing.movie_id', 'left');
        $builder->join('auditorium', 'auditorium.id = showing.auditorium_id', 'left');
        $builder->join('theater', 'theater.id = auditorium.theater_id', 'left');
        $builder->join('type_showing ts', 'ts.id = showing.type_show_id', 'left');
        $builder->join('price', 'price.id = showing.price_id', 'left');
        return $builder->countAllResults();
    }

    public function getFiltered($searchValue)
    {
        $builder = $this->builder();
        $builder->select('showing.*, movie.title as movie_name, auditorium.name as auditorium_name, ts.name as type_name, price.name as categ_price, theater.name as theater_name');
        $builder->join('movie', 'movie.id = showing.movie_id', 'left');
        $builder->join('auditorium', 'auditorium.id = showing.auditorium_id', 'left');
        $builder->join('theater', 'theater.id = auditorium.theater_id', 'left');
        $builder->join('type_showing ts', 'ts.id = showing.type_show_id', 'left');
        $builder->join('price', 'price.id = showing.price_id', 'left');
        if (!empty($searchValue)) {
            $builder->like('date', $searchValue);
            $builder->orLike('showing.id', $searchValue);
            $builder->orLike('showing.description', $searchValue);
            $builder->orLike('movie.title', $searchValue);
            $builder->orLike('theater.name', $searchValue);
            $builder->orLike('auditorium.name', $searchValue);
            $builder->orLike('ts.name', $searchValue);
            $builder->orLike('version', $searchValue);
            $builder->orLike('price.name', $searchValue);

        }

        return $builder->countAllResults();
    }

    public function getShowingByMovieSlug($slug) {
        $builder = $this->builder();
        $builder->select('showing.date, showing.capacity, showing.version, theater.name as theater_name, theater.slug as theater_slug, theater.id as theater_id');
        $builder->join('movie', 'movie.id = showing.movie_id', 'left');
        $builder->join('auditorium', 'auditorium.id = showing.auditorium_id', 'left');
        $builder->join('theater', 'theater.id = auditorium.theater_id', 'left');
        return $builder->where('movie.slug', $slug)->where('showing.date >= NOW()')->orderBy('showing.date', 'ASC')->get()->getResultArray();
    }

    public function deleteShowing($id) {
        return $this->delete($id);
    }
}
