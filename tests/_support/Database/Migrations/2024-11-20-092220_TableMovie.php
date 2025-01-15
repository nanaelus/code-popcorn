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
                'type' => 'DATE',
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
                'unique'     => true,
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
                "null" => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('movie');

    }

    public function down()
    {
        $this->forge->dropTable('movie');
    }
}
