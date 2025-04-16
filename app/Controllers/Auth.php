<?php

namespace App\Controllers;

use App\Models\ResidentModel;
use App\Models\AdminModel;

class Auth extends BaseController
{
    protected $residentModel;
    protected $adminModel;

    public function __construct()
    {
        $this->residentModel = new ResidentModel();
        $this->adminModel = new AdminModel();
    }

    public function residentLogin()
    {
        return view('auth/resident_login');
    }

    public function residentRegister()
    {
        return view('auth/resident_register');
    }

    public function processResidentRegistration()
    {
        // Validate form data
        $rules = [
            'firstName' => 'required|min_length[2]|max_length[50]',
            'middleName' => 'permit_empty|max_length[50]',
            'lastName' => 'required|min_length[2]|max_length[50]',
            'email'    => 'required|valid_email|is_unique[residents.email]',
            'phone'    => 'required|min_length[10]|max_length[15]',
            'address'  => 'required|min_length[5]|max_length[255]',
            'password' => 'required|min_length[8]|max_length[255]',
            'confirmPassword' => 'required|matches[password]',
            'terms'    => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get form data
        $firstName = $this->request->getPost('firstName');
        $middleName = $this->request->getPost('middleName');
        $lastName = $this->request->getPost('lastName');
        
        // Construct full name
        $fullName = trim($firstName);
        if (!empty($middleName)) {
            $fullName .= ' ' . trim($middleName);
        }
        $fullName .= ' ' . trim($lastName);

        $data = [
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'full_name' => $fullName,
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
            'address'   => $this->request->getPost('address'),
            'password'  => $this->request->getPost('password')
        ];

        // Register the resident
        $residentId = $this->residentModel->registerResident($data);

        if ($residentId) {
            // Set success message
            session()->setFlashdata('success', 'Registration successful! You can now login.');
            return redirect()->to(base_url('auth/resident/login'));
        } else {
            // Set error message
            session()->setFlashdata('error', 'Registration failed. Please try again.');
            return redirect()->back()->withInput();
        }
    }

    public function processResidentLogin()
    {
        // Validate form data
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Verify login credentials
        $resident = $this->residentModel->verifyLogin($email, $password);

        if ($resident) {
            // Set session data
            $sessionData = [
                'resident_id' => $resident['id'],
                'resident_name' => $resident['full_name'],
                'resident_email' => $resident['email'],
                'is_logged_in' => true,
                'user_type' => 'resident'
            ];
            
            session()->set($sessionData);
            
            // Set success message
            session()->setFlashdata('success', 'Welcome, ' . $resident['full_name'] . '!');
            
            // Check if there's a redirect URL stored in session
            $redirectUrl = session()->getFlashdata('redirect_url');
            if ($redirectUrl) {
                return redirect()->to($redirectUrl);
            }
            
            // If no redirect URL, go to default dashboard
            return redirect()->to(base_url('resident/dashboard'));
        } else {
            // Set error message
            session()->setFlashdata('error', 'Invalid email or password');
            return redirect()->back()->withInput();
        }
    }

    public function adminLogin()
    {
        return view('auth/admin_login');
    }

    public function processAdminLogin()
    {
        // Validate form data
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Verify login credentials
        $admin = $this->adminModel->verifyLogin($username, $password);

        if ($admin) {
            // Set session data
            $sessionData = [
                'admin_id' => $admin['id'],
                'admin_username' => $admin['username'],
                'admin_email' => $admin['email'],
                'is_logged_in' => true,
                'user_type' => 'admin'
            ];
            
            session()->set($sessionData);
            
            // Set success message
            session()->setFlashdata('success', 'Welcome back, ' . $admin['username'] . '!');
            
            // Redirect to admin dashboard (Residents::index)
            return redirect()->to(base_url('admin'));
        } else {
            // Set error message
            session()->setFlashdata('error', 'Invalid username or password');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        // Get the user type before destroying the session
        $userType = session()->get('user_type');
        
        // Destroy session
        session()->destroy();
        
        // Set success message
        session()->setFlashdata('success', 'You have been logged out successfully.');
        
        // Redirect based on user type
        if ($userType === 'resident') {
            return redirect()->to(base_url('auth/resident/login'));
        } else {
            return redirect()->to(base_url('auth/admin_login'));
        }
    }
} 