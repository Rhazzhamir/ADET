<?php

namespace App\Controllers;

class Settings extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'System Settings'
        ];
        return $this->render('settings/index', $data);
    }
} 