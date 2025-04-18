<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpenseModel extends Model
{
    protected $table = 'expenses';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['date', 'category', 'amount'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'date' => 'required|valid_date',
        'category' => 'required|min_length[3]|max_length[100]',
        'amount' => 'required|numeric|greater_than[0]',
    ];

    protected $validationMessages = [
        'date' => [
            'required' => 'Date is required',
            'valid_date' => 'Please enter a valid date'
        ],
        'category' => [
            'required' => 'Category is required',
            'min_length' => 'Category must be at least 3 characters long',
            'max_length' => 'Category cannot exceed 100 characters'
        ],
        'amount' => [
            'required' => 'Amount is required',
            'numeric' => 'Amount must be a number',
            'greater_than' => 'Amount must be greater than 0'
        ]
    ];

    protected $skipValidation = false;
} 