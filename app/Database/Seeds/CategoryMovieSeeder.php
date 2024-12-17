<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoryMovieSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect(); // Connexion à la base de données
        $builder = $db->table('category_movie'); // Table à remplir

        // Définition des IDs pour les films et les catégories
        $movieIds = range(1, 82); // Films de 1 à 82
        $categoryIds = range(1, 11); // Catégories de 1 à 11

        // Parcourir chaque film
        foreach ($movieIds as $movieId) {
            // Déterminer aléatoirement entre 1 et 2 catégories
            $numberOfCategories = rand(1, 2);

            // Sélectionner des catégories aléatoires sans doublons
            $randomCategories = array_rand(array_flip($categoryIds), $numberOfCategories);

            // Assurer que $randomCategories est un tableau même si une seule catégorie
            if (!is_array($randomCategories)) {
                $randomCategories = [$randomCategories];
            }

            // Insérer chaque relation film-catégorie dans la table
            foreach ($randomCategories as $categoryId) {
                $data = [
                    'movie_id' => $movieId,
                    'category_id' => $categoryId,
                ];

                $builder->insert($data);
            }
        }
    }
}
