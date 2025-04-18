<?php

namespace App\Models;

use CodeIgniter\Model;

class PositionModel extends Model
{
    protected $table = 'positions';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'position_name',
        'description',
        'max_officials',
        'hierarchy_level',
        'is_active'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'position_name' => 'required|min_length[3]|max_length[100]|is_unique[positions.position_name,id,{id}]',
        'description' => 'permit_empty',
        'max_officials' => 'required|integer|greater_than[0]',
        'hierarchy_level' => 'required|integer|greater_than_equal_to[0]',
        'is_active' => 'required|integer|in_list[0,1]'
    ];

    protected $validationMessages = [
        'position_name' => [
            'required' => 'Position name is required',
            'min_length' => 'Position name must be at least 3 characters long',
            'max_length' => 'Position name cannot exceed 100 characters',
            'is_unique' => 'This position name already exists'
        ],
        'max_officials' => [
            'required' => 'Maximum number of officials is required',
            'integer' => 'Maximum number of officials must be a whole number',
            'greater_than' => 'Maximum number of officials must be greater than 0'
        ],
        'hierarchy_level' => [
            'required' => 'Hierarchy level is required',
            'integer' => 'Hierarchy level must be a whole number',
            'greater_than_equal_to' => 'Hierarchy level must be 0 or greater'
        ]
    ];

    protected $skipValidation = false;

    /**
     * Get positions with current official count
     */
    public function getPositionsWithCount()
    {
        $db = \Config\Database::connect();
        
        return $this->select('positions.*, COUNT(officials.id) as current_count')
                   ->join('officials', 'officials.position = positions.position_name', 'left')
                   ->where('positions.is_active', 1)
                   ->groupBy('positions.id')
                   ->findAll();
    }

    /**
     * Check if position has reached maximum officials
     */
    public function hasReachedMaxOfficials($positionName)
    {
        $position = $this->where('position_name', $positionName)->first();
        if (!$position) {
            return true; // Return true to prevent assignment to non-existent position
        }

        $db = \Config\Database::connect();
        $currentCount = $db->table('officials')
                          ->where('position', $positionName)
                          ->where('status', 'active')
                          ->countAllResults();

        return $currentCount >= $position['max_officials'];
    }
} 