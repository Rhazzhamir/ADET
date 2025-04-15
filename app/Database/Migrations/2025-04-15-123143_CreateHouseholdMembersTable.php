<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHouseholdMembersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'household_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'full_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'relationship' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true, // Can be null if not specified
            ],
            'age' => [
                'type'       => 'INT',
                'constraint' => 3,
                'unsigned'   => true,
                'null'       => true, // Can be null if not specified
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('household_id', 'households', 'id', 'CASCADE', 'CASCADE'); // Link members to a household
        $this->forge->createTable('household_members');
    }

    public function down()
    {
        $this->forge->dropTable('household_members');
    }
}
