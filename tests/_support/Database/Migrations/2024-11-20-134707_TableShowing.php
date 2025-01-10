<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableShowing extends Migration
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
            'date' => [
                'type' => 'DATETIME',
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'movie_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'auditorium_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'capacity' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'type_show_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'version' => [
                'type' => 'ENUM',
                'constraint' => ['VF', 'VOSTFR', 'VFSTFR', 'Audiodescription'],
            ],
            'price_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('movie_id', 'movie', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('auditorium_id', 'auditorium', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('type_show_id', 'type_showing', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('price_id', 'price', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('showing');
    }

    public function down()
    {
        $this->forge->dropTable('showing');
    }
}
