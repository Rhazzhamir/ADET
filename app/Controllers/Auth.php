<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Auth extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required',
                'account_type' => 'required'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $accountType = $this->request->getPost('account_type');

            $user = $this->userModel->where('email', $email)
                                  ->where('account_type', $accountType)
                                  ->where('is_active', 1)
                                  ->first();

            if (!$user || !password_verify($password, $user['password'])) {
                return redirect()->back()->withInput()->with('error', 'Invalid email or password');
            }

            // Set session data
            $sessionData = [
                'user_id' => $user['id'],
                'email' => $user['email'],
                'account_type' => $user['account_type'],
                'isLoggedIn' => true
            ];
            session()->set($sessionData);

            // Redirect based on account type
            if ($user['account_type'] === 'admin') {
                return redirect()->to('dashboard');
            } else {
                return redirect()->to('resident/dashboard');
            }
        }

        return view('auth/login');
    }

    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'first_name' => 'required|min_length[2]',
                'last_name' => 'required|min_length[2]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]',
                'confirm_password' => 'required|matches[password]',
                'address' => 'required',
                'contact' => 'required',
                'birthdate' => 'required',
                'terms' => 'required'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $data = [
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'address' => $this->request->getPost('address'),
                'contact' => $this->request->getPost('contact'),
                'birthdate' => $this->request->getPost('birthdate'),
                'account_type' => 'resident',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->userModel->insert($data);

            return redirect()->to('auth/login')->with('success', 'Registration successful! Please login.');
        }

        return view('auth/register');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('auth/login');
    }

    public function admin_login()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'password' => 'required',
                'email' => 'required|valid_email',
                'account_type' => 'required'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', 'Invalid input');
            }

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $accountType = $this->request->getPost('account_type');

            // Verify it's the admin account
            if ($email !== 'admin@barangay.com' || $accountType !== 'admin') {
                return redirect()->back()->with('error', 'Invalid admin credentials');
            }

            $user = $this->userModel->where('email', $email)
                                  ->where('account_type', $accountType)
                                  ->where('is_active', 1)
                                  ->first();

            if (!$user || !password_verify($password, $user['password'])) {
                return redirect()->back()->with('error', 'Invalid password');
            }

            // Set session data
            $sessionData = [
                'user_id' => $user['id'],
                'email' => $user['email'],
                'account_type' => $user['account_type'],
                'isLoggedIn' => true
            ];
            session()->set($sessionData);

            return redirect()->to('dashboard');
        }

        return view('auth/admin_login');
    }
} 