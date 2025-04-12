<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admins';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'username',
        'email',
        'password',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[50]|is_unique[admins.username,id,{id}]',
        'email'    => 'required|valid_email|is_unique[admins.email,id,{id}]',
        'password' => 'required|min_length[8]|max_length[255]'
    ];
    
    protected $validationMessages = [
        'username' => [
            'required'   => 'Username is required',
            'min_length' => 'Username must be at least 3 characters long',
            'max_length' => 'Username cannot exceed 50 characters',
            'is_unique'  => 'This username is already taken'
        ],
        'email' => [
            'required'    => 'Email is required',
            'valid_email' => 'Please enter a valid email address',
            'is_unique'   => 'This email is already registered'
        ],
        'password' => [
            'required'   => 'Password is required',
            'min_length' => 'Password must be at least 8 characters long',
            'max_length' => 'Password cannot exceed 255 characters'
        ]
    ];

    protected $skipValidation = false;

    /**
     * Verify admin login credentials
     *
     * @param string $username Username
     * @param string $password Password
     * @return array|bool Admin data if credentials are valid, false otherwise
     */
    public function verifyLogin($username, $password)
    {
        $admin = $this->where('username', $username)->first();
        
        if ($admin && password_verify($password, $admin['password'])) {
            // Remove password from the returned data
            unset($admin['password']);
            return $admin;
        }
        
        return false;
    }
} 