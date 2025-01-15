<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'category';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name','slug'];

    public function createCategory($data) {
        $data['slug'] = $this->generateUniqueSlug($data['name']);
        return $this->insert($data);
    }

    public function updateCategory($id,$data) {
        $data['slug'] = $this->generateUniqueSlug($data['name']);
        return $this->update($id, $data);
    }

    public function deleteCategory($id) {
        return $this->delete($id);
    }

    public function getAllCategories() {
        return $this->findAll();
    }

    public function getCategoryByID($id) {
        return $this->find($id);
    }

    public function getPaginated($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        // Recherche
        if ($searchValue != null) {
            $builder->like('id', $searchValue);
            $builder->orLike('name', $searchValue);
            $builder->orLike('slug', $searchValue);
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
        return $builder->countAllResults();
    }

    public function getFiltered($searchValue)
    {
        $builder = $this->builder();
        $builder->select('movie.*, media.file_path as preview_url');

        if (!empty($searchValue)) {
            $builder->like('id', $searchValue);
            $builder->orLike('name', $searchValue);
            $builder->orLike('slug', $searchValue);

        }

        return $this->countAllResults();
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
