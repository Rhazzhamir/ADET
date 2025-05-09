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
} 