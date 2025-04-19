<?php

namespace App\Models;

use CodeIgniter\Model;

class OfficialModel extends Model
{
    protected $table = 'officials';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'first_name',
        'middle_name',
        'last_name',
        'position',
        'term',
        'email',
        'phone_number',
        'address',
        'image',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';

    protected $validationRules = [
        'first_name' => 'required|min_length[2]|max_length[50]',
        'last_name' => 'required|min_length[2]|max_length[50]',
        'position' => 'required|min_length[2]|max_length[100]',
        'term' => 'required|min_length[2]|max_length[50]',
        'email' => 'permit_empty|valid_email',
        'phone_number' => 'permit_empty|min_length[7]|max_length[20]',
        'address' => 'permit_empty|min_length[5]|max_length[255]'
    ];

    protected $validationMessages = [
        'first_name' => [
            'required' => 'First name is required',
            'min_length' => 'First name must be at least 2 characters long',
            'max_length' => 'First name cannot exceed 50 characters'
        ],
        'last_name' => [
            'required' => 'Last name is required',
            'min_length' => 'Last name must be at least 2 characters long',
            'max_length' => 'Last name cannot exceed 50 characters'
        ],
        'position' => [
            'required' => 'Position is required',
            'min_length' => 'Position must be at least 2 characters long',
            'max_length' => 'Position cannot exceed 100 characters'
        ],
        'term' => [
            'required' => 'Term is required',
            'min_length' => 'Term must be at least 2 characters long',
            'max_length' => 'Term cannot exceed 50 characters'
        ],
        'email' => [
            'valid_email' => 'Please enter a valid email address'
        ],
        'phone_number' => [
            'min_length' => 'Phone number must be at least 7 characters long',
            'max_length' => 'Phone number cannot exceed 20 characters'
        ],
        'address' => [
            'min_length' => 'Address must be at least 5 characters long',
            'max_length' => 'Address cannot exceed 255 characters'
        ]
    ];
} 