<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Appel de tous les seeders nécessaires pour les tests ou la base de données
        $this->call('MovieSeeder');
        $this->call('CitySeeder');
        $this->call('CinemaSeeder');
        $this->call('AuditoriumSeeder');
        $this->call('CategorySeeder');
        $this->call('PriceSeeder');
        $this->call('TypeShowingSeeder');
        $this->call('CinemaSessionSeeder');
        $this->call('UserSeeder');
        $this->call('CategoryMovieSeeder');
    }
}