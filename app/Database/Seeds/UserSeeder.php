<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Utiliser Faker pour générer des données aléatoires
        $faker = Factory::create();

        $data = [];

        // Générer 10 utilisateurs fictifs
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'username'      => $faker->userName,
                'firstname'     => $faker->firstName,
                'lastname'      => $faker->lastName,
                'phone'         => $faker->phoneNumber,
                'dob'           => $faker->date('Y-m-d', '-18 years'), // Date de naissance réaliste
                'email'         => $faker->unique()->safeEmail,
                'password'      => password_hash('password123', PASSWORD_DEFAULT), // Mot de passe sécurisé
                'id_permission' => $faker->numberBetween(1, 3), // ID Permission aléatoire entre 1 et 3
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
                'deleted_at'    => null,
            ];
        }

        // Insérer les données dans la table 'users'
        $this->db->table('user')->insertBatch($data);
    }
}
