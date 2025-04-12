<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is not logged in or not an admin
        if (!session()->get('is_logged_in') || session()->get('user_type') !== 'admin') {
            // Store the current URL to redirect back after login
            session()->setFlashdata('redirect_url', current_url());
            
            // Set error message
            session()->setFlashdata('error', 'Please login as admin to access this page.');
            
            // Redirect to admin login page
            return redirect()->to(base_url('auth/admin_login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing after the controller
    }
} 