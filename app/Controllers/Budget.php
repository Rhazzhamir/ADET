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
            'budgets' => $this->budgetModel->findAll()
        ];

        return view('budget/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add New Budget'
        ];

        return view('budget/create', $data);
    }

    public function store()
    {
        // Validation rules
        $rules = [
            'year' => [
                'rules' => 'required|numeric|exact_length[4]',
                'errors' => [
                    'required' => 'Year is required',
                    'numeric' => 'Year must be a number',
                    'exact_length' => 'Year must be 4 digits'
                ]
            ],
            'amount' => [
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => 'Amount is required',
                    'numeric' => 'Amount must be a number',
                    'greater_than' => 'Amount must be greater than 0'
                ]
            ]
        ];

        // Check if it's an AJAX request
        if ($this->request->isAJAX()) {
            if (!$this->validate($rules)) {
                return $this->respond([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $this->validator->getErrors()
                ]);
            }

            // Check if budget for this year already exists
            $existingBudget = $this->budgetModel->where('year', $this->request->getPost('year'))->first();
            if ($existingBudget) {
                return $this->respond([
                    'status' => 'error',
                    'message' => 'Budget for this year already exists'
                ]);
            }

            $data = [
                'year' => $this->request->getPost('year'),
                'amount' => $this->request->getPost('amount')
            ];

            try {
                $this->budgetModel->insert($data);
                
                // Get updated budget list for the table
                $budgets = $this->budgetModel->findAll();
                $html = view('budget/partials/budget_table', ['budgets' => $budgets]);
                
                return $this->respond([
                    'status' => 'success',
                    'message' => 'Budget added successfully',
                    'data' => $html
                ]);
            } catch (\Exception $e) {
                return $this->respond([
                    'status' => 'error',
                    'message' => 'Failed to add budget: ' . $e->getMessage()
                ]);
            }
        } else {
            // Regular form submission
            if (!$this->validate($rules)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

            // Check if budget for this year already exists
            $existingBudget = $this->budgetModel->where('year', $this->request->getPost('year'))->first();
            if ($existingBudget) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Budget for this year already exists');
            }

            $data = [
                'year' => $this->request->getPost('year'),
                'amount' => $this->request->getPost('amount')
            ];

            try {
                $this->budgetModel->insert($data);
                return redirect()->to('/budget')
                    ->with('message', 'Budget added successfully');
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Failed to add budget: ' . $e->getMessage());
            }
        }
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Budget',
            'budget' => $this->budgetModel->find($id)
        ];

        if (empty($data['budget'])) {
            return redirect()->to('/budget')->with('error', 'Budget not found');
        }

        return view('budget/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'year' => 'required|numeric|exact_length[4]',
            'amount' => 'required|numeric|greater_than[0]'
        ];

        if (!$this->validate($rules)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => implode(', ', $this->validator->getErrors())
                ]);
            }
            return redirect()->back()
                ->with('error', implode(', ', $this->validator->getErrors()))
                ->withInput();
        }

        $data = [
            'year' => $this->request->getPost('year'),
            'amount' => $this->request->getPost('amount')
        ];

        try {
            $this->budgetModel->update($id, $data);
            
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Budget updated successfully'
                ]);
            }
            
            return redirect()->to('/budget')->with('success', 'Budget updated successfully');
            
        } catch (\Exception $e) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Failed to update budget: ' . $e->getMessage()
                ]);
            }
            
            return redirect()->back()
                ->with('error', 'Failed to update budget: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function delete($id)
    {
        try {
            $this->budgetModel->delete($id);
            
            // Check if it's an AJAX request
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Budget deleted successfully'
                ]);
            }
            
            // For regular form submission, redirect with success message
            return redirect()->to('/budget')->with('success', 'Budget deleted successfully');
            
        } catch (\Exception $e) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Failed to delete budget: ' . $e->getMessage()
                ]);
            }
            
            return redirect()->back()->with('error', 'Failed to delete budget: ' . $e->getMessage());
        }
    }

    public function getYearlyTotal($year)
    {
        $total = $this->budgetModel->getTotalBudgetByYear($year);
        return $this->response->setJSON(['total' => $total]);
    }

    public function add()
    {
        // Validation rules
        $rules = [
            'year' => [
                'rules' => 'required|numeric|exact_length[4]',
                'errors' => [
                    'required' => 'Year is required',
                    'numeric' => 'Year must be a number',
                    'exact_length' => 'Year must be 4 digits'
                ]
            ],
            'amount' => [
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => 'Amount is required',
                    'numeric' => 'Amount must be a number',
                    'greater_than' => 'Amount must be greater than 0'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('error', implode(', ', $this->validator->getErrors()))
                ->withInput();
        }

        $year = $this->request->getPost('year');
        $amount = $this->request->getPost('amount');

        // Check if budget for this year already exists
        $existingBudget = $this->budgetModel->where('year', $year)->first();
        if ($existingBudget) {
            return redirect()->back()
                ->with('error', 'Budget for year ' . $year . ' already exists')
                ->withInput();
        }

        $data = [
            'year' => $year,
            'amount' => $amount
        ];

        try {
            $inserted = $this->budgetModel->insert($data);
            
            if (!$inserted) {
                return redirect()->back()
                    ->with('error', 'Failed to insert budget data')
                    ->withInput();
            }
            
            return redirect()->to('/budget/reports')
                ->with('success', 'Budget added successfully');
                
        } catch (\Exception $e) {
            log_message('error', 'Budget add error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to add budget: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function expenses()
    {
        $data = [
            'title' => 'Expenses',
            'active_menu' => 'budget'
        ];
        return view('budget/expenses', $data);
    }

    public function reports()
    {
        $data = [
            'title' => 'Budget Reports',
            'active_menu' => 'budget',
            'budgets' => $this->budgetModel->orderBy('year', 'DESC')->findAll()
        ];
        return view('budget/budget', $data);
    }
} 