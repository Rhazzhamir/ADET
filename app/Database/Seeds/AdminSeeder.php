<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'first_name' => 'Admin',
            'last_name' => 'Account',
            'email' => 'admin@barangay.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'account_type' => 'admin',
            'is_active' => 1,
            'created_at' => Time::now(),
            'updated_at' => Time::now()
        ];

        $this->db->table('users')->insert($data);
    }
} 