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
                <span class="badge bg-warning text-dark">Profile Incomplete</span>
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
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Save Basic Info
                            </button>
                        </div>
                    </div>

                    <div class="form-section">
                        <h5 class="form-section-title"><i class="fas fa-address-card me-2"></i>Contact Information</h5>
                        <div class="row">
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
                                <i class="fas fa-save me-2"></i>Save Contact Info
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
                <form id="householdForm">
                    <div class="form-section">
                        <h5 class="form-section-title"><i class="fas fa-house-user me-2"></i>Household Details</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="householdHead" class="form-label">Household Head</label>
                                <input type="text" class="form-control" id="householdHead" required placeholder="Enter name of household head">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="houseType" class="form-label">House Type</label>
                                <select class="form-select" id="houseType" required>
                                    <option value="" selected disabled>Select House Type</option>
                                    <option value="apartment">Apartment</option>
                                    <option value="single_house">Single House</option>
                                    <option value="duplex">Duplex</option>
                                    <option value="condominium">Condominium</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="ownershipStatus" class="form-label">Ownership Status</label>
                                <select class="form-select" id="ownershipStatus" required>
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="owned">Owned</option>
                                    <option value="rented">Rented</option>
                                    <option value="borrowed">Borrowed</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="numberOfRooms" class="form-label">Number of Rooms</label>
                                <input type="number" class="form-control" id="numberOfRooms" min="1" required placeholder="Enter number of rooms">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="householdAddress" class="form-label">Household Address</label>
                                <textarea class="form-control" id="householdAddress" rows="2" required placeholder="Enter your household address"></textarea>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Save Household Details
                            </button>
                        </div>
                    </div>

                    <div class="form-section">
                        <h5 class="form-section-title"><i class="fas fa-users me-2"></i>Household Members</h5>
                        <div class="alert alert-info mb-3">
                            <i class="fas fa-info-circle me-2"></i>
                            Add all members of your household, including yourself.
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <button type="button" class="btn btn-outline-primary" id="addMemberBtn">
                                    <i class="fas fa-plus me-2"></i>Add Household Member
                                </button>
                            </div>
                        </div>
                        <div id="householdMembers">
                            <!-- Member entries will be added here dynamically -->
                            <div class="row member-entry mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" placeholder="Enter full name" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Relationship</label>
                                    <select class="form-select">
                                        <option value="" selected disabled>Select</option>
                                        <option value="self">Self</option>
                                        <option value="spouse">Spouse</option>
                                        <option value="child">Child</option>
                                        <option value="parent">Parent</option>
                                        <option value="sibling">Sibling</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Age</label>
                                    <input type="number" class="form-control" min="0" max="120" required placeholder="Age">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="button" class="btn btn-danger form-control remove-member">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Save Household Members
                            </button>
                        </div>
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
        document.getElementById('addMemberBtn').addEventListener('click', function() {
            const membersContainer = document.getElementById('householdMembers');
            const newMember = document.createElement('div');
            newMember.className = 'row member-entry mb-3';
            newMember.innerHTML = `
                <div class="col-md-4">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" placeholder="Enter full name" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Relationship</label>
                    <select class="form-select">
                        <option value="" selected disabled>Select</option>
                        <option value="self">Self</option>
                        <option value="spouse">Spouse</option>
                        <option value="child">Child</option>
                        <option value="parent">Parent</option>
                        <option value="sibling">Sibling</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Age</label>
                    <input type="number" class="form-control" min="0" max="120" required placeholder="Age">
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <button type="button" class="btn btn-danger form-control remove-member">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
            membersContainer.appendChild(newMember);
        });

        // Event delegation for removing members
        document.getElementById('householdMembers').addEventListener('click', function(e) {
            if (e.target.closest('.remove-member')) {
                e.target.closest('.member-entry').remove();
            }
        });
    </script>
</body>
</html> 