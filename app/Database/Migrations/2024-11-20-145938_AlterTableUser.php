<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableUser extends Migration
{
    public function up()
    {
        $this->forge->addColumn('user',[
            'firstname' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'username'
            ],
            'lastname' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'firstname'
            ],
            'address' => [
                'type' => 'TEXT',
                'after' => 'lastname'
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '25',
                'after' => 'address'
            ],
            'dob' => [
                'type' => 'DATE',
                'after' => 'phone'
            ],
            'city_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
                'after' => 'dob'
            ]
        ]);
        $this->forge->addForeignKey('city_id', 'city', 'id');
    }

    public function down()
    {
        $this->forge->dropColumn('user', 'firstname');
        $this->forge->dropColumn('user', 'lastname');
        $this->forge->dropColumn('user', 'address');
        $this->forge->dropColumn('user', 'phone');
        $this->forge->dropColumn('user', 'dob');
        $this->forge->dropColumn('user', 'city_id');
    }
}
