<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableTheater extends Migration
{
    public function up()
    {
        $this->forge->addColumn('theater', [
           'created_at' => [
               'type' => 'datetime',

           ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'datetime',
                'null' => true,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('theater', 'created_at');
        $this->forge->dropColumn('theater', 'updated_at');
        $this->forge->dropColumn('theater', 'deleted_at');
    }
}
