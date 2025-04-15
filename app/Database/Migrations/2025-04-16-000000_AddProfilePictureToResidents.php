<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProfilePictureToResidents extends Migration
{
    public function up()
    {
        $this->forge->addColumn('residents', [
            'profile_picture' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'nationality'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('residents', 'profile_picture');
    }
} 