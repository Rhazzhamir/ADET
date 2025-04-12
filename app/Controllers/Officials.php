<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Officials extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'All Officials'
        ];
        return view('officials/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add New Official'
        ];
        return view('officials/add', $data);
    }

    public function save()
    {
        // For now, just redirect back to the officials list
        // We'll implement the actual saving logic later
        return redirect()->to('officials');
    }

    public function positions()
    {
        $data = [
            'title' => 'Official Positions'
        ];
        return view('officials/positions', $data);
    }
} 