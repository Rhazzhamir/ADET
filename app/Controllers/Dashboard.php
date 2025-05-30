<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\HouseholdModel;
use App\Models\HouseholdMemberModel;
use App\Models\ResidentModel;
use App\Models\BudgetModel;
use App\Models\ExpenseModel;
use App\Models\CertificateModel;

class Dashboard extends BaseController
{
    protected $residentModel;
    protected $householdModel;
    protected $budgetModel;
    protected $expenseModel;
    protected $certificateModel;

    public function __construct()
    {
        $this->residentModel = new ResidentModel();
        $this->householdModel = new HouseholdModel();
        $this->budgetModel = new BudgetModel();
        $this->expenseModel = new ExpenseModel();
        $this->certificateModel = new CertificateModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'total_residents' => $this->residentModel->countAll(),
            'total_households' => $this->householdModel->countAll(),
            'total_budget' => $this->budgetModel->selectSum('amount')->get()->getRow()->amount ?? 0,
            'total_expenses' => $this->expenseModel->selectSum('amount')->get()->getRow()->amount ?? 0,
            'recent_residents' => $this->residentModel->orderBy('created_at', 'DESC')->limit(5)->find(),
            'recent_households' => $this->householdModel->orderBy('created_at', 'DESC')->limit(5)->find(),
            'recent_budgets' => $this->budgetModel->orderBy('created_at', 'DESC')->limit(5)->find(),
            'recent_expenses' => $this->expenseModel->orderBy('created_at', 'DESC')->limit(5)->find(),
            'total_rejected_certificates' => $this->certificateModel->where('status', 'rejected')->countAllResults(),
            'total_approved_certificates' => $this->certificateModel->where('status', 'approved')->countAllResults(),
            'total_pending_certificates' => $this->certificateModel->where('status', 'pending')->countAllResults(),
        ];

        // Calculate remaining balance
        $data['remaining_balance'] = $data['total_budget'] - $data['total_expenses'];

