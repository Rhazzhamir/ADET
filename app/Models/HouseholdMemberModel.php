<?php

namespace App\Models;

use CodeIgniter\Model;

class HouseholdMemberModel extends Model
{
    protected $table            = 'household_members';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'household_id',
        'full_name',
        'relationship',
        'age',
        // Timestamps handled automatically
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at'; // Uncomment if using soft deletes

    // Validation
    protected $validationRules      = [
        'household_id' => 'required|integer',
        'full_name'    => 'required|max_length[255]',
        'relationship' => 'permit_empty|max_length[100]',
        'age'          => 'permit_empty|integer|max_length[3]',
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
    // Example: Find members by household ID
    public function findByHouseholdId($householdId)
    {
        return $this->where('household_id', $householdId)->findAll();
    }
}
