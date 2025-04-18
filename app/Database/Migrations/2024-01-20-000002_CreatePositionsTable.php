<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePositionsTable extends Migration
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
            'position_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],
            'description' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'max_officials' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
            ],
            'hierarchy_level' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
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
        $this->forge->createTable('positions');

        // Insert default positions
        $defaultPositions = [
            [
                'position_name' => 'Barangay Captain',
                'description' => 'The head of the barangay government',
                'max_officials' => 1,
                'hierarchy_level' => 1,
            ],
            [
                'position_name' => 'Barangay Secretary',
                'description' => 'Manages barangay records and documentation',
                'max_officials' => 1,
                'hierarchy_level' => 2,
            ],
            [
                'position_name' => 'Barangay Treasurer',
                'description' => 'Manages barangay finances and budget',
                'max_officials' => 1,
                'hierarchy_level' => 2,
            ],
            [
                'position_name' => 'SK Chairperson',
                'description' => 'Head of the Sangguniang Kabataan, representing the youth sector',
                'max_officials' => 1,
                'hierarchy_level' => 2,
            ],
            [
                'position_name' => 'Barangay Kagawad',
                'description' => 'Member of the Sangguniang Barangay',
                'max_officials' => 7,
                'hierarchy_level' => 3,
            ],
            [
                'position_name' => 'Barangay Councilor',
                'description' => 'Member of the barangay council',
                'max_officials' => 7,
                'hierarchy_level' => 3,
            ],
        ];

        $db = \Config\Database::connect();
        foreach ($defaultPositions as $position) {
            $position['created_at'] = date('Y-m-d H:i:s');
            $position['updated_at'] = date('Y-m-d H:i:s');
            $db->table('positions')->insert($position);
        }
    }

    public function down()
    {
        $this->forge->dropTable('positions');
    }
} 