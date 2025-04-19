<?php

namespace App\Controllers;

use App\Models\OfficialModel;

class Officials extends BaseController
{
    protected $officialModel;
    protected $uploadPath;

    public function __construct()
    {
        $this->officialModel = new OfficialModel();
        $this->uploadPath = FCPATH . 'uploads/officials/';
        
        // Create upload directory if it doesn't exist
        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0777, true);
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Officials List',
            'officials' => $this->officialModel->findAll()
        ];

        return view('officials/index', $data);
    }

    public function view($id = null)
    {
        $official = $this->officialModel->find($id);
        
        if (!$official) {
            return redirect()->to('/officials')->with('error', 'Official not found');
        }
        
        $data = [
            'title' => 'View Official',
            'official' => $official
        ];
        
        return view('officials/view', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Official'
        ];

        return view('officials/add', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules($this->officialModel->validationRules, $this->officialModel->validationMessages);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'middle_name' => $this->request->getPost('middle_name'),
            'last_name' => $this->request->getPost('last_name'),
            'position' => $this->request->getPost('position'),
            'term' => $this->request->getPost('term'),
            'email' => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('phone_number'),
            'address' => $this->request->getPost('address')
        ];

        // Handle file upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Generate a unique filename
            $newName = $image->getRandomName();
            
            try {
                // Move the file
                if ($image->move($this->uploadPath, $newName)) {
                    $data['image'] = $newName;
                } else {
                    log_message('error', 'Failed to move uploaded file to ' . $this->uploadPath . '/' . $newName);
                    return redirect()->back()->withInput()->with('error', 'Failed to upload image');
                }
            } catch (\Exception $e) {
                log_message('error', 'Exception during file upload: ' . $e->getMessage());
                return redirect()->back()->withInput()->with('error', 'Failed to upload image: ' . $e->getMessage());
            }
        }

        if ($this->officialModel->insert($data)) {
            return redirect()->to('/officials')->with('success', 'Official added successfully');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to add official');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Official',
            'official' => $this->officialModel->find($id)
        ];

        if (!$data['official']) {
            return redirect()->to('/officials')->with('error', 'Official not found');
        }

        return view('officials/edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules($this->officialModel->validationRules, $this->officialModel->validationMessages);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'middle_name' => $this->request->getPost('middle_name'),
            'last_name' => $this->request->getPost('last_name'),
            'position' => $this->request->getPost('position'),
            'term' => $this->request->getPost('term'),
            'email' => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('phone_number'),
            'address' => $this->request->getPost('address')
        ];

        // Handle file upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Delete old image if exists
            $official = $this->officialModel->find($id);
            if ($official && $official['image']) {
                $oldImagePath = $this->uploadPath . $official['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Generate a unique filename
            $newName = $image->getRandomName();
            
            try {
                // Move the file
                if ($image->move($this->uploadPath, $newName)) {
                    $data['image'] = $newName;
                } else {
                    log_message('error', 'Failed to move uploaded file to ' . $this->uploadPath . '/' . $newName);
                    return redirect()->back()->withInput()->with('error', 'Failed to upload image');
                }
            } catch (\Exception $e) {
                log_message('error', 'Exception during file upload: ' . $e->getMessage());
                return redirect()->back()->withInput()->with('error', 'Failed to upload image: ' . $e->getMessage());
            }
        }

        if ($this->officialModel->update($id, $data)) {
            return redirect()->to('/officials')->with('success', 'Official updated successfully');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to update official');
    }

    public function delete($id)
    {
        // Delete the official's image if it exists
        $official = $this->officialModel->find($id);
        if ($official && $official['image']) {
            $imagePath = $this->uploadPath . $official['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($this->officialModel->delete($id)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Official deleted successfully'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to delete official'
        ]);
    }
} 