<?php

namespace App\Models;

use CodeIgniter\Model;

class HouseholdModel extends Model
{
    protected $table            = 'households';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'resident_id',
        'household_head',
        'house_type',
        'ownership_status',
        'number_of_rooms',
        'household_address',
        // Timestamps are handled automatically
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at'; // Uncomment if using soft deletes

    // Validation
    protected $validationRules      = [
        'resident_id' => 'required|integer',
        'household_head' => 'permit_empty|max_length[255]',
        'house_type' => 'permit_empty|max_length[100]',
        'ownership_status' => 'permit_empty|max_length[100]',
        'number_of_rooms' => 'permit_empty|integer|max_length[5]',
        'household_address' => 'permit_empty|max_length[65535]', // TEXT max length
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Add any custom methods here if needed
    // Example: Find household by resident ID
    public function findByResidentId($residentId)
    {
        return $this->where('resident_id', $residentId)->first();
    }

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