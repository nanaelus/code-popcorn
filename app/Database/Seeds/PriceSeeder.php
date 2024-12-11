<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PriceSeeder extends Seeder
{
    public function run()
    {
        $prices = [
            ['name' => 'Chômeur', 'amount' =>4.9],
            ['name' => 'Régulier', 'amount' =>8],
        ];
        $this->db->table('price')->insertBatch($prices);
    }
}
