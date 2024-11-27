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
            'movie_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('category_movie');
        $this->forge->addForeignKey('movie_id', 'movie', 'id');
        $this->forge->addForeignKey('category_id', 'category', 'id');
    }

    public function down()
    {
        $this->forge->dropTable('category_movie');
    }
}
