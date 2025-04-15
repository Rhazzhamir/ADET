<?php

namespace App\Controllers;

class Residents extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Residents',
            'active_menu' => 'residents'
        ];
        return view('residents/index', $data);
    }

    public function edit($id = null)
    {
        if (!$id) {
            return redirect()->to('/admin')->with('error', 'No resident ID provided');
        }
        
        $residentModel = new \App\Models\ResidentModel();
        $resident = $residentModel->find($id);
        
        if (!$resident) {
            return redirect()->to('/admin')->with('error', 'Resident not found');
        }
        
        // Load households for the dropdown
        // You may need to create/modify this model if it doesn't exist
        $householdModel = new \App\Models\HouseholdModel();
        $households = $householdModel->findAll();
        
        $data = [
            'title' => 'Edit Resident',
            'active_menu' => 'residents',
            'resident' => $resident,
            'households' => $households
        ];
        
        return view('residents/edit', $data);
    }

    public function update()
    {
        $residentModel = new \App\Models\ResidentModel();
        $id = $this->request->getPost('id');
        
        // Collect all form data
        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'middle_name' => $this->request->getPost('middle_name'),
            'birth_date' => $this->request->getPost('birth_date'),
            'gender' => $this->request->getPost('gender'),
            'civil_status' => $this->request->getPost('civil_status'),
            'address' => $this->request->getPost('address'),
            'contact' => $this->request->getPost('contact'),
            'email' => $this->request->getPost('email'),
            'household_id' => $this->request->getPost('household_id')
        ];
        
        // Update the resident data
        if ($residentModel->update($id, $data)) {
            return redirect()->to('/admin')->with('success', 'Resident updated successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to update resident');
        }
    }

    public function uploadProfilePicture()
    {
        // Check if this is an AJAX request
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Direct access not allowed']);
        }

        $residentId = $this->request->getPost('resident_id');
        if (!$residentId) {
            return $this->response->setJSON(['error' => 'Resident ID is required']);
        }

        // Load the resident model
        $residentModel = new \App\Models\ResidentModel();
        $resident = $residentModel->find($residentId);
        if (!$resident) {
            return $this->response->setJSON(['error' => 'Resident not found']);
        }

        // Handle file upload
        $file = $this->request->getFile('profile_picture');
        if (!$file || !$file->isValid() || $file->getError() != 0) {
            $errorMessage = $file ? $file->getErrorString() : 'No file uploaded';
            return $this->response->setJSON(['error' => $errorMessage]);
        }

        // Validate file type
        $validationRule = [
            'profile_picture' => [
                'label' => 'Profile Picture',
                'rules' => 'uploaded[profile_picture]|is_image[profile_picture]|mime_in[profile_picture,image/jpg,image/jpeg,image/png]|max_size[profile_picture,2048]',
            ],
        ];

        if (!$this->validate($validationRule)) {
            $errors = $this->validator->getErrors();
            return $this->response->setJSON(['error' => reset($errors)]);
        }

        // Generate a unique filename
        $newName = $residentId . '_' . time() . '.' . $file->getExtension();
        
        // Make sure the upload directory exists
        $uploadPath = FCPATH . 'uploads/profile_pictures';
        if (!is_dir($uploadPath)) {
            if (!mkdir($uploadPath, 0777, true)) {
                log_message('error', "Failed to create directory: {$uploadPath}");
                return $this->response->setJSON(['error' => 'Failed to create upload directory']);
            }
        }
        
        // Check if the directory is writable
        if (!is_writable($uploadPath)) {
            log_message('error', "Upload directory is not writable: {$uploadPath}");
            return $this->response->setJSON(['error' => 'Upload directory is not writable']);
        }
        
        try {
            if ($file->move($uploadPath, $newName)) {
                // Delete old profile picture if exists
                if (!empty($resident['profile_picture'])) {
                    $oldPath = FCPATH . $resident['profile_picture'];
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
                
                // Update database with new profile picture path (relative to web root)
                $profilePicturePath = 'uploads/profile_pictures/' . $newName;
                $residentModel->update($residentId, ['profile_picture' => $profilePicturePath]);
                
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Profile picture uploaded successfully',
                    'profile_picture_url' => base_url($profilePicturePath)
                ]);
            } else {
                log_message('error', "Failed to move uploaded file to {$uploadPath}/{$newName}");
                return $this->response->setJSON(['error' => 'Failed to save the uploaded image']);
            }
        } catch (\Exception $e) {
            log_message('error', "Exception during file upload: " . $e->getMessage());
            return $this->response->setJSON(['error' => 'An error occurred during file upload: ' . $e->getMessage()]);
        }
    }

    public function testProfileUpload()
    {
        // Create a dummy resident for testing
        $resident = [
            'id' => 999, // Test ID
            'full_name' => 'Test Resident',
            'email' => 'test@example.com',
            'phone' => '09319697096',
            'address' => 'Babatnogn',
            'profile_picture' => ''
        ];
        
        $data = [
            'title' => 'Test Profile Upload',
            'active_menu' => 'residents',
            'resident' => $resident
        ];
        
        return view('residents/test_profile_upload', $data);
    }
} 