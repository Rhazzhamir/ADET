<?php

namespace App\Controllers;

use App\Models\ExpenseModel;

class Expenses extends BaseController
{
    protected $expenseModel;
    
    public function __construct()
    {
        $this->expenseModel = new ExpenseModel();
    }

    public function index()
    {
        // Get all expenses
        $expenses = $this->expenseModel->orderBy('date', 'DESC')->findAll();
        
        // Calculate total budget (sum of all expenses)
        $totalBudget = array_reduce($expenses, function($carry, $expense) {
            return $carry + $expense['amount'];
        }, 0);

        $data = [
            'title' => 'Expense Records',
            'expenses' => $expenses,
            'totalBudget' => $totalBudget
        ];

        return view('budget/expenses', $data);
    }

    public function add()
    {
        if (!$this->validate($this->expenseModel->validationRules, $this->expenseModel->validationMessages)) {
            return redirect()->back()
                ->with('error', implode('<br>', $this->validator->getErrors()))
                ->withInput();
        }

        $data = [
            'date' => $this->request->getPost('date'),
            'category' => $this->request->getPost('category'),
            'amount' => $this->request->getPost('amount')
        ];

        try {
            $this->expenseModel->insert($data);
            return redirect()->to('/expenses')
                ->with('success', 'Expense added successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to add expense: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function update($id = null)
    {
        if (!$id) {
            return redirect()->to('/expenses')->with('error', 'Invalid expense ID');
        }

        if (!$this->validate($this->expenseModel->validationRules, $this->expenseModel->validationMessages)) {
            return redirect()->back()
                ->with('error', implode('<br>', $this->validator->getErrors()))
                ->withInput();
        }

        $data = [
            'date' => $this->request->getPost('date'),
            'category' => $this->request->getPost('category'),
            'amount' => $this->request->getPost('amount')
        ];

        try {
            $this->expenseModel->update($id, $data);
            return redirect()->to('/expenses')
                ->with('success', 'Expense updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update expense: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function delete($id = null)
    {
        if (!$id) {
            return redirect()->to('/expenses')->with('error', 'Invalid expense ID');
        }

        try {
            $this->expenseModel->delete($id);
            return redirect()->to('/expenses')
                ->with('success', 'Expense deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete expense: ' . $e->getMessage());
        }
    }
} 