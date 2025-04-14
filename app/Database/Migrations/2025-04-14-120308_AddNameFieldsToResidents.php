<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNameFieldsToResidents extends Migration
{
    public function up()
    {
        $fields = [
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'full_name'
            ],
            'middle_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'first_name'
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'middle_name'
            ],
        ];
        
        $this->forge->addColumn('residents', $fields);
    }

    public function down()
    {
        // Drop the columns if we need to roll back
        $this->forge->dropColumn('residents', ['first_name', 'middle_name', 'last_name']);
    }
}
