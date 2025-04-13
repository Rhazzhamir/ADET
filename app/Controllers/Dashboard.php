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
        // Check if user is logged in
        if (!session()->get('is_logged_in') || session()->get('user_type') !== 'resident') {
            return redirect()->to(base_url('auth/resident/login'));
        }

        // Get resident data
        $residentModel = new \App\Models\ResidentModel();
        $resident = $residentModel->find(session()->get('resident_id'));

        if (!$resident) {
            session()->setFlashdata('error', 'Resident data not found');
            return redirect()->to(base_url('resident/dashboard'));
        }

        $data = [
            'title' => 'My Profile',
            'active_menu' => 'profile',
            'resident' => $resident
        ];
        
        return view('dashboard/profile', $data);
    }

    public function household()
    {
        // Redirect to profile page since household info is now part of the profile
        return redirect()->to(base_url('dashboard/profile'));
    }
} 