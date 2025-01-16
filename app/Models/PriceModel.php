<?php

namespace App\Models;

use CodeIgniter\Model;

class PriceModel extends Model
{
    protected $table            = 'price';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'amount'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    public function getAllPrices() {
        return $this->findAll();
    }

    public function createPrice($data) {
        return $this->insert($data);
    }

    public function updatePrice($id, $data) {
        return $this->update($id, $data);
    }

    public function getPaginated($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        $builder->select('price.*');
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
        $builder->select('price.*');
        return $builder->countAllResults();
    }

    public function getFiltered($searchValue)
    {
        $builder = $this->builder();
        $builder->select('price.*');
        if (!empty($searchValue)) {
            $builder->like('id', $searchValue);
            $builder->orLike('name', $searchValue);
        }
        return $builder->countAllResults();
    }
}
