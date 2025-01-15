<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TablePayment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' =>[
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'date' => [
                'type' => 'DATETIME',
            ],
            'method' => [
                'type' => 'ENUM',
                'constraint' => ['Espèce', 'Chèque', 'Carte Bleue', 'Contremarque']
            ],
            'ticket_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('ticket_id', 'ticket', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payment');
    }

    public function down()
    {
        $this->forge->dropTable('payment');
    }
}
