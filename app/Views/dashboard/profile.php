<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - BIMS</title>
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
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            margin-bottom: 25px;
            transition: transform 0.3s, background-color 0.3s, box-shadow 0.3s;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0b5ed7 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 18px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 600;
            font-size: 1.3rem;
        }

        .card-header .badge {
            font-size: 0.8rem;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        /* Profile Styles */
        .profile-header {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 35px;
            padding: 20px;
            background: linear-gradient(to right, rgba(13, 110, 253, 0.05), rgba(13, 110, 253, 0.1));
            border-radius: 15px;
        }

        .profile-avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color) 0%, #0b5ed7 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 60px;
            box-shadow: 0 0 25px rgba(13, 110, 253, 0.4);
            position: relative;
            overflow: hidden;
            border: 5px solid white;
        }

        .profile-avatar img.profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        .profile-avatar .avatar-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .profile-avatar .avatar-edit {
            position: absolute;
            bottom: 0;
            right: 0;
            background: var(--primary-color);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            border: 3px solid white;
        }

        .profile-avatar .avatar-edit:hover {
            background: #0b5ed7;
            transform: scale(1.1);
        }

        .profile-info h2 {
            margin-bottom: 8px;
            font-weight: 700;
            font-size: 2rem;
            color: var(--primary-color);
        }

        .profile-info p {
            margin-bottom: 0;
            color: var(--secondary-color);
            font-size: 1.1rem;
        }

        .profile-stats {
            display: flex;
            gap: 20px;
            margin-top: 20px;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .profile-stat {
            text-align: center;
            padding: 15px 25px;
            border-radius: 10px;
            transition: all 0.3s;
            border: 1px solid var(--border-color);
        }

        .profile-stat:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .profile-stat h5 {
            font-size: 1.8rem;
            margin-bottom: 5px;
            font-weight: 700;
            color: var(--primary-color);
        }

        .profile-stat p {
            font-size: 0.9rem;
            margin-bottom: 0;
            color: var(--secondary-color);
            font-weight: 500;
        }

        .profile-upload-btn .btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
            background: linear-gradient(135deg, var(--primary-color) 0%, #0b5ed7 100%);
            border: none;
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
        }

        .profile-upload-btn .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(13, 110, 253, 0.4);
        }

        .profile-upload-btn .btn i {
            font-size: 1.1rem;
        }

        .upload-btn {
            position: relative;
            overflow: hidden;
            padding: 10px 20px;
            font-size: 1rem;
            letter-spacing: 0.5px;
            border-radius: 30px;
            background: linear-gradient(45deg, var(--primary-color), #0b5ed7);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.4);
            transition: all 0.3s ease;
        }

        .upload-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.5);
            background: linear-gradient(45deg, #0b5ed7, var(--primary-color));
        }

        .upload-btn:active {
            transform: translateY(1px);
            box-shadow: 0 2px 10px rgba(13, 110, 253, 0.3);
        }

        .upload-btn i {
            margin-right: 8px;
            font-size: 1.2rem;
        }

        .profile-tabs {
            margin-bottom: 25px;
            border-bottom: 1px solid var(--border-color);
            padding: 0 10px;
        }

        .profile-tabs .nav-link {
            color: var(--text-color);
            border: none;
            padding: 12px 20px;
            border-radius: 8px 8px 0 0;
            transition: all 0.3s;
            font-weight: 500;
            margin-right: 5px;
        }

        .profile-tabs .nav-link:hover {
            background-color: var(--form-bg);
            color: var(--primary-color);
        }

        .profile-tabs .nav-link.active {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
        }

        .profile-tabs .nav-link i {
            margin-right: 8px;
        }

        .profile-content {
            padding: 25px;
            background-color: var(--card-bg);
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
        }

        .profile-section {
            margin-bottom: 35px;
            padding-bottom: 25px;
            border-bottom: 1px solid var(--border-color);
        }

        .profile-section:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .profile-section-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--primary-color);
        }

        .profile-section-title i {
            color: var(--primary-color);
            font-size: 1.4rem;
        }

        .profile-field {
            margin-bottom: 20px;
            padding: 15px;
            background: var(--form-bg);
            border-radius: 10px;
            transition: all 0.3s;
        }

        .profile-field:hover {
            transform: translateX(5px);
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }

        .profile-field-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--secondary-color);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .profile-field-value {
            font-size: 1.1rem;
            color: var(--text-color);
        }

        .profile-actions {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .profile-actions .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .profile-actions .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .profile-actions .btn i {
            margin-right: 8px;
        }

        /* Table Styles */
        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }

        .table thead th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
            border: none;
            padding: 12px 15px;
        }

        .table tbody tr {
            transition: all 0.3s;
        }

        .table tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.05);
        }

        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .btn-sm {
            padding: 5px 10px;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .btn-sm:hover {
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
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
            .profile-stats {
                justify-content: center;
                flex-wrap: wrap;
            }
            .profile-tabs .nav-link {
                padding: 8px 12px;
                font-size: 0.9rem;
            }
            .profile-tabs .nav-link i {
                margin-right: 0;
            }
            .profile-tabs .nav-link span {
                display: none;
            }
        }

        /* Change Password Section Styles */
        .toggle-password {
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .toggle-password:hover {
            background-color: var(--input-bg);
        }

        .form-text {
            color: var(--muted-text);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Change Password Form Styles */
        .password-form {
            max-width: 100%;
            padding: 20px;
            background: var(--form-bg);
            border-radius: 10px;
        }

        .password-input-group {
            max-width: 300px;
        }

        .password-input-group .form-control {
            border-right: none;
            height: 45px;
        }

        .password-input-group .toggle-password {
            border-left: none;
            background: var(--input-bg);
            width: 45px;
        }

        .password-input-group .toggle-password:hover {
            background: var(--border-color);
        }

        .form-text ul {
            max-width: 300px;
            padding-left: 20px;
            margin-top: 10px;
        }

        .form-text ul li {
            margin-bottom: 5px;
            color: var(--secondary-color);
            font-size: 0.85rem;
        }

        .password-form .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .password-form .btn {
            height: 45px;
            padding: 0 20px;
        }

        .password-form .btn-primary {
            background: var(--primary-color);
            border: none;
            font-weight: 500;
        }

        .password-form .btn-outline-secondary {
            border-color: var(--border-color);
            color: var(--text-color);
        }

        .password-form .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .password-section-info {
            background: rgba(13, 110, 253, 0.05);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid var(--primary-color);
        }

        .password-section-info p {
            margin: 0;
            color: var(--text-color);
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center mb-4">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="BIMS Logo" height="50" class="mb-2">
            <h5 class="text-white">Resident Portal</h5>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard/resident') ?>">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?= base_url('dashboard/profile') ?>">
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
        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <!-- Profile Header -->
        <div class="dashboard-card">
            <div class="card-header">
                <h4 class="mb-0">My Profile</h4>
            </div>
            <div class="card-body">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <?php if (!empty($resident['profile_picture'])): ?>
                            <img src="<?= $resident['profile_picture'] ?>" alt="Profile Picture" class="profile-image">
                        <?php else: ?>
                        <div class="avatar-placeholder">
                            <i class="fas fa-user"></i>
                        </div>
                        <?php endif; ?>

                        <input type="file" id="profilePicInput" class="d-none" accept="image/*">
                    </div>
                    <div class="profile-info">
                        <h2><?= !empty($resident['full_name']) ? strtoupper(esc($resident['full_name'])) : '' ?></h2>
                        <p><i class="fas fa-envelope me-2"></i><?= !empty($resident['email']) ? esc($resident['email']) : '' ?></p>
                        <p><i class="fas fa-phone me-2"></i><?= !empty($resident['phone']) ? esc($resident['phone']) : '' ?></p>
                        <p><i class="fas fa-map-marker-alt me-2"></i><?= !empty($resident['address']) ? esc($resident['address']) : '' ?></p>
                        <div class="mt-3">
                            <button class="btn btn-primary btn-sm" onclick="document.getElementById('profilePicInput').click()">
                                <i class="fas fa-upload me-2"></i>Upload Profile Picture
                            </button>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs profile-tabs" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" aria-controls="personal" aria-selected="true">
                            <i class="fas fa-user-circle"></i> Personal Information
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                            <i class="fas fa-address-card"></i> Household Details
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab" aria-controls="password" aria-selected="false">
                            <i class="fas fa-key"></i> Change Password
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="profileTabsContent">
                    <!-- Personal Information Tab -->
                    <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                        <div class="profile-content">
                            <div class="profile-section">
                                <h5 class="profile-section-title">
                                    <i class="fas fa-user"></i> Basic Information
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="profile-field">
                                            <div class="profile-field-label">FULL NAME</div>
                                            <div class="profile-field-value resident-full-name"><?= strtoupper(esc($resident['full_name'])) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="profile-field">
                                            <div class="profile-field-label">EMAIL ADDRESS</div>
                                            <div class="profile-field-value"><?= !empty($resident['email']) ? esc($resident['email']) : '' ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="profile-field">
                                            <div class="profile-field-label">PHONE NUMBER</div>
                                            <div class="profile-field-value"><?= !empty($resident['phone']) ? esc($resident['phone']) : '' ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="profile-field">
                                            <div class="profile-field-label">ADDRESS</div>
                                            <div class="profile-field-value"><?= !empty($resident['address']) ? esc($resident['address']) : '' ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="profile-field">
                                            <div class="profile-field-label">SUFFIX (Jr., Sr., III, etc.)</div>
                                            <div class="profile-field-value"><?= !empty($resident['suffix']) ? esc($resident['suffix']) : '' ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="profile-field">
                                            <div class="profile-field-label">DATE OF BIRTH</div>
                                            <div class="profile-field-value"><?= !empty($resident['date_of_birth']) ? date('F j, Y', strtotime($resident['date_of_birth'])) : '' ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="profile-field">
                                            <div class="profile-field-label">GENDER</div>
                                            <div class="profile-field-value"><?= !empty($resident['gender']) ? ucfirst(esc($resident['gender'])) : '' ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="profile-field">
                                            <div class="profile-field-label">CIVIL STATUS</div>
                                            <div class="profile-field-value"><?= !empty($resident['civil_status']) ? ucfirst(esc($resident['civil_status'])) : '' ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="profile-field">
                                            <div class="profile-field-label">NATIONALITY</div>
                                            <div class="profile-field-value"><?= !empty($resident['nationality']) ? esc($resident['nationality']) : '' ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-section">
                                <h5 class="profile-section-title">
                                    <i class="fas fa-clock"></i> Account Information
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="profile-field">
                                            <div class="profile-field-label">Member Since</div>
                                            <div class="profile-field-value"><?= date('F j, Y', strtotime($resident['created_at'])) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="profile-field">
                                            <div class="profile-field-label">Last Updated</div>
                                            <div class="profile-field-value"><?= date('F j, Y', strtotime($resident['updated_at'])) ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Tab -->
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="profile-content">
                            
                            <div class="profile-section">
                                <h5 class="profile-section-title">
                                    <i class="fas fa-house-user"></i> Household Details
                                </h5>
                                <?php if (isset($household) && $household) : ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="profile-field">
                                                <div class="profile-field-label">HOUSEHOLD HEAD</div>
                                                <div class="profile-field-value"><?= esc($household['household_head']) ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="profile-field">
                                                <div class="profile-field-label">HOUSE TYPE</div>
                                                <div class="profile-field-value"><?= esc($household['house_type']) ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="profile-field">
                                                <div class="profile-field-label">OWNERSHIP STATUS</div>
                                                <div class="profile-field-value"><?= esc($household['ownership_status']) ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="profile-field">
                                                <div class="profile-field-label">NUMBER OF ROOMS</div>
                                                <div class="profile-field-value"><?= esc($household['number_of_rooms']) ?></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="profile-field">
                                                <div class="profile-field-label">HOUSEHOLD ADDRESS</div>
                                                <div class="profile-field-value"><?= esc($household['household_address']) ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="alert alert-info">No household details found. Please complete your profile on the dashboard.</div>
                                <?php endif; ?>
                            </div>
                            <div class="profile-section">
                                <h5 class="profile-section-title">
                                    <i class="fas fa-users"></i> Household Members
                                </h5>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Relationship</th>
                                                <th>Age</th>
                                                <th>Occupation</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="householdMembersTableBody">
                                            <?php if (isset($members) && !empty($members)) : ?>
                                                <?php foreach ($members as $member) : ?>
                                                    <tr id="member-row-<?= esc($member['id']) ?>">
                                                        <td><?= esc($member['full_name']) ?></td>
                                                        <td><?= esc($member['relationship']) ?></td>
                                                        <td><?= esc($member['age']) ?></td>
                                                        <td><?= '' // Placeholder for Occupation - Add this field later if needed ?></td> 
                                                        <td>
                                                            <button class="btn btn-danger btn-sm delete-member-btn" data-member-id="<?= esc($member['id']) ?>" title="Delete Member">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="5" class="text-center">No household members added yet.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Change Password Tab -->
                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                        <div class="profile-content" style="background-color: #212529; color: #ffffff;">
                            <div class="profile-section">
                                <h5 class="profile-section-title" style="color: #0d6efd; border-bottom: 1px solid #343a40;">
                                    <i class="fas fa-key"></i> Change Your Password
                                </h5>
                                <div class="alert alert-info bg-dark text-info border-info">
                                    <i class="fas fa-info-circle me-2"></i>Ensure your account security by choosing a strong password that meets all the requirements below.
                                </div>
                                
                                <form action="<?= base_url('dashboard/change-password') ?>" method="POST" class="mt-4" id="passwordChangeForm">
                                    <div class="mb-4">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control bg-dark text-light border-secondary" id="current_password" name="current_password" required autocomplete="off">
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control bg-dark text-light border-secondary" id="new_password" name="new_password" required autocomplete="off">
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        
                                        <div class="mt-3">
                                            <ul class="list-unstyled">
                                                <li class="text-success mb-2"><i class="fas fa-check-circle me-2"></i>At least 8 characters long</li>
                                                <li class="text-success mb-2"><i class="fas fa-check-circle me-2"></i>Must contain at least one number</li>
                                                <li class="text-success mb-2"><i class="fas fa-check-circle me-2"></i>Must contain at least one special character</li>
                                                <li class="text-success mb-2"><i class="fas fa-check-circle me-2"></i>Must contain at least one uppercase letter</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control bg-dark text-light border-secondary" id="confirm_password" name="confirm_password" required autocomplete="off">
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex gap-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-key me-2"></i>Update Password
                                        </button>
                                        <button type="reset" class="btn btn-outline-secondary">
                                            <i class="fas fa-undo me-2"></i>Reset
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>

    <script>
        // Theme toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeToggle');
            const html = document.documentElement;
            const icon = themeToggle.querySelector('i');
            
            // Check for saved theme preference or use default
            const savedTheme = localStorage.getItem('theme') || 'light';
            html.setAttribute('data-theme', savedTheme);
            updateIcon(savedTheme);
            
            // Toggle theme on button click
            themeToggle.addEventListener('click', function() {
                const currentTheme = html.getAttribute('data-theme');
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                
                html.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateIcon(newTheme);
            });
            
            // Update icon based on theme
            function updateIcon(theme) {
                if (theme === 'light') {
                    icon.className = 'fas fa-sun';
                } else {
                    icon.className = 'fas fa-moon';
                }
            }
            
            // Clear password form if needed
            <?php if(session()->getFlashdata('clear_form')): ?>
            const passwordInputs = document.querySelectorAll('input[type="password"]');
            passwordInputs.forEach(input => {
                input.value = '';
            });
            <?php endif; ?>

            // Profile picture upload functionality
            const profilePicInput = document.getElementById('profilePicInput');
            const profileAvatar = document.querySelector('.profile-avatar');

            if (profilePicInput) {
                profilePicInput.addEventListener('change', function(e) {
                    if (e.target.files && e.target.files[0]) {
                        const file = e.target.files[0];
                        
                        // Validate file type
                        if (!file.type.match('image.*')) {
                            alert('Please select an image file (jpg, jpeg, png)');
                            return;
                        }
                        
                        // Validate file size (max 2MB)
                        if (file.size > 2 * 1024 * 1024) {
                            alert('File size should not exceed 2MB');
                            return;
                        }
                        
                        // Preview the image
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            // Create or update image element
                            let img = profileAvatar.querySelector('img.profile-image');
                            const placeholder = profileAvatar.querySelector('.avatar-placeholder');
                            
                            if (!img) {
                                img = document.createElement('img');
                                img.className = 'profile-image';
                                if (placeholder) {
                                    placeholder.remove();
                                }
                                profileAvatar.insertBefore(img, profileAvatar.firstChild);
                            }
                            
                            // Update image source
                            img.src = e.target.result;
                            img.alt = 'Profile Picture';
                            
                            // Upload the image
                            uploadProfilePicture(file);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Function to upload profile picture
            function uploadProfilePicture(file) {
                const formData = new FormData();
                formData.append('profile_picture', file);
                formData.append('resident_id', '<?= session()->get('resident_id') ?>');
                
                // Show loading state
                const uploadBtn = document.querySelector('.btn-primary.btn-sm');
                if (uploadBtn) {
                    const originalText = uploadBtn.innerHTML;
                    uploadBtn.disabled = true;
                    uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Uploading...';
                }
                
                // Send AJAX request
                fetch('<?= base_url('residents/uploadProfilePicture') ?>', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert('Error: ' + data.error);
                    } else {
                        // Update the profile picture in the UI
                        const img = profileAvatar.querySelector('img.profile-image');
                        if (img) {
                            img.src = data.profile_picture_url;
                        }
                        alert('Profile picture updated successfully');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while uploading the profile picture');
                })
                .finally(() => {
                    // Reset button state
                    if (uploadBtn) {
                        uploadBtn.disabled = false;
                        uploadBtn.innerHTML = '<i class="fas fa-upload me-2"></i>Upload Profile Picture';
                    }
                });
            }
        });

        // Password visibility toggle
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // Form submission handling
        document.getElementById('passwordChangeForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your password change logic here
            alert('Password change functionality will be implemented soon!');
        });

        // Household Member Deletion Handler
        const tableBody = document.getElementById('householdMembersTableBody');
        if (tableBody) {
            tableBody.addEventListener('click', function(e) {
                const deleteButton = e.target.closest('.delete-member-btn');
                if (!deleteButton) {
                    return; // Click wasn't on a delete button
                }

                const memberId = deleteButton.dataset.memberId;
                if (!memberId) {
                    console.error('Member ID not found on button.');
                    return;
                }

                if (confirm('Are you sure you want to delete this household member?')) {
                    // Disable button during request
                    deleteButton.disabled = true;
                    deleteButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                    fetch(`<?= base_url('dashboard/deleteMember/') ?>${memberId}`, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove the table row
                            const rowToRemove = document.getElementById(`member-row-${memberId}`);
                            if (rowToRemove) {
                                rowToRemove.remove();
                                alert(data.message);
                                
                                // Check if table is now empty
                                if (tableBody.querySelectorAll('tr').length === 0) {
                                     tableBody.innerHTML = '<tr><td colspan="5" class="text-center">No household members added yet.</td></tr>';
                                }
                            } else {
                                alert('Could not find the row to remove.');
                            }
                        } else {
                            alert('Error deleting member: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error deleting member:', error);
                        alert('An error occurred while trying to delete the member.');
                    })
                    .finally(() => {
                        // Re-enable button
                        deleteButton.disabled = false;
                        deleteButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
                    });
                }
            });
        }
    </script>
</body>
</html> 