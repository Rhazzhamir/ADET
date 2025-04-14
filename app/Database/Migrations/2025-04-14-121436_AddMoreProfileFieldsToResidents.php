<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMoreProfileFieldsToResidents extends Migration
{
    public function up()
    {
        $fields = [
            'suffix' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'after' => 'last_name'
            ],
            'date_of_birth' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'suffix'
            ],
            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'after' => 'date_of_birth'
            ],
            'civil_status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'after' => 'gender'
            ],
            'nationality' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'civil_status'
            ]
        ];
        
        $this->forge->addColumn('residents', $fields);
    }

    public function down()
    {
        // Drop the columns if we need to roll back
        $this->forge->dropColumn('residents', [
            'suffix', 
            'date_of_birth', 
            'gender', 
            'civil_status', 
            'nationality'
        ]);
    }
}
