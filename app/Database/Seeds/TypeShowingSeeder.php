<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TypeShowingSeeder extends Seeder
{
    public function run()
    {
        $typeShowing = [
            ['name'=> 'Régulière'],
            ['name'=> 'Avant-première']
        ];
        $this->db->table('type_showing')->insertBatch($typeShowing);
    }
}
