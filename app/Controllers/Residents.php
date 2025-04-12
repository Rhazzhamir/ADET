<?php

namespace App\Controllers;

class Residents extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Residents',
            'active_menu' => 'residents'
        ];
        return view('residents/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add New Resident',
            'active_menu' => 'residents'
        ];
        return view('residents/add', $data);
    }

    public function households()
    {
        $data = [
            'title' => 'Households',
            'active_menu' => 'residents'
        ];
        return view('residents/households', $data);
    }

    public function save()
    {
        // Handle resident save logic here
        return redirect()->to('/admin');
    }

    public function saveHousehold()
    {
        // Handle household save logic here
        return redirect()->to('/admin/households');
    }
} 