<!DOCTYPE html>
<html lang="en">
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
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--dark-color);
            color: white;
            padding-top: 20px;
            transition: all 0.3s;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            margin: 4px 0;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .sidebar .nav-link.active {
            background: var(--primary-color);
            color: white;
        }

        .sidebar .nav-link i {
            width: 25px;
            margin-right: 10px;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
        }

        /* Card Styles */
        .dashboard-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            transition: transform 0.3s;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
        }

        /* Profile Section */
        .profile-section {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px;
        }

        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-color);
        }

        /* Stats Cards */
        .stats-card {
            text-align: center;
            padding: 20px;
        }

        .stats-card i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--primary-color);
        }

        /* Form Styles */
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
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
                <a class="nav-link active" href="#dashboard">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#profile">
                    <i class="fas fa-user"></i>
                    <span>My Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#household">
                    <i class="fas fa-house-user"></i>
                    <span>Household Info</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#documents">
                    <i class="fas fa-file-alt"></i>
                    <span>Documents</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#requests">
                    <i class="fas fa-clipboard-list"></i>
                    <span>My Requests</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#announcements">
                    <i class="fas fa-bullhorn"></i>
                    <span>Announcements</span>
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

    <!-- Main Content -->
    <div class="main-content">
        <!-- Welcome Section -->
        <div class="dashboard-card">
            <div class="card-header">
                <h4 class="mb-0">Welcome, [Resident Name]</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-card">
                            <i class="fas fa-file-alt"></i>
                            <h3>5</h3>
                            <p>Documents</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <i class="fas fa-clipboard-check"></i>
                            <h3>2</h3>
                            <p>Pending Requests</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <i class="fas fa-bell"></i>
                            <h3>3</h3>
                            <p>New Announcements</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <i class="fas fa-calendar-check"></i>
                            <h3>1</h3>
                            <p>Upcoming Events</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Personal Information Section -->
        <div class="dashboard-card">
            <div class="card-header">
                <h4 class="mb-0">Personal Information</h4>
            </div>
            <div class="card-body">
                <div class="profile-section">
                    <img src="<?= base_url('assets/img/default-profile.png') ?>" alt="Profile" class="profile-image">
                    <div class="profile-info">
                        <h5>Personal Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Full Name:</strong> [Full Name]</p>
                                <p><strong>Date of Birth:</strong> [Date of Birth]</p>
                                <p><strong>Gender:</strong> [Gender]</p>
                                <p><strong>Civil Status:</strong> [Civil Status]</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Contact Number:</strong> [Contact Number]</p>
                                <p><strong>Email:</strong> [Email]</p>
                                <p><strong>Address:</strong> [Address]</p>
                                <p><strong>Occupation:</strong> [Occupation]</p>
                            </div>
                        </div>
                        <button class="btn btn-primary mt-3">
                            <i class="fas fa-edit"></i> Edit Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Household Information Section -->
        <div class="dashboard-card">
            <div class="card-header">
                <h4 class="mb-0">Household Information</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Household Details</h5>
                        <p><strong>Household ID:</strong> [Household ID]</p>
                        <p><strong>Household Head:</strong> [Household Head Name]</p>
                        <p><strong>Number of Members:</strong> [Number]</p>
                        <p><strong>House Type:</strong> [House Type]</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Household Members</h5>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                [Member Name]
                                <span class="badge bg-primary rounded-pill">Head</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                [Member Name]
                                <span class="badge bg-secondary rounded-pill">Member</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                [Member Name]
                                <span class="badge bg-secondary rounded-pill">Member</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-primary mt-3">
                    <i class="fas fa-edit"></i> Update Household Info
                </button>
            </div>
        </div>

        <!-- Recent Documents Section -->
        <div class="dashboard-card">
            <div class="card-header">
                <h4 class="mb-0">Recent Documents</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Document Name</th>
                                <th>Type</th>
                                <th>Date Issued</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Barangay ID</td>
                                <td>Identification</td>
                                <td>2024-03-15</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Certificate of Residency</td>
                                <td>Certificate</td>
                                <td>2024-03-10</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Request New Document
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 