<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class CinemaSessionSeeder extends Seeder
{
    public function run()
    {
        // Données de base
        $movies = range(1, 82); // movie_id entre 1 et 82
        $auditoriums = range(1, 100); // auditorium_id entre 1 et 100
        $typesShow = range(1, 2); // type_show_id entre 1 et 2
        $priceIds = range(1, 2); // price_id entre 1 et 2
        $versions = ['VF', 'VOSTFR', 'VFSTFR', 'Audiodescription']; // versions possibles

        // Créer 30 séances
        for ($i = 0; $i < 30; $i++) {
            $data = [
                'date' => Time::now()->addMinutes(rand(1, 1000))->toDateTimeString(), // Date aléatoire dans le futur
                'description' => 'Séance ' . ($i + 1) . ' description', // Description
                'movie_id' => $movies[array_rand($movies)], // movie_id aléatoire entre 1 et 82
                'auditorium_id' => $auditoriums[array_rand($auditoriums)], // auditorium_id aléatoire entre 1 et 100
                'capacity' => rand(50, 300), // Capacité aléatoire entre 50 et 300
                'type_show_id' => $typesShow[array_rand($typesShow)], // type_show_id aléatoire entre 1 et 2
                'version' => $versions[array_rand($versions)], // version aléatoire parmi les versions
                'price_id' => $priceIds[array_rand($priceIds)], // price_id aléatoire entre 1 et 2
            ];

            // Insertion des données
            $this->db->table('showing')->insert($data);
        }
    }
}
