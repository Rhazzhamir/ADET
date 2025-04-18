<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOfficialsTable extends Migration
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
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'position' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'contact' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
            ],
            'term_start' => [
                'type' => 'DATE',
            ],
            'term_end' => [
                'type' => 'DATE',
            ],
            'address' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'      => true,
            ],
            'photo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'      => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default'    => 'active',
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
        // Add foreign key-like index for position
        $this->forge->addKey('position');
        $this->forge->createTable('officials');
    }

    public function down()
    {
        $this->forge->dropTable('officials');
    }
} 