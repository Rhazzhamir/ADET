<?php

namespace App\Controllers;

use App\Models\ResidentModel;
use CodeIgniter\Controller;

class ResidentController extends Controller
{
    protected $residentModel;

    public function __construct()
    {
        $this->residentModel = new ResidentModel();
    }

    public function index()
    {
        $data['residents'] = $this->residentModel->select('
            id,
            first_name as FirstName,
            middle_name as MiddleName,
            last_name as LastName,
            phone as Phone_Number,
            created_at as Created_at,
            updated_at as Updated_at
        ')->findAll();

        return view('residents/index', $data);
    }

    public function delete($id = null)
    {
        $residentModel = new ResidentModel();
        $resident = $residentModel->find($id);
        
        if ($resident) {
            $residentModel->delete($id);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Resident deleted successfully']);
        }
        
        return $this->response->setJSON(['status' => 'error', 'message' => 'Resident not found']);
    }

    public function view($id)
    {
        $residentModel = new ResidentModel();
        $resident = $residentModel->find($id);

        if ($resident) {
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $resident
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Resident not found'
        ]);
    }

    public function viewPage($id)
    {
        return view('admin/view_resident', ['residentId' => $id]);
    }
} 