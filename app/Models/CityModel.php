<?php

namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model
{
    protected $table            = 'city';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['zip_code', 'label', 'department_name', 'department_number', 'region_name'];

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

    public function getAllCities() {
        return $this->findAll();
    }

    public function getCityById($id) {
        return $this->find($id);
    }

    public function searchCitiesByName($searchValue, $limit = 10)
    {
        // On effectue la requête sur la base de données
        $builder = $this->db->table('city');
        $builder->like('label', $searchValue); // On recherche les villes dont le nom contient $searchValue
        $builder->orLike('zip_code', $searchValue); // On recherche les villes dont le nom contient $searchValue
        $query = $builder->get();

        return $query->getResultArray(); // Retourne les résultats sous forme de tableau
    }
}
