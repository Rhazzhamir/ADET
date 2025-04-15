<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Barangay Information and Management System' ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <!-- Custom CSS -->
    <style>
        :root[data-theme="light"] {
            --sidebar-bg: #ffffff;
            --sidebar-hover: #f8f9fa;
            --sidebar-text: #212529;
            --navbar-bg: #ffffff;
            --navbar-text: #212529;
            --content-bg: #f8f9fa;
            --card-bg: #ffffff;
            --text-color: #212529;
            --content-wrapper-bg: #f8f9fa;
        }

        :root[data-theme="dark"] {
            --sidebar-bg: #121212;
            --sidebar-hover: #1e1e1e;
            --sidebar-text: #ffffff;
            --navbar-bg: #121212;
            --navbar-text: #ffffff;
            --content-bg: #121212;
            --card-bg: #1e1e1e;
            --text-color: #ffffff;
            --content-wrapper-bg: #121212;
            --border-color: #6c757d;
        }

        /* Sidebar Customization */
        .main-sidebar {
            background-color: var(--sidebar-bg) !important;
        }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active,
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link:hover {
            background-color: var(--sidebar-hover) !important;
            color: var(--sidebar-text) !important;
        }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link {
            color: var(--sidebar-text) !important;
        }
        .nav-sidebar .nav-link p {
            color: var(--sidebar-text) !important;
        }
        .nav-sidebar .nav-link i {
            color: var(--sidebar-text) !important;
        }
        .nav-sidebar .nav-link i.right {
            color: var(--sidebar-text) !important;
        }
        .nav-sidebar .nav-link i.nav-icon {
            color: var(--sidebar-text) !important;
        }
        .nav-sidebar .nav-link i.far {
            color: var(--sidebar-text) !important;
        }
        .brand-link {
            background-color: var(--sidebar-bg) !important;
            border-bottom: 1px solid var(--sidebar-hover) !important;
        }
        .brand-text {
            color: var(--sidebar-text) !important;
        }
        .nav-header {
            color: var(--sidebar-text) !important;
            font-size: 0.9rem;
            text-transform: uppercase;
            padding: 0.5rem 1rem;
            font-weight: 600;
        }

        /* Navbar Customization */
        .main-header {
            background-color: var(--navbar-bg) !important;
            border-bottom: 1px solid var(--sidebar-hover) !important;
        }
        .navbar-light .navbar-nav .nav-link {
            color: var(--navbar-text) !important;
        }
        .navbar-light .navbar-nav .nav-link:hover {
            color: var(--navbar-text) !important;
            opacity: 0.8;
        }

        /* Content Wrapper Customization */
        .content-wrapper {
            background-color: var(--content-wrapper-bg) !important;
        }

        /* Content Customization */
        .content {
            background-color: var(--content-bg) !important;
        }

        .content-header {
            background-color: var(--content-bg) !important;
            color: var(--text-color) !important;
        }

        .content-header h1 {
            color: var(--text-color) !important;
        }

        .breadcrumb {
            background-color: var(--content-bg) !important;
        }

        .breadcrumb-item a {
            color: var(--text-color) !important;
        }

        .breadcrumb-item.active {
            color: var(--text-color) !important;
        }

        /* Card Customization */
        .card {
            background-color: var(--card-bg) !important;
            border-color: var(--sidebar-hover) !important;
        }

        .card-header {
            background-color: var(--card-bg) !important;
            border-bottom-color: var(--sidebar-hover) !important;
        }

        .card-body {
            background-color: var(--card-bg) !important;
            color: var(--text-color) !important;
        }

        /* Table Customization */
        .table {
            color: var(--text-color) !important;
            background-color: var(--card-bg) !important;
        }

        .table thead th {
            background-color: var(--card-bg) !important;
            color: var(--text-color) !important;
            border-bottom-color: var(--sidebar-hover) !important;
        }

        .table tbody td {
            background-color: var(--card-bg) !important;
            color: var(--text-color) !important;
            border-color: var(--sidebar-hover) !important;
        }

        /* Form Customization */
        .form-control {
            background-color: var(--card-bg) !important;
            color: var(--text-color) !important;
            border-color: var(--sidebar-hover) !important;
        }

        .form-control:focus {
            background-color: var(--card-bg) !important;
            color: var(--text-color) !important;
            border-color: var(--sidebar-hover) !important;
        }

        .form-control::placeholder {
            color: var(--text-color) !important;
            opacity: 0.7;
        }

        /* Select Customization */
        .select2-container--default .select2-selection--single {
            background-color: var(--card-bg) !important;
            color: var(--text-color) !important;
            border-color: var(--sidebar-hover) !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: var(--text-color) !important;
        }

        /* Modal Customization */
        .modal-content {
            background-color: var(--card-bg) !important;
            color: var(--text-color) !important;
        }

        .modal-header {
            background-color: var(--card-bg) !important;
            border-bottom: 1px solid var(--sidebar-hover) !important;
        }

        .modal-footer {
            background-color: var(--card-bg) !important;
            border-top: 1px solid var(--sidebar-hover) !important;
        }

        .modal-title {
            color: var(--text-color) !important;
        }

        .close {
            color: var(--text-color) !important;
        }

        /* Households Table Specific Styles */
        .table-bordered {
            border-color: var(--sidebar-hover) !important;
        }

        .table-bordered th,
        .table-bordered td {
            border-color: var(--sidebar-hover) !important;
        }

        .table thead th {
            background-color: var(--card-bg) !important;
            color: var(--text-color) !important;
            border-bottom: 2px solid var(--sidebar-hover) !important;
        }

        .table tbody tr:hover {
            background-color: var(--sidebar-hover) !important;
        }

        .table tbody tr td.text-center {
            color: var(--text-color) !important;
        }

        /* Form Controls in Modal */
        .modal-body .form-control {
            background-color: var(--card-bg) !important;
            color: var(--text-color) !important;
            border-color: var(--sidebar-hover) !important;
        }

        .modal-body .form-control:focus {
            background-color: var(--card-bg) !important;
            color: var(--text-color) !important;
            border-color: var(--sidebar-hover) !important;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .modal-body label {
            color: var(--text-color) !important;
        }

        /* Card Customization for Households */
        .card {
            background-color: var(--card-bg) !important;
            border-color: var(--sidebar-hover) !important;
        }

        .card-header {
            background-color: var(--card-bg) !important;
            border-bottom-color: var(--sidebar-hover) !important;
        }

        .card-title {
            color: var(--text-color) !important;
        }

        .card-tools .btn {
            color: var(--text-color) !important;
        }

        /* Add these new styles for sidebar animations */
        .nav-sidebar .nav-link i {
            transition: all 0.3s ease;
        }
        .nav-sidebar .nav-link:hover i,
        .nav-sidebar .nav-link.active i {
            transform: scale(1.2);
            color: #007bff !important;
        }
        .nav-sidebar .nav-link:hover p,
        .nav-sidebar .nav-link.active p {
            color: #007bff !important;
        }
        .nav-sidebar .nav-link {
            transition: all 0.3s ease;
        }
        .nav-sidebar .nav-link:hover,
        .nav-sidebar .nav-link.active {
            background-color: rgba(0, 123, 255, 0.1) !important;
        }
        .nav-sidebar .nav-item .nav-treeview {
            transition: all 0.3s ease;
        }
        .nav-sidebar .nav-item .nav-treeview .nav-link {
            padding-left: 1.5rem;
        }
        .nav-sidebar .nav-item .nav-treeview .nav-link i {
            font-size: 0.8rem;
        }
        .nav-sidebar .nav-item .nav-treeview .nav-link:hover i,
        .nav-sidebar .nav-item .nav-treeview .nav-link.active i {
            transform: scale(1.1);
        }

        label {
            color: var(--text-color) !important;
        }

        .card-title {
            color: var(--text-color) !important;
        }

        /* Button and Input Border Customization for Dark Mode */
        :root[data-theme="dark"] {
            --sidebar-bg: #121212;
            --sidebar-hover: #1e1e1e;
            --sidebar-text: #ffffff;
            --navbar-bg: #121212;
            --navbar-text: #ffffff;
            --content-bg: #121212;
            --card-bg: #1e1e1e;
            --text-color: #ffffff;
            --content-wrapper-bg: #121212;
            --border-color: #6c757d;
        }

        /* Button Styles */
        .btn {
            border: 1px solid var(--border-color) !important;
        }

        .btn-primary {
            background-color: #007bff !important;
            border-color: #0056b3 !important;
        }

        .btn-secondary {
            background-color: #6c757d !important;
            border-color: #545b62 !important;
        }

        .btn-success {
            background-color: #28a745 !important;
            border-color: #1e7e34 !important;
        }

        .btn-danger {
            background-color: #dc3545 !important;
            border-color: #bd2130 !important;
        }

        .btn-warning {
            background-color: #ffc107 !important;
            border-color: #d39e00 !important;
        }

        .btn-info {
            background-color: #17a2b8 !important;
            border-color: #117a8b !important;
        }

        /* Input and Form Control Styles */
        .form-control {
            border: 1px solid var(--border-color) !important;
        }

        .form-control:focus {
            border-color: #80bdff !important;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
        }

        /* Table Border Styles */
        .table {
            border: 1px solid var(--border-color) !important;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid var(--border-color) !important;
        }

        .table thead th {
            border-bottom: 2px solid var(--border-color) !important;
        }

        /* Card Border Styles */
        .card {
            border: 1px solid var(--border-color) !important;
        }

        .card-header {
            border-bottom: 1px solid var(--border-color) !important;
        }

        /* Modal Border Styles */
        .modal-content {
            border: 1px solid var(--border-color) !important;
        }

        .modal-header {
            border-bottom: 1px solid var(--border-color) !important;
        }

        .modal-footer {
            border-top: 1px solid var(--border-color) !important;
        }

        /* Select2 Customization */
        .select2-container--default .select2-selection--single {
            border: 1px solid var(--border-color) !important;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid var(--border-color) !important;
        }

        .select2-dropdown {
            border: 1px solid var(--border-color) !important;
            background-color: var(--card-bg) !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #007bff !important;
            color: white !important;
        }

        /* DataTables Customization */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid var(--border-color) !important;
            background-color: var(--card-bg) !important;
            color: var(--text-color) !important;
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid var(--border-color) !important;
            background-color: var(--card-bg) !important;
            color: var(--text-color) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border: 1px solid var(--border-color) !important;
            background-color: var(--card-bg) !important;
            color: var(--text-color) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #007bff !important;
            color: white !important;
            border-color: #0056b3 !important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a id="themeToggle" class="nav-link" href="#" role="button">
                        <i class="fas fa-sun"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button">
                        <i class="fas fa-user"></i> Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth/logout') ?>" role="button">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url() ?>" class="brand-link">
                <img src="<?= base_url('assets/img/logo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Barangay Dist IV</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="<?= base_url('dashboard') ?>" class="nav-link <?= (current_url() == base_url('dashboard') || current_url() == base_url()) ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Residents -->
                        <li class="nav-item has-treeview <?= strpos(current_url(), 'admin') !== false ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= strpos(current_url(), 'admin') !== false ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Residents
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('admin') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Residents</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Budget -->
                        <li class="nav-item has-treeview <?= strpos(current_url(), 'budget') !== false ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= strpos(current_url(), 'budget') !== false ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-money-bill-wave"></i>
                                <p>
                                    Budget
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('budget') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Budget Overview</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('budget/expenses') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Expenses</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('budget/reports') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reports</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Officials -->
                        <li class="nav-item has-treeview <?= strpos(current_url(), 'officials') !== false ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= strpos(current_url(), 'officials') !== false ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Officials
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('officials') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Officials</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('officials/add') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add New Official</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('officials/positions') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Positions</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Legal -->
                        <li class="nav-item has-treeview <?= strpos(current_url(), 'legal') !== false ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= strpos(current_url(), 'legal') !== false ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-gavel"></i>
                                <p>
                                    Legal
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('legal/privacy') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Privacy Policy</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('legal/terms') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Terms & Conditions</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Alert Section -->
            <div class="container-fluid">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('warning')): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('warning') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('info')): ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('info') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
            <!-- End Alert Section -->

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $title ?? 'Dashboard' ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                                <li class="breadcrumb-item active"><?= $title ?? 'Dashboard' ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <?= $this->renderSection('content') ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; <?= date('Y') ?> Barangay Information and Management System</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Theme handling
        function setTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
            
            // Update theme toggle icon
            const themeIcon = $('#themeToggle i');
            themeIcon.removeClass('fa-sun fa-moon');
            themeIcon.addClass(theme === 'dark' ? 'fa-moon' : 'fa-sun');
        }

        // Initialize theme
        $(document).ready(function() {
            // Set initial theme
            const savedTheme = localStorage.getItem('theme') || 'light';
            setTheme(savedTheme);

            // Initialize DataTables
            $('.table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });

            // Initialize Select2
            $('.select2').select2();

            // Theme toggle functionality
            $('#themeToggle').on('click', function(e) {
                e.preventDefault();
                const currentTheme = document.documentElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                setTheme(newTheme);
            });

            // Auto-dismiss alerts after 5 seconds
            $('.alert').each(function() {
                const alert = $(this);
                setTimeout(function() {
                    alert.fadeOut(500, function() {
                        $(this).remove();
                    });
                }, 5000);
            });
        });

        // Ensure theme is applied on page load
        $(window).on('load', function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            setTheme(savedTheme);
        });
    </script>
</body>
</html> 