<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeShowingModel extends Model
{
    protected $table            = 'type_showing';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

   public function getAllTypeShowing() {
       return $this->findAll();
   }

    public function getPaginated($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        $builder->select('type_showing.*');
        // Recherche
        if ($searchValue != null) {
            $builder->like('id', $searchValue);
            $builder->orLike('name', $searchValue);
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
        $builder->select('type_showing.*');
        return $builder->countAllResults();
    }

    public function getFiltered($searchValue)
    {
        $builder = $this->builder();
        $builder->select('type_showing.*');
        if (!empty($searchValue)) {
            $builder->like('id', $searchValue);
            $builder->orLike('name', $searchValue);
        }
        return $builder->countAllResults();
    }

    public function createTypeShowing($data) {
       return $this->insert($data);
    }

    public function updateTypeShowing($id, $data) {
       return $this->update($id, $data);
    }

    public function deleteTypeShowing($id) {
       return $this->delete($id);
    }
}
