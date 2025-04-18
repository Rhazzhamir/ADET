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
        'last_name',
        'position',
        'contact',
        'term_start',
        'term_end',
        'address',
        'photo',
        'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'first_name' => 'required|min_length[2]|max_length[50]',
        'last_name' => 'required|min_length[2]|max_length[50]',
        'position' => 'required|min_length[3]|max_length[100]',
        'contact' => 'required|min_length[10]|max_length[15]',
        'term_start' => 'required|valid_date',
        'term_end' => 'required|valid_date',
        'address' => 'permit_empty|max_length[255]',
        'status' => 'permit_empty|in_list[active,inactive]'
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
            'min_length' => 'Position must be at least 3 characters long',
            'max_length' => 'Position cannot exceed 100 characters'
        ],
        'contact' => [
            'required' => 'Contact number is required',
            'min_length' => 'Contact number must be at least 10 characters long',
            'max_length' => 'Contact number cannot exceed 15 characters'
        ],
        'term_start' => [
            'required' => 'Term start date is required',
            'valid_date' => 'Please enter a valid term start date'
        ],
        'term_end' => [
            'required' => 'Term end date is required',
            'valid_date' => 'Please enter a valid term end date'
        ]
    ];

    protected $skipValidation = false;

    public function save($data): bool
    {
        log_message('debug', 'Attempting to save official with data: ' . json_encode($data));
        
        if (!$this->validate($data)) {
            log_message('error', 'Validation failed with errors: ' . json_encode($this->errors()));
            return false;
        }
        
        try {
            $result = parent::save($data);
            log_message('debug', 'Save result: ' . ($result ? 'success' : 'failed'));
            return $result;
        } catch (\Exception $e) {
            log_message('error', 'Exception during save: ' . $e->getMessage());
            throw $e;
        }
    }
} 