<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('dashboard/index');
    }

    public function residentDashboard()
    {
        $data = [
            'title' => 'Resident Dashboard',
            'active_menu' => 'dashboard'
        ];
        
        return view('dashboard/resident', $data);
    }

    public function profile()
    {
        // This is just a placeholder for now
        // In the future, we'll add authentication and data loading here
        
        return view('dashboard/profile');
    }

    public function household()
    {
        // Redirect to profile page since household info is now part of the profile
        return redirect()->to(base_url('dashboard/profile'));
    }
} 