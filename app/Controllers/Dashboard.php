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
} 