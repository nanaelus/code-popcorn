<?php

namespace App\Models;

use CodeIgniter\Model;

class TheaterModel extends Model
{
    protected $table            = 'theater';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'address', 'phone', 'email', 'city_id'];

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

    public function getAllTheaters($limit = null, $offset = 0) {
        $this->select('theater.*, media.file_path as preview_url');
        $this->join('media', 'theater.id= media.entity_id AND media.entity_type = "theater"', 'left');
        return $this->findAll($limit, $offset);
    }

    public function createTheater($data) {
        return $this->insert($data);
    }

    public function updateTheater($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteTheater($id) {
        return $this->delete($id);
    }

    public function activateTheater($id) {
        $builder = $this->builder();
        $builder->set('deleted_at', NULL);
        $builder->where('id', $id);
        return $builder->update();
    }

    public function getTheaterById($id) {
        $builder = $this->builder();
        $builder->select('theater.*, city.label as city_name, media.file_path as preview_url');
        $builder->join('media', 'theater.id= media.entity_id AND media.entity_type = "theater"', 'left');
        $builder->join('city', 'city.id = theater.city_id');
        $builder->where('theater.id', $id);
        return $builder->get()->getRowArray();
    }

    public function getAllActiveTheater($limit = null, $offset = 0) {
        $this->select('theater.*, city.label as city_name, media.file_path as preview_url');
        $this->join('media', 'theater.id= media.entity_id AND media.entity_type = "theater"', 'left');
        $this->join('city', 'city.id = theater.city_id');
        $this->where('deleted_at', null);
        return $this->get()->getResultArray($limit, $offset);
    }

    public function getPaginated($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        $builder->select('theater.*, city.label as city_name');
        $builder->join('city', 'city.id = theater.city_id', "left");
        // Recherche
        if ($searchValue != null) {
            $builder->like('name', $searchValue);
            $builder->orLike('city.label', $searchValue);
            $builder->orLike('theater.id', $searchValue);
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
        $builder->join('city', 'city.id = theater.city_id', "left");
        return $builder->countAllResults();
    }

    public function getFiltered($searchValue)
    {
        $this->select('theater.id, theater.name, theater.phone, theater.email, city.label as city_name');
        $this->join('city', 'city.id = theater.city_id', "left");
        if (!empty($searchValue)) {
            $this->like('name', $searchValue);
            $this->orLike('city.label', $searchValue);
            $this->orLike('theater.id', $searchValue);
        }
        return $this->countAllResults();
    }
}
