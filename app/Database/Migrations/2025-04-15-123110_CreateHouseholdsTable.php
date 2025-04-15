<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHouseholdsTable extends Migration
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
            'resident_id' => [ // Link to the resident who owns/registered this household
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'household_head' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true, // Allow null initially
            ],
            'house_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'ownership_status' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'number_of_rooms' => [
                'type'       => 'INT',
                'constraint' => 5,
                'null'       => true,
            ],
            'household_address' => [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->addForeignKey('resident_id', 'residents', 'id', 'CASCADE', 'CASCADE'); // Added foreign key constraint
        $this->forge->createTable('households');
    }

    public function down()
    {
        $this->forge->dropTable('households');
    }
}
