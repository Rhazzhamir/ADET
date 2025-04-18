<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBudgetsTable extends Migration
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
            'year' => [
                'type'       => 'INT',
                'constraint' => 4,
            ],
            'amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
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
        $this->forge->createTable('budgets');
    }

    public function down()
    {
        $this->forge->dropTable('budgets');
    }
}