        return view('dashboard/index', $data);
    }

    public function residentDashboard()
    {
        // Check if user is logged in
        if (!session()->get('is_logged_in') || session()->get('user_type') !== 'resident') {
            return redirect()->to(base_url('auth/resident/login'));
        }

        // Get resident data
        $residentModel = new \App\Models\ResidentModel();
        $resident = $residentModel->find(session()->get('resident_id'));

        if (!$resident) {
            session()->setFlashdata('error', 'Resident data not found');
            return redirect()->to(base_url('auth/resident/login'));
        }

        $data = [
            'title' => 'Resident Dashboard',
            'active_menu' => 'dashboard',
            'resident' => $resident
        ];
        
        return view('dashboard/resident', $data);
    }

    public function profile()
    {
        // Check if user is logged in
        if (!session()->get('is_logged_in') || session()->get('user_type') !== 'resident') {
            return redirect()->to(base_url('auth/resident/login'));
        }

        // Get resident data
        $residentId = session()->get('resident_id');
        $residentModel = new ResidentModel();
        $resident = $residentModel->find($residentId);

        if (!$resident) {
            session()->setFlashdata('error', 'Resident data not found');
            return redirect()->to(base_url('auth/resident/login')); // Redirect to login if resident not found
        }

        // Convert relative profile picture path to full URL
        if (!empty($resident['profile_picture'])) {
            $resident['profile_picture'] = base_url($resident['profile_picture']);
        }

        // Fetch household data
        $householdModel = new HouseholdModel();
        $household = $householdModel->where('resident_id', $residentId)->first();
        
        // Fetch household members if household exists
        $members = [];
        if ($household) {
            $memberModel = new HouseholdMemberModel();
            $members = $memberModel->where('household_id', $household['id'])->findAll();
        }

        $data = [
            'title' => 'My Profile',
            'active_menu' => 'profile',
            'resident' => $resident,
            'household' => $household, // Pass household data
            'members' => $members     // Pass members data
        ];
        
        return view('dashboard/profile', $data);
    }

    public function household()
    {
        // Redirect to profile page since household info is now part of the profile
        return redirect()->to(base_url('dashboard/profile'));
    }

    public function changePassword()
    {
        // Check if user is logged in
        if (!session()->get('is_logged_in') || session()->get('user_type') !== 'resident') {
            return redirect()->to(base_url('auth/resident/login'));
        }

        // Enhanced password validation rules
        $rules = [
            'current_password' => 'required',
            'new_password' => [
                'rules' => 'required|min_length[8]|max_length[255]|regex_match[/[A-Z]/]|regex_match[/[0-9]/]|regex_match[/[!@#$%^&*()\-_=+{};:,<.>]/]',
                'errors' => [
                    'regex_match' => 'Your password must contain at least one uppercase letter, one number, and one special character'
                ]
            ],
            'confirm_password' => 'required|matches[new_password]'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', $this->validator->getErrors() ? implode('<br>', $this->validator->getErrors()) : 'Please check your input and try again.');
            return redirect()->to(base_url('dashboard/profile').'#password')->withInput();
        }

        // Get resident data
        $residentModel = new \App\Models\ResidentModel();
        $resident = $residentModel->find(session()->get('resident_id'));

        if (!$resident) {
            session()->setFlashdata('error', 'Resident data not found');
            return redirect()->to(base_url('dashboard/profile').'#password');
        }

        // Verify current password
        if (!password_verify($this->request->getPost('current_password'), $resident['password'])) {
            session()->setFlashdata('error', 'Current password is incorrect');
            return redirect()->to(base_url('dashboard/profile').'#password');
        }

        // Get the new password
        $newPassword = $this->request->getPost('new_password');
        
        // Check if new password and current password are the same
        if (password_verify($newPassword, $resident['password'])) {
            session()->setFlashdata('error', 'New password cannot be the same as your current password');
            return redirect()->to(base_url('dashboard/profile').'#password');
        }

        // Update password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $residentModel->update($resident['id'], [
            'password' => $hashedPassword,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Set success message and clear_form flag to clear input fields
        session()->setFlashdata('success', 'Password changed successfully');
        session()->setFlashdata('clear_form', true);
        
        return redirect()->to(base_url('dashboard/profile').'#password');
    }

    public function savePersonalInfo()
    {
        // Check if user is logged in
        if (!session()->get('is_logged_in') || session()->get('user_type') !== 'resident') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Please login to continue'
            ]);
        }

        // Validation rules
        $rules = [
            'firstName' => 'required|min_length[2]|max_length[50]',
            'lastName' => 'required|min_length[2]|max_length[50]',
            'dateOfBirth' => 'required|valid_date',
            'gender' => 'required|in_list[male,female,other]',
            'civilStatus' => 'required|in_list[single,married,divorced,widowed]',
            'email' => 'required|valid_email',
            'phone' => 'required|min_length[10]|max_length[15]',
            'address' => 'required|min_length[5]|max_length[255]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }
        
        // Get form data
        $firstName = $this->request->getPost('firstName');
        $middleName = $this->request->getPost('middleName');
        $lastName = $this->request->getPost('lastName');
        $suffix = $this->request->getPost('suffix');
        $dateOfBirth = $this->request->getPost('dateOfBirth');
        $gender = $this->request->getPost('gender');
        $civilStatus = $this->request->getPost('civilStatus');
        $nationality = $this->request->getPost('nationality');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $address = $this->request->getPost('address');
        
        // Construct full name
        $fullName = $firstName;
        if (!empty($middleName)) {
            $fullName .= ' ' . $middleName;
        }
        $fullName .= ' ' . $lastName;
        if (!empty($suffix)) {
            $fullName .= ' ' . $suffix;
        }
        
        // Get resident data
        $residentModel = new \App\Models\ResidentModel();
        $residentId = session()->get('resident_id');

        if (!$residentId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Resident ID not found in session'
            ]);
        }
        
        // Update resident data
        $data = [
            'full_name' => $fullName,
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'suffix' => $suffix,
            'date_of_birth' => $dateOfBirth,
            'gender' => $gender,
            'civil_status' => $civilStatus,
            'nationality' => $nationality,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        try {
            // Temporarily skip validation
            $residentModel->skipValidation(true);
        
        if ($residentModel->update($residentId, $data)) {
            // Update session data
            session()->set('resident_name', $fullName);
            
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Personal information updated successfully',
                    'resident_name' => $fullName
                ]);
            } else {
                // Log the error
                log_message('error', 'Failed to update resident data. Resident ID: ' . $residentId);
                log_message('error', 'Update data: ' . json_encode($data));
                
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to update personal information. Please try again.'
                ]);
            }
        } catch (\Exception $e) {
            // Log the exception
            log_message('error', 'Exception in savePersonalInfo: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'An error occurred while updating your information. Please try again.'
            ]);
        } finally {
            // Re-enable validation
            $residentModel->skipValidation(false);
        }
    }

    public function saveResidentRegistration()
    {
        // Check if user is logged in
        if (!session()->get('is_logged_in') || session()->get('user_type') !== 'resident') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Please login to continue'
            ]);
        }

        $residentId = session()->get('resident_id');
        if (!$residentId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Resident ID not found in session'
            ]);
        }

        // Load models
        $householdModel = new HouseholdModel();
        $memberModel = new HouseholdMemberModel();

        // Validation Rules
        $rules = [
            'household_head' => 'required|max_length[255]',
            'house_type' => 'required|max_length[100]',
            'ownership_status' => 'required|max_length[100]',
            'number_of_rooms' => 'permit_empty|integer|greater_than[0]',
            'household_address' => 'required|max_length[65535]',
            'members.*.full_name' => 'required|max_length[255]',
            'members.*.relationship' => 'permit_empty|max_length[100]',
            'members.*.age' => 'permit_empty|integer|greater_than_equal_to[0]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }

        // Get form data
        $householdData = [
            'resident_id' => $residentId,
            'household_head' => $this->request->getPost('household_head'),
            'house_type' => $this->request->getPost('house_type'),
            'ownership_status' => $this->request->getPost('ownership_status'),
            'number_of_rooms' => $this->request->getPost('number_of_rooms'),
            'household_address' => $this->request->getPost('household_address')
        ];

        $membersData = $this->request->getPost('members');

        // Start transaction
        $db = db_connect();
        $db->transStart();

        try {
            // Save or update household data
            $existingHousehold = $householdModel->where('resident_id', $residentId)->first();
            $householdId = null;

            if ($existingHousehold) {
                // Update existing household
                $householdModel->update($existingHousehold['id'], $householdData);
                $householdId = $existingHousehold['id'];
                // Optionally, delete existing members before adding new ones if you want a full replace
                // $memberModel->where('household_id', $householdId)->delete();
            } else {
                // Insert new household
                $householdId = $householdModel->insert($householdData);
                if (!$householdId) {
                    throw new \Exception("Failed to create household record.");
                }
            }

            // Save household members (assuming we add new members, not replacing all)
            if (!empty($membersData) && is_array($membersData)) {
                foreach ($membersData as $member) {
                    if (!empty($member['full_name'])) { // Only save members with a name
                        $member['household_id'] = $householdId;
                        if (!$memberModel->save($member)) {
                            // Log the specific member error
                            log_message('error', 'Failed to save household member: ' . json_encode($member) . ' Errors: ' . json_encode($memberModel->errors()));
                            throw new \Exception("Failed to save one or more household members.");
                        }
                    }
                }
            }

            // Commit transaction
            if ($db->transStatus() === false) {
                 $db->transRollback();
                 log_message('error', 'Household Registration Transaction Failed');
                 return $this->response->setJSON(['success' => false, 'message' => 'Database error occurred during registration.']);
        } else {
                $db->transCommit();
                return $this->response->setJSON(['success' => true, 'message' => 'Household information registered successfully.']);
            }

        } catch (\Exception $e) {
            // Rollback transaction on error
            $db->transRollback();
            log_message('error', 'Household Registration Exception: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteHouseholdMember($memberId = null)
    {
        // Check if this is an AJAX request
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Invalid request type.']);
        }

        // Check if user is logged in
        if (!session()->get('is_logged_in') || session()->get('user_type') !== 'resident') {
            return $this->response->setJSON(['success' => false, 'message' => 'Authentication required.']);
        }

        // Validate member ID
        if ($memberId === null || !is_numeric($memberId)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid Member ID.']);
        }

        $residentId = session()->get('resident_id');
        $memberModel = new HouseholdMemberModel();
        $householdModel = new HouseholdModel();

        try {
            // Find the member
            $member = $memberModel->find($memberId);
            if (!$member) {
                return $this->response->setJSON(['success' => false, 'message' => 'Member not found.']);
            }

            // Find the household associated with the member
            $household = $householdModel->find($member['household_id']);

            // Authorization check: Ensure the household belongs to the logged-in resident
            if (!$household || $household['resident_id'] != $residentId) {
                log_message('error', "Unauthorized attempt to delete member ID {$memberId} by resident ID {$residentId}");
                return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Unauthorized action.']);
            }

            // Delete the member
            if ($memberModel->delete($memberId)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Member deleted successfully.']);
            } else {
                log_message('error', "Failed to delete member ID {$memberId}. Errors: " . json_encode($memberModel->errors()));
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete member.']);
            }

        } catch (\Exception $e) {
            log_message('error', 'Exception deleting member ID ' . $memberId . ': ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'An error occurred while deleting the member.']);
        }
    }

    public function certificateRequest()
    {
        // Check if user is logged in
        if (!session()->get('is_logged_in') || session()->get('user_type') !== 'resident') {
            return redirect()->to(base_url('auth/resident/login'));
        }

        // Get resident's certificate requests
        $residentId = session()->get('resident_id');
        $requests = $this->certificateModel->where('resident_id', $residentId)
                                        ->orderBy('created_at', 'DESC')
                                        ->findAll();

        $data = [
            'title' => 'Certificate Request',
            'active_menu' => 'certificate-request',
            'requests' => $requests
        ];

        return view('dashboard/certificate_request', $data);
    }

    public function submitCertificateRequest()
    {
        // Check if user is logged in
        if (!session()->get('is_logged_in') || session()->get('user_type') !== 'resident') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Please login to continue'
            ]);
        }

        // Log the POST data
        log_message('debug', 'Certificate Request POST data: ' . json_encode($this->request->getPost()));

        // Validate input
        $rules = [
            'certificate_type' => 'required',
            'purpose' => 'required|min_length[10]',
            'requested_date' => 'required|valid_date',
            'number_of_copies' => 'required|integer|greater_than[0]|less_than[6]'
        ];

        if (!$this->validate($rules)) {
            // Log validation errors
            log_message('debug', 'Certificate Request validation errors: ' . json_encode($this->validator->getErrors()));
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }

        // Save request
        $data = [
            'resident_id' => session()->get('resident_id'),
            'certificate_type' => $this->request->getPost('certificate_type'),
            'purpose' => $this->request->getPost('purpose'),
            'requested_date' => $this->request->getPost('requested_date'),
            'number_of_copies' => $this->request->getPost('number_of_copies'),
            'status' => 'pending'
        ];

        if ($this->certificateModel->insert($data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Certificate request submitted successfully. Wait for approval from the barangay official.'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to submit certificate request'
        ]);
    }

    public function notification()
    {
        // Check if user is logged in
        if (!session()->get('is_logged_in') || session()->get('user_type') !== 'resident') {
            return redirect()->to(base_url('auth/resident/login'));
        }

        // Get resident's notifications
        $residentId = session()->get('resident_id');
        
        // For now, we'll just show certificate request notifications
        $notifications = $this->certificateModel->where('resident_id', $residentId)
                                              ->orderBy('created_at', 'DESC')
                                              ->findAll();

        $data = [
            'title' => 'Notifications',
            'active_menu' => 'notification',
            'notifications' => $notifications
        ];

        return view('dashboard/notification', $data);
    }

    public function cancelCertificateRequest()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Invalid request type.']);
        }

        if (!session()->get('is_logged_in') || session()->get('user_type') !== 'resident') {
            return $this->response->setJSON(['success' => false, 'message' => 'Authentication required.']);
        }

        $input = $this->request->getJSON(true);
        $requestId = $input['id'] ?? null;
        $residentId = session()->get('resident_id');

        if (!$requestId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request ID.']);
        }

        $request = $this->certificateModel->find($requestId);
        if (!$request || $request['resident_id'] != $residentId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Request not found or unauthorized.']);
        }
        if ($request['status'] !== 'pending') {
            return $this->response->setJSON(['success' => false, 'message' => 'Only pending requests can be cancelled.']);
        }

        $this->certificateModel->update($requestId, ['status' => 'cancelled']);
        return $this->response->setJSON(['success' => true, 'message' => 'Request cancelled successfully.']);
    }
} 