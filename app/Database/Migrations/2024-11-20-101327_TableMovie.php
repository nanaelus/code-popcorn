<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableMovie extends Migration
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
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'release' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'duration' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'rating' => [
                'type' => 'ENUM',
                'constraint' => ['Tous Publics', '-12 ans', '-16 ans', '-18 ans'],
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'category_movie', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('movie');
    }

    public function down()
    {
        $this->forge->dropTable('movie');
    }
}