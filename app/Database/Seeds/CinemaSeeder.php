<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CinemaSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('fr_FR');

        $data = [];
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'name'      => $faker->company . ' Cinéma',
                'address'   => $faker->address,
                'phone'     => $faker->phoneNumber,
                'email'     => $faker->companyEmail,
                'city_id'   => random_int(1, 35076),
                'deleted_at'=> null,
            ];
        }

        // Insert batch
        $this->db->table('theater')->insertBatch($data);
        $this->updateSlugs('theater');
    }
    private function updateSlugs($table)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        $results = $builder->get()->getResultArray();
        foreach ($results as $row) {
            $slug = $this->generateSlug($row['name']); // Utilisez la fonction du helper ou définie ici
            $builder->where('id', $row['id'])->update(['slug' => $slug]);
        }
    }

    private function generateSlug($string)
    {
        // Normaliser la chaîne pour enlever les accents
        $string = \Normalizer::normalize($string, \Normalizer::FORM_D);
        $string = preg_replace('/[\p{Mn}]/u', '', $string);

        // Convertir les caractères spéciaux en minuscules et les espaces en tirets
        $string = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));

        return $string;
    }
}