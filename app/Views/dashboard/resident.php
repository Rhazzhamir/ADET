<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Dashboard - BIMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --info-color: #0dcaf0;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --sidebar-width: 250px;
            
            /* Light theme variables */
            --bg-color: #f5f5f5;
            --card-bg: #ffffff;
            --text-color: #212529;
            --border-color: #dee2e6;
            --form-bg: #f8f9fa;
            --sidebar-bg: #212529;
            --sidebar-text: #ffffff;
            --sidebar-hover: rgba(255, 255, 255, 0.1);
            --card-shadow: 0 2px 4px rgba(0,0,0,0.1);
            --input-bg: #ffffff;
            --input-border: #ced4da;
            --input-focus-border: #86b7fe;
            --input-focus-shadow: rgba(13, 110, 253, 0.25);
        }

        [data-theme="dark"] {
            --bg-color: #121212;
            --card-bg: #1e1e1e;
            --text-color: #e0e0e0;
            --border-color: #333333;
            --form-bg: #2a2a2a;
            --sidebar-bg: #000000;
            --sidebar-text: #ffffff;
            --sidebar-hover: rgba(255, 255, 255, 0.1);
            --card-shadow: 0 2px 4px rgba(0,0,0,0.3);
            --input-bg: #2a2a2a;
            --input-border: #444444;
            --input-focus-border: #0d6efd;
            --input-focus-shadow: rgba(13, 110, 253, 0.25);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s, color 0.3s;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            padding-top: 20px;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            margin: 4px 0;
            border-radius: 5px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link:hover {
            background: var(--sidebar-hover);
            color: white;
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background: var(--primary-color);
            color: white;
            font-weight: 500;
        }

        .sidebar .nav-link i {
            width: 25px;
            margin-right: 10px;
            font-size: 1.1rem;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: margin-left 0.3s;
        }

        /* Card Styles */
        .dashboard-card {
            background: var(--card-bg);
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            margin-bottom: 20px;
            transition: transform 0.3s, background-color 0.3s, box-shadow 0.3s;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .card-header {
            background: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 600;
        }

        .card-header .badge {
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 20px;
        }

        /* Form Styles */
        .form-control, .form-select {
            background-color: var(--input-bg);
            border-color: var(--input-border);
            color: var(--text-color);
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--input-focus-border);
            box-shadow: 0 0 0 0.25rem var(--input-focus-shadow);
            background-color: var(--input-bg);
            color: var(--text-color);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .form-section {
            background-color: var(--form-bg);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: background-color 0.3s;
            border: 1px solid var(--border-color);
        }

        .form-section-title {
            color: #20c997;
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-section-title i {
            font-size: 1.2rem;
        }

        /* Progress Bar */
        .progress-container {
            margin-bottom: 30px;
        }

        .progress {
            height: 10px;
            border-radius: 5px;
            background-color: var(--form-bg);
            margin-bottom: 10px;
        }

        .progress-bar {
            background-color: var(--primary-color);
            transition: width 0.6s ease;
        }

        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
        }

        .progress-step {
            text-align: center;
            font-size: 0.8rem;
            color: var(--secondary-color);
            position: relative;
            flex: 1;
        }

        .progress-step.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        .progress-step.completed {
            color: var(--success-color);
        }

        .progress-step::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: var(--border-color);
            top: 50%;
            left: 50%;
            z-index: -1;
        }

        .progress-step:last-child::after {
            display: none;
        }

        /* Buttons */
        .btn {
            border-radius: 5px;
            padding: 8px 16px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-secondary:hover {
            background-color: #5c636a;
            border-color: #565e64;
            transform: translateY(-2px);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }

        .btn-danger:hover {
            background-color: #bb2d3b;
            border-color: #b02a37;
            transform: translateY(-2px);
        }

        /* Theme Toggle Button */
        .theme-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            transition: all 0.3s;
            z-index: 1000;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
        }

        /* Welcome Section */
        .welcome-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .welcome-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
        }

        .welcome-text h4 {
            margin-bottom: 5px;
        }

        .welcome-text p {
            margin-bottom: 0;
            color: var(--secondary-color);
        }

        /* Form Navigation */
        .form-nav {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            .sidebar .nav-link span {
                display: none;
            }
            .main-content {
                margin-left: 70px;
            }
            .welcome-section {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Include the alerts partial -->
    <?= view('partials/alerts') ?>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center mb-4">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="BIMS Logo" height="50" class="mb-2">
            <h5 class="text-white">Resident Portal</h5>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="<?= base_url('dashboard/resident') ?>">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard/profile') ?>">
                    <i class="fas fa-user"></i>
                    <span>My Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard/certificate-request') ?>">
                    <i class="fas fa-user"></i>
                    <span>Certificate Request</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard/notification') ?>">
                    <i class="fas fa-bell"></i>
                    <span>Notification</span>
                </a>
            </li>
            <li class="nav-item mt-4">
                <a class="nav-link text-danger" href="<?= base_url('auth/logout') ?>">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Theme Toggle Button -->
    <div class="theme-toggle" id="themeToggle">
        <i class="fas fa-sun"></i>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Welcome Section -->
        <div class="dashboard-card">
            <div class="card-header">
                <h4 class="mb-0">Welcome to DISTRICT IV </h4>
            </div>
            <div class="card-body">
                <div class="welcome-section">
                    <div class="welcome-icon mt-3 ms-3">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="welcome-text mt-3">
                        <h4>Hello, <span class="resident-full-name"><?= isset($resident['full_name']) ? strtoupper(esc($resident['full_name'])) : 'Resident' ?></span>!</h4>
                        <p>Welcome to the Barangay Information and Management System. Please complete your profile and household information to access all features.</p>
                    </div>
                </div>
                
                <div class="progress-container mt-4">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="progress-steps">    
                        <div class="progress-step completed">Basic Info</div>
                        <div class="progress-step active">Contact Info</div>
                        <div class="progress-step">Household Details</div>
                        <div class="progress-step">Household Members</div>
                    </div>
                </div>
                
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle me-2"></i>
                    Your profile is currently incomplete. Please fill out the required information below.
                </div>
            </div>
        </div>

        <!-- Personal Information Registration Form -->
        <div class="dashboard-card">
            <div class="card-header">
                <h4 class="mb-0">Basic Info</h4>
                <span class="badge bg-primary">Step 1 of 2</span>
            </div>
            <div class="card-body">
                <form id="personalInfoForm" action="<?= base_url('dashboard/savePersonalInfo') ?>" method="POST">
                    <div class="form-section">
                        <h5 class="form-section-title" style="color: #20c997;"><i class="fas fa-user me-2"></i>Basic Info</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName" class="form-label">FIRST NAME</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required 
                                       placeholder="" value="<?= !empty($resident['first_name']) ? esc($resident['first_name']) : '' ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName" class="form-label">LAST NAME</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required 
                                       placeholder="" value="<?= !empty($resident['last_name']) ? esc($resident['last_name']) : '' ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="middleName" class="form-label">MIDDLE NAME</label>
                                <input type="text" class="form-control" id="middleName" name="middleName" 
                                       placeholder="" value="<?= !empty($resident['middle_name']) ? esc($resident['middle_name']) : '' ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="suffix" class="form-label">SUFFIX (Jr., Sr., III, etc.)</label>
                                <input type="text" class="form-control" id="suffix" name="suffix" 
                                       placeholder="" value="<?= !empty($resident['suffix']) ? esc($resident['suffix']) : '' ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="dateOfBirth" class="form-label">DATE OF BIRTH</label>
                                <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" required
                                       value="<?= !empty($resident['date_of_birth']) ? esc($resident['date_of_birth']) : '' ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">GENDER</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="" disabled <?= empty($resident['gender']) ? 'selected' : '' ?>>Select Gender</option>
                                    <option value="male" <?= (!empty($resident['gender']) && $resident['gender'] == 'male') ? 'selected' : '' ?>>Male</option>
                                    <option value="female" <?= (!empty($resident['gender']) && $resident['gender'] == 'female') ? 'selected' : '' ?>>Female</option>
                                    <option value="other" <?= (!empty($resident['gender']) && $resident['gender'] == 'other') ? 'selected' : '' ?>>Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="civilStatus" class="form-label">CIVIL STATUS</label>
                                <select class="form-select" id="civilStatus" name="civilStatus" required>
                                    <option value="" disabled <?= empty($resident['civil_status']) ? 'selected' : '' ?>>Select Status</option>
                                    <option value="single" <?= (!empty($resident['civil_status']) && $resident['civil_status'] == 'single') ? 'selected' : '' ?>>Single</option>
                                    <option value="married" <?= (!empty($resident['civil_status']) && $resident['civil_status'] == 'married') ? 'selected' : '' ?>>Married</option>
                                    <option value="divorced" <?= (!empty($resident['civil_status']) && $resident['civil_status'] == 'divorced') ? 'selected' : '' ?>>Divorced</option>
                                    <option value="widowed" <?= (!empty($resident['civil_status']) && $resident['civil_status'] == 'widowed') ? 'selected' : '' ?>>Widowed</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nationality" class="form-label">NATIONALITY</label>
                                <input type="text" class="form-control" id="nationality" name="nationality" 
                                       placeholder="" value="<?= !empty($resident['nationality']) ? esc($resident['nationality']) : 'Filipino' ?>">
                            </div>

                            <!-- Contact Info Fields Moved Here -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">EMAIL ADDRESS</label>
                                <input type="email" class="form-control" id="email" name="email" required 
                                       placeholder="" value="<?= !empty($resident['email']) ? esc($resident['email']) : '' ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">CONTACT NUMBER</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required 
                                       placeholder="" value="<?= !empty($resident['phone']) ? esc($resident['phone']) : '' ?>">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">ADDRESS</label>
                                <textarea class="form-control" id="address" name="address" rows="2" required
                                          placeholder=""><?= !empty($resident['address']) ? esc($resident['address']) : '' ?></textarea>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Save Basic Info
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Household Information Registration Form -->
        <div class="dashboard-card">
            <div class="card-header">
                <h4 class="mb-0">Household Information Registration</h4>
                <span class="badge bg-primary">Step 2 of 2</span>
            </div>
            <div class="card-body">
                <form id="householdRegistrationForm" action="<?= base_url('dashboard/saveResidentRegistration') ?>" method="POST">
                    <?= csrf_field() ?> <!-- Important: Add CSRF protection -->

                    <!-- Welcome Message -->
                    <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        <div>
                            Please complete your profile information!
                        </div>
                    </div>

                    <!-- Combined Registration Section -->
                    <div class="form-section mb-4"> 


                        <!-- Household Details Subsection -->
                        <h5 class="form-section-title text-primary"><i class="fas fa-home me-2"></i>Household Details</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="household_head" class="form-label">Household Head</label>
                                <input type="text" class="form-control" id="household_head" name="household_head" placeholder="Enter full name">
                            </div>
                            <div class="col-md-6">
                                <label for="house_type" class="form-label">House Type</label>
                                <select class="form-select" id="house_type" name="house_type">
                                    <option selected disabled value="">Select House Type</option>
                                    <option value="Owned">Owned</option>
                                    <option value="Rented">Rented</option>
                                    <option value="Living with Relatives">Living with Relatives</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="ownership_status" class="form-label">Ownership Status</label>
                                <select class="form-select" id="ownership_status" name="ownership_status">
                                    <option selected disabled value="">Select Status</option>
                                    <option value="Owner">Owner</option>
                                    <option value="Renter">Renter</option>
                                    <option value="Sharer">Sharer</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="number_of_rooms" class="form-label">Number of Rooms</label>
                                <input type="number" class="form-control" id="number_of_rooms" name="number_of_rooms" min="1">
                            </div>
                            <div class="col-12">
                                <label for="household_address" class="form-label">Household Address</label>
                                <textarea class="form-control" id="household_address" name="household_address" rows="3" placeholder="Enter household address"></textarea>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Household Members Subsection -->
                        <h5 class="form-section-title text-info"><i class="fas fa-users me-2"></i>Household Members</h5>
                        <div class="alert alert-secondary d-flex align-items-center" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <div>
                                Add all members of your household, including yourself.
                            </div>
                        </div>

                        <div id="household-members-container">
                            <!-- Initial member row (can be pre-filled or empty) -->
                            <div class="row g-3 align-items-end household-member-row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="members[0][full_name]" placeholder="Full Name">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Relationship</label>
                                    <select class="form-select" name="members[0][relationship]">
                                        <option selected disabled value="">Select</option>
                                        <option value="Head">Head</option>
                                        <option value="Spouse">Spouse</option>
                                        <option value="Child">Child</option>
                                        <option value="Parent">Parent</option>
                                        <option value="Sibling">Sibling</option>
                                        <option value="Other Relative">Other Relative</option>
                                        <option value="Non-Relative">Non-Relative</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Age</label>
                                    <input type="number" class="form-control" name="members[0][age]" min="0">
                                </div>
                                <div class="col-md-auto">
                                    <!-- Add a remove button for dynamically added rows -->
                                    <button type="button" class="btn btn-danger remove-member-btn" style="display: none;"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                            <!-- Member rows will be added here by JavaScript -->
                        </div>

                        <button type="button" class="btn btn-outline-success mt-2 mb-4" id="add-household-member-btn">
                            <i class="fas fa-plus me-1"></i> Add Household Member
                        </button>
                    
                    </div> <!-- End Combined Registration Section -->

                    <!-- Main Submit Button -->
                    <div class="d-grid gap-2">
                         <button type="submit" class="btn btn-primary btn-lg">Save Registration Details</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap and jQuery Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Function to toggle dark/light theme
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            // Update theme toggle button icon
            const themeToggleIcon = document.querySelector('.theme-toggle i');
            if (themeToggleIcon) {
                themeToggleIcon.className = newTheme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
            }
        }
        
        // Apply saved theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                document.documentElement.setAttribute('data-theme', savedTheme);
                
                // Update theme toggle button icon
                const themeToggleIcon = document.querySelector('.theme-toggle i');
                if (themeToggleIcon) {
                    themeToggleIcon.className = savedTheme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
                }
            }
            
            // Add theme toggle event listener
            const themeToggle = document.querySelector('.theme-toggle');
            if (themeToggle) {
                themeToggle.addEventListener('click', toggleTheme);
            }
            
            // Get resident's full name from the page and update welcome message
            const fullNameElement = document.querySelector('.resident-full-name');
            if (fullNameElement) {
                // Simply keep the original name without splitting it
                // No need to modify the welcome message
            }
        });

        // Simple script to add household members dynamically
        document.getElementById('add-household-member-btn').addEventListener('click', function() {
            const membersContainer = document.getElementById('household-members-container');
            const newMember = document.createElement('div');
            newMember.className = 'row g-3 align-items-end household-member-row mb-3';
            newMember.innerHTML = `
                <div class="col-md-4">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="members[${membersContainer.children.length}][full_name]" placeholder="Full Name">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Relationship</label>
                    <select class="form-select" name="members[${membersContainer.children.length}][relationship]">
                        <option selected disabled value="">Select</option>
                        <option value="Head">Head</option>
                        <option value="Spouse">Spouse</option>
                        <option value="Child">Child</option>
                        <option value="Parent">Parent</option>
                        <option value="Sibling">Sibling</option>
                        <option value="Other Relative">Other Relative</option>
                        <option value="Non-Relative">Non-Relative</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Age</label>
                    <input type="number" class="form-control" name="members[${membersContainer.children.length}][age]" min="0">
                </div>
                <div class="col-md-auto">
                    <!-- Add a remove button for dynamically added rows -->
                    <button type="button" class="btn btn-danger remove-member-btn">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
            membersContainer.appendChild(newMember);
        });

        // Event delegation for removing members
        document.getElementById('household-members-container').addEventListener('click', function(e) {
            if (e.target.closest('.remove-member-btn')) {
                e.target.closest('.household-member-row').remove();
            }
        });

        // Basic Info Form Submission Handler
        document.getElementById('personalInfoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            
            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
            
            // Send AJAX request
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-success alert-dismissible fade show';
                    alertDiv.innerHTML = `
                        <i class="fas fa-check-circle me-2"></i>${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    this.insertBefore(alertDiv, this.firstChild);
                    
                    // Update progress bar
                    const progressBar = document.querySelector('.progress-bar');
                    if (progressBar) {
                        progressBar.style.width = '50%';
                        progressBar.setAttribute('aria-valuenow', '50');
                    }
                    
                    // Update progress steps
                    const progressSteps = document.querySelectorAll('.progress-step');
                    if (progressSteps.length >= 2) {
                        progressSteps[1].classList.add('completed');
                        progressSteps[2].classList.add('active');
                    }
                    
                    // Update welcome message if name changed
                    const fullNameElement = document.querySelector('.resident-full-name');
                    if (fullNameElement && data.resident_name) {
                        fullNameElement.textContent = data.resident_name.toUpperCase();
                    }
                } else {
                    // Show error message
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-danger alert-dismissible fade show';
                    alertDiv.innerHTML = `
                        <i class="fas fa-exclamation-circle me-2"></i>${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    this.insertBefore(alertDiv, this.firstChild);
                }
            })
            .catch(error => {
                // Show error message
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-danger alert-dismissible fade show';
                alertDiv.innerHTML = `
                    <i class="fas fa-exclamation-circle me-2"></i>An error occurred while saving. Please try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                this.insertBefore(alertDiv, this.firstChild);
            })
            .finally(() => {
                // Reset button state
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            });
        });

        // Household Registration Form Submission Handler
        document.getElementById('householdRegistrationForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form data
            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;

            // Clear previous alerts
            const existingAlert = this.querySelector('.alert');
            if (existingAlert) {
                existingAlert.remove();
            }

            // Show loading state
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';

            // Include CSRF token if present
            const csrfInput = this.querySelector('input[name="csrf_test_name"]');
            if (csrfInput) {
                 formData.append(csrfInput.name, csrfInput.value);
            }

            // Send AJAX request
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Update CSRF token if provided in response (good practice)
                if (data.csrf_token) {
                    if (csrfInput) {
                        csrfInput.value = data.csrf_token;
                    }
                }
                
                if (data.success) {
                    // Show success message
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-success alert-dismissible fade show mt-3';
                    alertDiv.innerHTML = `
                        <i class="fas fa-check-circle me-2"></i>${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    this.insertAdjacentElement('afterbegin', alertDiv);

                    // Update progress bar to 100%
                    const progressBar = document.querySelector('.progress-bar');
                    if (progressBar) {
                        progressBar.style.width = '100%';
                        progressBar.setAttribute('aria-valuenow', '100');
                    }

                    // Update progress steps (mark all as completed)
                    const progressSteps = document.querySelectorAll('.progress-step');
                    progressSteps.forEach(step => step.classList.add('completed'));
                    progressSteps.forEach(step => step.classList.remove('active')); 
                    
                    // Optionally, redirect or disable form after success
                     // submitButton.textContent = 'Saved Successfully';
                     // window.location.href = '<?= base_url("dashboard/profile") ?>'; // Redirect to profile

                } else {
                    // Show error message (including validation errors)
                    let errorMessage = data.message;
                    if (data.errors) {
                        errorMessage += '<br><ul>';
                        for (const field in data.errors) {
                            errorMessage += `<li>${data.errors[field]}</li>`;
                        }
                        errorMessage += '</ul>';
                    }

                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-danger alert-dismissible fade show mt-3';
                    alertDiv.innerHTML = `
                        <i class="fas fa-exclamation-circle me-2"></i>${errorMessage}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    this.insertAdjacentElement('afterbegin', alertDiv);
                }
            })
            .catch(error => {
                console.error('Error submitting household form:', error);
                // Show generic error message
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-danger alert-dismissible fade show mt-3';
                alertDiv.innerHTML = `
                    <i class="fas fa-exclamation-circle me-2"></i>An error occurred while saving. Please try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                this.insertAdjacentElement('afterbegin', alertDiv);
            })
            .finally(() => {
                // Reset button state
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            });
        });
    </script>
</body>
</html> 