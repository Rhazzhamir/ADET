<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImageToOfficials_2024_04_19_000002 extends Migration
{
    public function up()
    {
        $this->forge->addColumn('officials', [
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'address'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('officials', 'image');
    }
} 