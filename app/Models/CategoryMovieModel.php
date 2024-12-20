<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryMovieModel extends Model
{
    protected $table            = 'category_movie';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['movie_id', 'category_id'];
    public function insertMultipleCategories($data) {
        return $this->insertBatch($data);
    }

    public function getAllCategoryMovieByIdMovie($id_movie) {
        return $this->where('movie_id', $id_movie)->findAll();
    }

    public function deleteMultipleCategories($id_movie, array $id_categ) {
        foreach ($id_categ as $id) {
            if(!$this->where('movie_id', $id_movie)->where('category_id', $id)->delete()) {
                return false;
            }
        }
        return true;
    }

    public function getCategoriesByMovieSlug($slug) {
        $this->select('c.name, c.slug');
        $this->join('category c', 'c.id = category_movie.category_id');
        $this->join('movie m', 'm.id = category_movie.movie_id');
        $this->where('m.slug', $slug);
        return $this->findAll();
    }

    public function getAllCategoriesByIdMovie($id_movie) {
        return $this->where('movie_id', $id_movie)->findAll();
    }
}
