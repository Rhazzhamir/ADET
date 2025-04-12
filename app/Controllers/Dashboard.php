<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('dashboard/index');
    }

    public function resident()
    {
        // This is just a placeholder for now
        // In the future, we'll add authentication and data loading here
        
        return view('dashboard/resident');
    }
} 