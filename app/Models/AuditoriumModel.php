<?php

namespace App\Models;

use CodeIgniter\Model;

class AuditoriumModel extends Model
{
    protected $table            = 'auditorium';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'capacity', 'theater_id', 'deleted_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $deletedField  = 'deleted_at';

    public function getAuditoriumById($id){
        $builder = $this->builder();
        $builder->select('*');
        $builder->where('id', $id);
        return $builder->get()->getRowArray();
    }

    public function getAuditoriumByTheaterId($theater_id){
        $builder = $this->builder();
        $builder->select('*');
        $builder->where('theater_id', $theater_id);
        return $builder->get()->getResultArray();
    }

    public function getAllAuditorium() {
        return $this->findAll();
    }

    public function createAuditorium($data) {
        return $this->insert($data);
    }

    public function updateAuditorium($id, $data) {
        return $this->update($id, $data);
    }

    public function activateAuditorium($id){
        $builder = $this->builder();
        $builder->set('deleted_at', NULL);
        $builder->where('id', $id);
        return $builder->update();
    }

    public function deleteAuditorium($id){
        return $this->delete($id);
    }
    public function getPaginated($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        $builder->select('auditorium.*, theater.name as theater_name');
        $builder->join('theater', 'theater.id = auditorium.theater_id', "left");
        // Recherche
        if ($searchValue != null) {
            $builder->like('name', $searchValue);
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
        $builder->select('auditorium.*, theater.name as theater_name');
        $builder->join('theater', 'theater.id = auditorium.theater_id', "left");
        return $builder->countAllResults();
    }

    public function getFiltered($searchValue)
    {
        $builder = $this->builder();
        $builder->select('auditorium.*, theater.name as theater_name');
        $builder->join('theater', 'theater.id = auditorium.theater_id', "left");
        if (!empty($searchValue)) {
            $builder->like('name', $searchValue);
        }

        return $builder->countAllResults();
    }
}
