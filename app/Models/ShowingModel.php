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
        $builder->select('showing.*');
        $builder->join('auditorium a', 'showing.auditorium_id = a.id', 'left');
        $builder->join('theater t', 't.id = a.theater_id', 'left');
        $builder->where('t.id', $theater_id);
        return $builder->get()->getResultArray();
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
        }

        return $builder->countAllResults();
    }
}
