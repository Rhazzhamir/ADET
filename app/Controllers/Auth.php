<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function residentLogin()
    {
        return view('auth/resident_login');
    }

    public function residentRegister()
    {
        return view('auth/resident_register');
    }

    public function adminLogin()
    {
        return view('auth/admin_login');
    }
} 