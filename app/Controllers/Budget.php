<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Budget extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Budget Overview'
        ];
        return view('budget/index', $data);
    }

    public function expenses()
    {
        $data = [
            'title' => 'Expenses'
        ];
        return view('budget/expenses', $data);
    }

    public function reports()
    {
        $data = [
            'title' => 'Budget Reports'
        ];
        return view('budget/reports', $data);
    }
} 