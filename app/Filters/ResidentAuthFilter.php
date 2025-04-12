<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ResidentAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is not logged in
        if (!session()->get('is_logged_in') || session()->get('user_type') !== 'resident') {
            // Store the current URL to redirect back after login
            session()->setFlashdata('redirect_url', current_url());
            
            // Redirect to login page with a message
            return redirect()->to(base_url('auth/resident/login'))
                ->with('error', 'Please login to access this page.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing after the controller
    }
} 