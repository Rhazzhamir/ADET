<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Request - BIMS</title>
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

        /* Certificate Request Form Styles */
        .certificate-form {
            padding: 20px;
        }

        .form-section {
            background-color: var(--form-bg);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid var(--border-color);
        }

        .form-section-title {
            color: var(--primary-color);
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-section-title i {
            font-size: 1.2rem;
        }

        /* Certificate Type Cards */
        .certificate-types {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .certificate-type-card {
            background: var(--card-bg);
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .certificate-type-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .certificate-type-card.selected {
            border-color: var(--primary-color);
            background-color: rgba(13, 110, 253, 0.05);
        }

        .certificate-type-card i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .certificate-type-card h5 {
            margin-bottom: 10px;
            color: var(--text-color);
        }

        .certificate-type-card p {
            color: var(--secondary-color);
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        /* Request History Table */
        .request-history {
            margin-top: 30px;
        }

        .request-history .table {
            background: var(--card-bg);
            border-radius: 10px;
            overflow: hidden;
        }

        .request-history th {
            background: var(--primary-color);
            color: white;
            font-weight: 500;
            border: none;
        }

        .request-history td {
            vertical-align: middle;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-pending {
            background-color: var(--warning-color);
            color: #000;
        }

        .status-approved {
            background-color: var(--success-color);
            color: white;
        }

        .status-rejected {
            background-color: var(--danger-color);
            color: white;
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
            .certificate-types {
                grid-template-columns: 1fr;
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
                <a class="nav-link" href="<?= base_url('dashboard/resident') ?>">
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
                <a class="nav-link active" href="<?= base_url('dashboard/certificate-request') ?>">
                    <i class="fas fa-file-alt"></i>
                    <span>Certificate Request</span>
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

        <!-- Certificate Request Form -->
        <div class="dashboard-card">
            <div class="card-header">
                <h4 class="mb-0">Certificate Request</h4>
            </div>
            <div class="card-body">
                <form id="certificateRequestForm" action="<?= base_url('dashboard/submit-certificate-request') ?>" method="POST">
                    <!-- Certificate Type Selection -->
                    <div class="form-section">
                        <h5 class="form-section-title">
                            <i class="fas fa-file-certificate"></i>Select Certificate Type
                        </h5>
                        <div class="certificate-types">
                            <div class="certificate-type-card" data-type="barangay-clearance">
                                <i class="fas fa-file-signature"></i>
                                <h5>Barangay Clearance</h5>
                                <p>Official document certifying your good standing in the barangay.</p>
                            </div>
                            <div class="certificate-type-card" data-type="indigency">
                                <i class="fas fa-hand-holding-heart"></i>
                                <h5>Certificate of Indigency</h5>
                                <p>Document proving your financial status for assistance programs.</p>
                            </div>
                            <div class="certificate-type-card" data-type="residency">
                                <i class="fas fa-home"></i>
                                <h5>Certificate of Residency</h5>
                                <p>Proof of your current residence in the barangay.</p>
                            </div>
                            <div class="certificate-type-card" data-type="business">
                                <i class="fas fa-store"></i>
                                <h5>Business Permit</h5>
                                <p>Required for operating a business within the barangay.</p>
                            </div>
                        </div>
                        <input type="hidden" name="certificate_type" id="selectedCertificateType" required>
                    </div>

                    <!-- Purpose and Details -->
                    <div class="form-section">
                        <h5 class="form-section-title">
                            <i class="fas fa-info-circle"></i>Request Details
                        </h5>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="purpose" class="form-label">Purpose of Request</label>
                                <textarea class="form-control" id="purpose" name="purpose" rows="3" required 
                                          placeholder="Please specify the purpose of your certificate request"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="requested_date" class="form-label">Preferred Pick-up Date</label>
                                <input type="date" class="form-control" id="requested_date" name="requested_date" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="number_of_copies" class="form-label">Number of Copies</label>
                                <input type="number" class="form-control" id="number_of_copies" name="number_of_copies" 
                                       min="1" max="5" value="1" required>
                            </div>
                        </div>
                    </div>

                    

                    <!-- Submit Button -->
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane me-2"></i>Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Request History -->
        <div class="dashboard-card">
            <div class="card-header">
                <h4 class="mb-0">Request History</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Certificate Type</th>
                                <th>Request Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($requests) && !empty($requests)) : ?>
                                <?php foreach ($requests as $request) : ?>
                                    <tr>
                                        <td><?= esc($request['id']) ?></td>
                                        <td><?= esc($request['certificate_type']) ?></td>
                                        <td><?= date('M d, Y', strtotime($request['created_at'])) ?></td>
                                        <td>
                                            <span class="status-badge status-<?= strtolower($request['status']) ?>">
                                                <?= ucfirst($request['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info" onclick="viewRequestDetails('<?= $request['id'] ?>')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <?php if ($request['status'] === 'approved') : ?>
                                                <button class="btn btn-sm btn-success" onclick="downloadCertificate('<?= $request['id'] ?>')">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="text-center">No certificate requests found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

            // Certificate type selection
            const certificateCards = document.querySelectorAll('.certificate-type-card');
            const selectedTypeInput = document.getElementById('selectedCertificateType');

            certificateCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Remove selected class from all cards
                    certificateCards.forEach(c => c.classList.remove('selected'));
                    
                    // Add selected class to clicked card
                    this.classList.add('selected');
                    
                    // Update hidden input value
                    selectedTypeInput.value = this.dataset.type;
                });
            });

            // Form submission
            const form = document.getElementById('certificateRequestForm');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!selectedTypeInput.value) {
                    alert('Please select a certificate type');
                    return;
                }

                // Get form data
                const formData = new FormData(this);
                
                // Log form data for debugging
                for (let pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }
                
                // Show loading state
                const submitButton = this.querySelector('button[type="submit"]');
                const originalButtonText = submitButton.innerHTML;
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
                
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
                        
                        // Reset form
                        this.reset();
                        certificateCards.forEach(card => card.classList.remove('selected'));
                        selectedTypeInput.value = '';
                        
                        // Reload page after 2 seconds to show updated request history
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
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
                    console.error('Error:', error);
                    alert('An error occurred while submitting your request. Please try again.');
                })
                .finally(() => {
                    // Reset button state
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonText;
                });
            });
        });

        // View request details
        function viewRequestDetails(requestId) {
            // Implement view details functionality
            console.log('Viewing details for request:', requestId);
        }

        // Download certificate
        function downloadCertificate(requestId) {
            // Implement download functionality
            console.log('Downloading certificate for request:', requestId);
        }
    </script>
</body>
</html> 