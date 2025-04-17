<?php

namespace App\Controllers;

use App\Models\BudgetModel;
use CodeIgniter\API\ResponseTrait;

class Budget extends BaseController
{
    use ResponseTrait;
    
    protected $budgetModel;
    
    public function __construct()
    {
        $this->budgetModel = new BudgetModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Budget Management',
            'active_menu' => 'budget',
            'budgets' => $this->budgetModel->orderBy('year', 'DESC')->findAll()
        ];
        
        return view('budget/budget', $data);
    }

    public function add()
    {
        if (!$this->request->isAJAX()) {
            log_message('error', 'Budget add: Non-AJAX request received');
            return $this->fail('Invalid request');
        }

        // Log the received data
        log_message('debug', 'Budget add: Received data - ' . json_encode($this->request->getPost()));

        // Validate CSRF token
        if (!$this->validateCSRF()) {
            log_message('error', 'Budget add: CSRF validation failed');
            return $this->respond([
                'status' => 'error',
                'message' => 'Invalid security token'
            ]);
        }

        $rules = [
            'year' => 'required|numeric|min_length[4]|max_length[4]',
            'amount' => 'required|numeric|greater_than[0]'
        ];

        if (!$this->validate($rules)) {
            log_message('error', 'Budget add: Validation failed - ' . json_encode($this->validator->getErrors()));
            return $this->respond([
                'status' => 'error',
                'message' => implode(', ', $this->validator->getErrors())
            ]);
        }

        $year = $this->request->getPost('year');
        $amount = $this->request->getPost('amount');

        // Check if budget for this year already exists
        $existingBudget = $this->budgetModel->where('year', $year)->first();
        if ($existingBudget) {
            log_message('error', 'Budget add: Budget already exists for year ' . $year);
            return $this->respond([
                'status' => 'error',
                'message' => 'Budget for year ' . $year . ' already exists'
            ]);
        }

        $data = [
            'year' => $year,
            'amount' => $amount,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        try {
            log_message('debug', 'Budget add: Attempting to insert - ' . json_encode($data));
            $inserted = $this->budgetModel->insert($data);
            
            if (!$inserted) {
                log_message('error', 'Budget add: Insert failed - ' . json_encode($this->budgetModel->errors()));
                return $this->respond([
                    'status' => 'error',
                    'message' => 'Failed to insert budget data: ' . implode(', ', $this->budgetModel->errors())
                ]);
            }
            
            // Log successful insertion
            log_message('info', 'Budget add: Successfully inserted budget for year ' . $year);
            
            // Fetch updated budget list
            $budgets = $this->budgetModel->orderBy('year', 'DESC')->findAll();
            log_message('debug', 'Budget add: Retrieved updated list - Count: ' . count($budgets));
            
            if (empty($budgets)) {
                $html = '<tr><td colspan="3" class="text-center">No budget records found</td></tr>';
            } else {
                $html = '';
                foreach ($budgets as $budget) {
                    $html .= '<tr>';
                    $html .= '<td>' . esc($budget['year']) . '</td>';
                    $html .= '<td>₱' . number_format($budget['amount'], 2) . '</td>';
                    $html .= '<td>';
                    $html .= '<button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editBudgetModal' . $budget['id'] . '">';
                    $html .= '<i class="fas fa-edit"></i>';
                    $html .= '</button> ';
                    $html .= '<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteBudgetModal' . $budget['id'] . '">';
                    $html .= '<i class="fas fa-trash"></i>';
                    $html .= '</button>';
                    $html .= '</td>';
                    $html .= '</tr>';
                }
            }

            return $this->respond([
                'status' => 'success',
                'message' => 'Budget added successfully',
                'data' => $html
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Budget add error: ' . $e->getMessage());
            return $this->respond([
                'status' => 'error',
                'message' => 'Failed to add budget: ' . $e->getMessage()
            ]);
        }
    }

    protected function validateCSRF()
    {
        $csrf = csrf_hash();
        return $csrf === $this->request->getPost('csrf_test_name');
    }

    public function expenses()
    {
        $data = [
            'title' => 'Expenses'
        ];
        return view('budget/expenses', $data);
    }

    public function reports()
    {
        $data = [
            'title' => 'Budget Reports'
        ];
        return view('budget/budget', $data);
    }
} 