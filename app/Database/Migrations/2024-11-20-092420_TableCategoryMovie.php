<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableCategoryMovie extends Migration
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
        $this->forge->createTable('category_movie');
    }

    public function down()
    {
        $this->forge->dropTable('category_movie');
    }
}
