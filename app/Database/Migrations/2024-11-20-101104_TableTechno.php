<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableTechno extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('techno');
    }

    public function down()
    {
        $this->forge->dropTable('techno');
    }
}
