<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('fr_FR');
        $data = [];

        // Films spécifiques
        $specificMovies = [
            [
                'title'       => 'Harry Potter',
                'release'     => '2001-11-16',
                'duration'    => 152,
                'description' => 'Un jeune garçon découvre qu\'il est un sorcier et entre dans une école de magie.',
                'slug'        => 'harry-potter',
                'rating'      => 'Tous Publics',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'deleted_at'  => null,
            ],
            [
                'title'       => 'Ali G',
                'release'     => '2002-03-22',
                'duration'    => 85,
                'description' => 'Un jeune homme excentrique se retrouve mêlé à des affaires politiques malgré lui.',
                'slug'        => 'ali-g',
                'rating'      => '-16 ans',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'deleted_at'  => null,
            ],
            [
                'title'       => 'La Belle Verte',
                'release'     => '1996-09-18',
                'duration'    => 99,
                'description' => 'Une extraterrestre visite la Terre pour comprendre les humains.',
                'slug'        => 'la-belle-verte',
                'rating'      => 'Tous Publics',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'deleted_at'  => null,
            ],
        ];

        $data = array_merge($data, $specificMovies);

        // Générer les films restants
        $ratings = ['Tous Publics', '-12 ans', '-16 ans', '-18 ans'];

        for ($i = 0; $i < 147; $i++) {
            $title = $faker->catchPhrase;
            $data[] = [
                'title'       => $title,
                'release'     => $faker->date('Y-m-d', 'now'),
                'duration'    => random_int(60, 180), // Durée entre 1h et 3h
                'description' => $faker->paragraph,
                'slug'        => strtolower(str_replace(' ', '-', $title)),
                'rating'      => $ratings[array_rand($ratings)],
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'deleted_at'  => null,
            ];
        }

        // Insérer les films dans la table movie
        $this->db->table('movie')->insertBatch($data);
    }
}
