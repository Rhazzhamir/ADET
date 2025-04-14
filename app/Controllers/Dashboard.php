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
        // Check if user is logged in
        if (!session()->get('is_logged_in') || session()->get('user_type') !== 'resident') {
            return redirect()->to(base_url('auth/resident/login'));
        }

        // Get resident data
        $residentModel = new \App\Models\ResidentModel();
        $resident = $residentModel->find(session()->get('resident_id'));

        if (!$resident) {
            session()->setFlashdata('error', 'Resident data not found');
            return redirect()->to(base_url('auth/resident/login'));
        }

        $data = [
            'title' => 'Resident Dashboard',
            'active_menu' => 'dashboard',
            'resident' => $resident
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

    public function changePassword()
    {
        // Check if user is logged in
        if (!session()->get('is_logged_in') || session()->get('user_type') !== 'resident') {
            return redirect()->to(base_url('auth/resident/login'));
        }

        // Enhanced password validation rules
        $rules = [
            'current_password' => 'required',
            'new_password' => [
                'rules' => 'required|min_length[8]|max_length[255]|regex_match[/[A-Z]/]|regex_match[/[0-9]/]|regex_match[/[!@#$%^&*()\-_=+{};:,<.>]/]',
                'errors' => [
                    'regex_match' => 'Your password must contain at least one uppercase letter, one number, and one special character'
                ]
            ],
            'confirm_password' => 'required|matches[new_password]'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', $this->validator->getErrors() ? implode('<br>', $this->validator->getErrors()) : 'Please check your input and try again.');
            return redirect()->to(base_url('dashboard/profile').'#password')->withInput();
        }

        // Get resident data
        $residentModel = new \App\Models\ResidentModel();
        $resident = $residentModel->find(session()->get('resident_id'));

        if (!$resident) {
            session()->setFlashdata('error', 'Resident data not found');
            return redirect()->to(base_url('dashboard/profile').'#password');
        }

        // Verify current password
        if (!password_verify($this->request->getPost('current_password'), $resident['password'])) {
            session()->setFlashdata('error', 'Current password is incorrect');
            return redirect()->to(base_url('dashboard/profile').'#password');
        }

        // Get the new password
        $newPassword = $this->request->getPost('new_password');
        
        // Check if new password and current password are the same
        if (password_verify($newPassword, $resident['password'])) {
            session()->setFlashdata('error', 'New password cannot be the same as your current password');
            return redirect()->to(base_url('dashboard/profile').'#password');
        }

        // Update password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $residentModel->update($resident['id'], [
            'password' => $hashedPassword,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Set success message and clear_form flag to clear input fields
        session()->setFlashdata('success', 'Password changed successfully');
        session()->setFlashdata('clear_form', true);
        
        return redirect()->to(base_url('dashboard/profile').'#password');
    }

    public function savePersonalInfo()
    {
        // Check if user is logged in
        if (!session()->get('is_logged_in') || session()->get('user_type') !== 'resident') {
            return redirect()->to(base_url('auth/resident/login'));
        }
        
        // Get form data
        $firstName = $this->request->getPost('firstName');
        $middleName = $this->request->getPost('middleName');
        $lastName = $this->request->getPost('lastName');
        $suffix = $this->request->getPost('suffix');
        $dateOfBirth = $this->request->getPost('dateOfBirth');
        $gender = $this->request->getPost('gender');
        $civilStatus = $this->request->getPost('civilStatus');
        $nationality = $this->request->getPost('nationality');
        
        // Construct full name
        $fullName = $firstName;
        if (!empty($middleName)) {
            $fullName .= ' ' . $middleName;
        }
        $fullName .= ' ' . $lastName;
        if (!empty($suffix)) {
            $fullName .= ' ' . $suffix;
        }
        
        // Get resident data
        $residentModel = new \App\Models\ResidentModel();
        $residentId = session()->get('resident_id');
        
        // Update resident data
        $data = [
            'full_name' => $fullName,
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'suffix' => $suffix,
            'date_of_birth' => $dateOfBirth,
            'gender' => $gender,
            'civil_status' => $civilStatus,
            'nationality' => $nationality
        ];
        
        if ($residentModel->update($residentId, $data)) {
            // Update session data
            session()->set('resident_name', $fullName);
            
            // Set success message
            session()->setFlashdata('success', 'Personal information updated successfully');
        } else {
            // Set error message
            session()->setFlashdata('error', 'Failed to update personal information');
        }
        
        return redirect()->to(base_url('dashboard/profile'));
    }
} 