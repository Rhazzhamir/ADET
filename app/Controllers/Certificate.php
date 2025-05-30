<?php

namespace App\Controllers;

use App\Models\CertificateModel;

class Certificate extends BaseController
{
    public function index()
    {
        $certificateModel = new CertificateModel();
        $requests = $certificateModel
            ->select('certificate_requests.*, residents.full_name as resident_name')
            ->join('residents', 'residents.id = certificate_requests.resident_id')
            ->orderBy('certificate_requests.created_at', 'DESC')
            ->findAll();

        return view('certificate/index', [
            'requests' => $requests,
            'title' => 'Certificate Requests'
        ]);
    }

    public function view($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Invalid request type.']);
        }
        $certificateModel = new CertificateModel();
        $request = $certificateModel
            ->select('certificate_requests.*, residents.full_name as resident_name, residents.profile_picture')
            ->join('residents', 'residents.id = certificate_requests.resident_id')
            ->where('certificate_requests.id', $id)
            ->first();
        if ($request) {
            // Build full image URL or use a placeholder
            if (!empty($request['profile_picture'])) {
                $request['profile_picture_url'] = base_url($request['profile_picture']);
            } else {
                $request['profile_picture_url'] = base_url('assets/img/default-profile.png');
            }
            return $this->response->setJSON(['success' => true, 'request' => $request]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Request not found.']);
        }
    }

    public function approve($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Invalid request type.']);
        }
        $certificateModel = new CertificateModel();
        $request = $certificateModel->find($id);
        if (!$request) {
            return $this->response->setJSON(['success' => false, 'message' => 'Request not found.']);
        }
        if ($request['status'] !== 'pending') {
            return $this->response->setJSON(['success' => false, 'message' => 'Only pending requests can be approved.']);
        }
        $certificateModel->update($id, ['status' => 'approved']);
        return $this->response->setJSON(['success' => true, 'message' => 'Certificate request approved successfully.']);
    }

    public function reject($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Invalid request type.']);
        }
        $certificateModel = new CertificateModel();
        $request = $certificateModel->find($id);
        if (!$request) {
            return $this->response->setJSON(['success' => false, 'message' => 'Request not found.']);
        }
        if ($request['status'] !== 'pending') {
            return $this->response->setJSON(['success' => false, 'message' => 'Only pending requests can be rejected.']);
        }
        $certificateModel->update($id, ['status' => 'rejected']);
        return $this->response->setJSON(['success' => true, 'message' => 'Certificate request rejected successfully.']);
    }
} 