<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OfficialModel;
use App\Models\PositionModel;

class Officials extends BaseController
{
    protected $officialModel;
    protected $positionModel;
    protected $session;

    public function __construct()
    {
        $this->officialModel = new OfficialModel();
        $this->positionModel = new PositionModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $model = new OfficialModel();
        $data['officials'] = $model->orderBy('position', 'asc')
                                  ->orderBy('last_name', 'asc')
                                  ->findAll();

        return view('officials/index', $data);
    }

    public function add()
    {
        if ($this->request->getMethod() === 'post') {
            // Debug log
            log_message('debug', 'Form data: ' . json_encode($this->request->getPost()));
            
            // Check if the position has reached its maximum officials
            $position = $this->request->getPost('position');
            if ($this->positionModel->hasReachedMaxOfficials($position)) {
                $this->session->setFlashdata('error', 'Maximum number of officials for this position has been reached');
                return redirect()->back()->withInput();
            }
            
            // Handle file upload
            $photo = $this->request->getFile('photo');
            $photoName = null;
            
            if ($photo && $photo->isValid() && !$photo->hasMoved()) {
                $newName = $photo->getRandomName();
                if ($photo->move(FCPATH . 'uploads/officials', $newName)) {
                    $photoName = $newName;
                } else {
                    $this->session->setFlashdata('error', 'Failed to upload photo');
                    return redirect()->back()->withInput();
                }
            }
            
            $data = [
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'position' => $position,
                'contact' => $this->request->getPost('contact'),
                'term_start' => $this->request->getPost('term_start'),
                'term_end' => $this->request->getPost('term_end'),
                'address' => $this->request->getPost('address'),
                'status' => 'active',
                'photo' => $photoName
            ];
            
            try {
                if ($this->officialModel->save($data)) {
                    $this->session->setFlashdata('success', 'Official added successfully');
                    return redirect()->to('/officials');
                } else {
                    log_message('error', 'Database errors: ' . json_encode($this->officialModel->errors()));
                    $this->session->setFlashdata('errors', $this->officialModel->errors());
                    return redirect()->back()->withInput();
                }
            } catch (\Exception $e) {
                log_message('error', 'Exception when saving official: ' . $e->getMessage());
                $this->session->setFlashdata('error', 'Failed to save official. Please try again.');
                return redirect()->back()->withInput();
            }
        }
        
        return view('officials/add');
    }

    public function save()
    {
        // Remove this method as it's redundant with add()
        return redirect()->to('/officials');
    }

    public function edit($id = null)
    {
        $model = new OfficialModel();
        
        if ($id === null) {
            return redirect()->to('/officials')->with('error', 'Official not found');
        }
        
        $official = $model->find($id);
        if ($official === null) {
            return redirect()->to('/officials')->with('error', 'Official not found');
        }
        
        if ($this->request->getMethod() === 'post') {
            // Handle file upload
            $photo = $this->request->getFile('photo');
            $photoName = $official['photo']; // Keep existing photo by default
            
            if ($photo && $photo->isValid() && !$photo->hasMoved()) {
                // Delete old photo if exists
                if ($photoName && file_exists(FCPATH . 'uploads/officials/' . $photoName)) {
                    unlink(FCPATH . 'uploads/officials/' . $photoName);
                }
                
                $newName = $photo->getRandomName();
                $photo->move(FCPATH . 'uploads/officials', $newName);
                $photoName = $newName;
            }
            
            $data = [
                'id' => $id,
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'position' => $this->request->getPost('position'),
                'contact' => $this->request->getPost('contact'),
                'term_start' => $this->request->getPost('term_start'),
                'term_end' => $this->request->getPost('term_end'),
                'address' => $this->request->getPost('address'),
                'status' => $this->request->getPost('status'),
                'photo' => $photoName
            ];
            
            if ($model->save($data)) {
                return redirect()->to('/officials')->with('success', 'Official updated successfully');
            } else {
                return redirect()->back()->withInput()->with('errors', $model->errors());
            }
        }
        
        return view('officials/edit', ['official' => $official]);
    }

    public function update($id = null)
    {
        if ($id === null) {
            return redirect()->to('/officials');
        }

        $official = $this->officialModel->find($id);
        if (!$official) {
            $this->session->setFlashdata('error', 'Official not found');
            return redirect()->to('/officials');
        }

        $photo = $this->request->getFile('photo');
        $data = [
            'id' => $id,
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'position' => $this->request->getPost('position'),
            'contact' => $this->request->getPost('contact'),
            'term_start' => $this->request->getPost('term_start'),
            'term_end' => $this->request->getPost('term_end'),
            'address' => $this->request->getPost('address'),
            'status' => $this->request->getPost('status')
        ];

        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            // Delete old photo if exists
            if ($official['photo'] && file_exists('uploads/officials/' . $official['photo'])) {
                unlink('uploads/officials/' . $official['photo']);
            }

            $photoName = $photo->getRandomName();
            $photo->move('uploads/officials', $photoName);
            $data['photo'] = $photoName;
        }

        if ($this->officialModel->save($data)) {
            $this->session->setFlashdata('success', 'Official updated successfully');
            return redirect()->to('/officials');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->officialModel->errors());
        }
    }

    public function delete($id = null)
    {
        $model = new OfficialModel();
        
        if ($id === null) {
            return redirect()->to('/officials')->with('error', 'Official not found');
        }
        
        $official = $model->find($id);
        if ($official === null) {
            return redirect()->to('/officials')->with('error', 'Official not found');
        }
        
        // Delete photo file if it exists
        if ($official['photo'] && file_exists(FCPATH . 'uploads/officials/' . $official['photo'])) {
            unlink(FCPATH . 'uploads/officials/' . $official['photo']);
        }
        
        if ($model->delete($id)) {
            return redirect()->to('/officials')->with('success', 'Official deleted successfully');
        }
        
        return redirect()->to('/officials')->with('error', 'Failed to delete official');
    }

    public function positions()
    {
        $data = [
            'title' => 'Official Positions',
            'positions' => $this->positionModel->getPositionsWithCount()
        ];

        return view('officials/positions', $data);
    }

    public function terms()
    {
        $data = [
            'title' => 'Official Terms',
            'officials' => $this->officialModel->orderBy('term_start', 'DESC')->findAll()
        ];

        return view('officials/terms', $data);
    }
} 