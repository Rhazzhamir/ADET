<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Get the current URI using the correct method
        $currentURI = $request->getUri()->getPath();

        // Check if the current URI is an admin route
        $isAdminRoute = $currentURI === 'admin' || strpos($currentURI, 'admin/') === 0;

        // If it's an admin route and user is not logged in or not an admin
        if ($isAdminRoute && (!session()->get('is_logged_in') || session()->get('user_type') !== 'admin')) {
            // Store the current URL to redirect back after login
            session()->setFlashdata('redirect_url', current_url());
            
            // Set error message in session
            session()->setFlashdata('error_alert', 'Please login to access this page.');
            
            // Redirect to admin login page
            return redirect()->to(base_url('auth/admin_login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing after the controller
    }
} 