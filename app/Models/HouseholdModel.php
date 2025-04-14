<?php

namespace App\Models;

use CodeIgniter\Model;

class HouseholdModel extends Model
{
    protected $table = 'households';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'household_name',
        'household_head',
        'address',
        'contact',
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
        'household_name' => 'required|min_length[3]|max_length[100]',
        'address'        => 'required|min_length[5]|max_length[255]'
    ];
    
    protected $validationMessages = [
        'household_name' => [
            'required'   => 'Household name is required',
            'min_length' => 'Household name must be at least 3 characters long',
            'max_length' => 'Household name cannot exceed 100 characters'
        ],
        'address' => [
            'required'   => 'Address is required',
            'min_length' => 'Address must be at least 5 characters long',
            'max_length' => 'Address cannot exceed 255 characters'
        ]
    ];

    protected $skipValidation = false;

    /**
     * Get all households with their head resident details
     *
     * @return array
     */
    public function getHouseholdsWithHeads()
    {
        $builder = $this->db->table('households h');
        $builder->select('h.*, r.full_name as head_name');
        $builder->join('residents r', 'r.id = h.household_head', 'left');
        $builder->orderBy('h.household_name', 'ASC');
        
        return $builder->get()->getResultArray();
    }
    
    /**
     * Get household with all its members
     *
     * @param int $id Household ID
     * @return array
     */
    public function getHouseholdWithMembers($id)
    {
        $household = $this->find($id);
        
        if (!$household) {
            return null;
        }
        
        // Get all residents belonging to this household
        $residentModel = new ResidentModel();
        $members = $residentModel->where('household_id', $id)->findAll();
        
        $household['members'] = $members;
        
        return $household;
    }
} 