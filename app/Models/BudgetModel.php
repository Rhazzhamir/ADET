<?php

namespace App\Models;

use CodeIgniter\Model;

class BudgetModel extends Model
{
    protected $table = 'budgets';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['year', 'amount', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'year' => 'required|numeric|min_length[4]|max_length[4]',
        'amount' => 'required|numeric|greater_than[0]',
    ];

    protected $validationMessages = [
        'year' => [
            'required' => 'Year is required',
            'numeric' => 'Year must be a number',
            'min_length' => 'Year must be 4 digits',
            'max_length' => 'Year must be 4 digits'
        ],
        'amount' => [
            'required' => 'Amount is required',
            'numeric' => 'Amount must be a number',
            'greater_than' => 'Amount must be greater than 0'
        ]
    ];
} 