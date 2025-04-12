<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Legal extends Controller
{
    public function privacy()
    {
        $data = [
            'title' => 'Privacy Policy'
        ];
        return view('legal/privacy', $data);
    }

    public function terms()
    {
        $data = [
            'title' => 'Terms & Conditions'
        ];
        return view('legal/terms', $data);
    }
} 