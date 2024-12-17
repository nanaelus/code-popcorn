<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableCategory extends Migration
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
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('category');
        $data = [
            'name' => 'Aucune',
            'slug' => 'aucune',
        ];
        $this->db->table('category')->insert($data);
    }

    public function down()
    {
        $this->forge->dropTable('category');
    }
}
