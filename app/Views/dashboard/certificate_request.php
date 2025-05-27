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

        /* Enhanced Spacing and Padding */
        .form-section, .dashboard-card, .main-content {
            margin-bottom: 32px !important;
            padding-bottom: 24px !important;
        }
        .form-label, .form-section-title {
            margin-bottom: 8px !important;
        }
        .form-control, .certificate-type-card {
            margin-bottom: 16px !important;
        }
        /* Prominent Submit Button */
        .btn-primary.btn-lg {
            font-size: 1.2rem;
            padding: 14px 36px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(13,110,253,0.15);
            transition: background 0.2s, transform 0.2s;
        }
        .btn-primary.btn-lg:hover {
            background: #0b5ed7;
            transform: translateY(-2px) scale(1.03);
        }
        /* Certificate Card Highlight */
        .certificate-type-card.selected {
            border: 3px solid var(--primary-color);
            background-color: rgba(13, 110, 253, 0.10);
            position: relative;
        }
        .certificate-type-card.selected::after {
            content: '\2714';
            position: absolute;
            top: 12px;
            right: 18px;
            font-size: 1.5rem;
            color: var(--primary-color);
            background: #fff;
            border-radius: 50%;
            padding: 2px 6px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }
        /* Tooltips */
        .help-tooltip {
            margin-left: 6px;
            color: var(--info-color);
            cursor: pointer;
        }
        /* Zebra Striping for Table */
        .request-history .table tbody tr:nth-child(odd) {
            background-color: var(--form-bg);
        }
        .request-history .table tbody tr:hover {
            background-color: #e9f2ff;
        }
        /* Action Icons */
        .table .btn-info, .table .btn-success {
            margin-right: 4px;
        }
        /* Toast Notification */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            min-width: 250px;
            z-index: 2000;
        }
        /* Confirmation Modal */
        .modal-confirm {
            color: #636363;
            width: 400px;
        }
        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 8px;
            border: none;
        }
        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }
        .modal-confirm h4 {
            text-align: center;
            font-size: 1.5rem;
        }
        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -2px;
        }
        /* Accessibility: Focus Styles */
        .form-control:focus, .btn:focus, .certificate-type-card:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }
        /* Responsive Tweaks */
        @media (max-width: 576px) {
            .dashboard-card, .form-section {
                padding: 10px !important;
            }
            .btn-primary.btn-lg {
                width: 100%;
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
                                <label for="purpose" class="form-label">Purpose of Request
                                    <span class="help-tooltip" tabindex="0" data-bs-toggle="tooltip" title="State why you need this certificate."><i class="fas fa-question-circle"></i></span>
                                </label>
                                <textarea class="form-control" id="purpose" name="purpose" rows="3" required 
                                          placeholder="Please specify the purpose of your certificate request"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="requested_date" class="form-label">Preferred Pick-up Date
                                    <span class="help-tooltip" tabindex="0" data-bs-toggle="tooltip" title="Select when you want to pick up your certificate."><i class="fas fa-question-circle"></i></span>
                                </label>
                                <input type="date" class="form-control" id="requested_date" name="requested_date" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="number_of_copies" class="form-label">Number of Copies
                                    <span class="help-tooltip" tabindex="0" data-bs-toggle="tooltip" title="You can request up to 5 copies."><i class="fas fa-question-circle"></i></span>
                                </label>
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
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" class="text-center">No certificate requests found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast align-items-center text-bg-primary border-0" id="feedbackToast" role="alert" aria-live="assertive" aria-atomic="true" style="display:none;">
        <div class="d-flex">
            <div class="toast-body" id="toastMessage"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-confirm">
          <div class="modal-header">
            <h4 class="modal-title w-100" id="confirmModalLabel">Confirm Submission</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            Are you sure you want to submit this certificate request?
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="confirmSubmitBtn">Yes, Submit</button>
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

            // Enable tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Form submission with confirmation modal
            const form = document.getElementById('certificateRequestForm');
            let pendingSubmit = false;
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (!selectedTypeInput.value) {
                    showToast('Please select a certificate type.', 'danger');
                    return;
                }
                // Show confirmation modal
                pendingSubmit = true;
                var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
                confirmModal.show();
            });
            // Confirm modal submit
            document.getElementById('confirmSubmitBtn').addEventListener('click', function() {
                if (!pendingSubmit) return;
                pendingSubmit = false;
                var confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
                confirmModal.hide();
                actuallySubmitForm();
            });
            function actuallySubmitForm() {
                // Get form data
                const formData = new FormData(form);
                // Show loading state
                const submitButton = form.querySelector('button[type="submit"]');
                const originalButtonText = submitButton.innerHTML;
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
                // Send AJAX request
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message, 'success');
                        // Reset form
                        form.reset();
                        certificateCards.forEach(card => card.classList.remove('selected'));
                        selectedTypeInput.value = '';
                        setTimeout(() => { window.location.reload(); }, 2000);
                    } else {
                        showToast(data.message, 'danger');
                    }
                })
                .catch(error => {
                    showToast('An error occurred while submitting your request. Please try again.', 'danger');
                })
                .finally(() => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonText;
                });
            }
            // Toast notification function
            function showToast(message, type) {
                const toast = document.getElementById('feedbackToast');
                const toastMessage = document.getElementById('toastMessage');
                toastMessage.textContent = message;
                toast.className = 'toast align-items-center text-bg-' + (type === 'success' ? 'success' : (type === 'danger' ? 'danger' : 'primary')) + ' border-0';
                toast.style.display = 'block';
                setTimeout(() => { toast.style.display = 'none'; }, 3000);
            }
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

        // Cancel certificate request
        function cancelRequest(requestId) {
            if (!confirm('Are you sure you want to cancel this request?')) return;
            fetch('<?= base_url('dashboard/cancel-request') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({ id: requestId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success');
                    setTimeout(() => { window.location.reload(); }, 1500);
                } else {
                    showToast(data.message, 'danger');
                }
            })
            .catch(() => {
                showToast('An error occurred while cancelling your request.', 'danger');
            });
        }
    </script>
</body>
</html> 