<?php

namespace App\Models;

use CodeIgniter\Model;

class ResidentModel extends Model
{
    protected $table = 'residents';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'full_name', 
        'email', 
        'phone', 
        'address', 
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
        'full_name' => 'required|min_length[3]|max_length[100]',
        'email'     => 'required|valid_email|is_unique[residents.email,id,{id}]',
        'phone'     => 'required|min_length[10]|max_length[15]',
        'address'   => 'required|min_length[5]|max_length[255]',
        'password'  => 'required|min_length[8]|max_length[255]'
    ];
    
    protected $validationMessages = [
        'full_name' => [
            'required'   => 'Full name is required',
            'min_length' => 'Full name must be at least 3 characters long',
            'max_length' => 'Full name cannot exceed 100 characters'
        ],
        'email' => [
            'required'    => 'Email is required',
            'valid_email' => 'Please enter a valid email address',
            'is_unique'   => 'This email is already registered'
        ],
        'phone' => [
            'required'   => 'Phone number is required',
            'min_length' => 'Phone number must be at least 10 characters long',
            'max_length' => 'Phone number cannot exceed 15 characters'
        ],
        'address' => [
            'required'   => 'Address is required',
            'min_length' => 'Address must be at least 5 characters long',
            'max_length' => 'Address cannot exceed 255 characters'
        ],
        'password' => [
            'required'   => 'Password is required',
            'min_length' => 'Password must be at least 8 characters long',
            'max_length' => 'Password cannot exceed 255 characters'
        ]
    ];

    protected $skipValidation = false;

    /**
     * Register a new resident
     *
     * @param array $data Resident data
     * @return int|bool The ID of the newly created resident, or false on failure
     */
    public function registerResident($data)
    {
        // Hash the password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        // Insert the resident data
        if ($this->insert($data)) {
            return $this->getInsertID();
        }
        
        return false;
    }

    /**
     * Verify resident login credentials
     *
     * @param string $email Email address
     * @param string $password Password
     * @return array|bool Resident data if credentials are valid, false otherwise
     */
    public function verifyLogin($email, $password)
    {
        $resident = $this->where('email', $email)->first();
        
        if ($resident && password_verify($password, $resident['password'])) {
            // Remove password from the returned data
            unset($resident['password']);
            return $resident;
        }
        
        return false;
    }
} 