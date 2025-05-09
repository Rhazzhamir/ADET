<?php

namespace App\Models;

use CodeIgniter\Model;

class CertificateModel extends Model
{
    protected $table = 'certificate_requests';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'resident_id',
        'certificate_type',
        'purpose',
        'requested_date',
        'number_of_copies',
        'status',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
} 