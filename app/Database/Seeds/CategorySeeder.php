<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Données des catégories
        $categories = [
            ['name' => 'Action', 'slug' => 'action'],
            ['name' => 'Comédie', 'slug' => 'comedie'],
            ['name' => 'Drame', 'slug' => 'drame'],
            ['name' => 'Science-fiction', 'slug' => 'science-fiction'],
            ['name' => 'Horreur', 'slug' => 'horreur'],
            ['name' => 'Animation', 'slug' => 'animation'],
            ['name' => 'Romance', 'slug' => 'romance'],
            ['name' => 'Thriller', 'slug' => 'thriller'],
            ['name' => 'Aventure', 'slug' => 'aventure'],
            ['name' => 'Documentaire', 'slug' => 'documentaire'],
        ];
        $this->db->table('category')->insertBatch($categories);
    }
}
