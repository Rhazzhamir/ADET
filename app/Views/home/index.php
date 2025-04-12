<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Information and Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --background-color: #f8f9fa;
            --text-color: #212529;
            --card-bg: #ffffff;
            --input-bg: #ffffff;
            --border-color: #dee2e6;
        }

        [data-theme="dark"] {
            --primary-color: #0d6efd;
            --secondary-color: #adb5bd;
            --background-color: #212529;
            --text-color: #f8f9fa;
            --card-bg: #343a40;
            --input-bg: #495057;
            --border-color: #6c757d;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        .hero-section {
            background-size: cover;
            background-position: center;
            height: 80vh;
            display: flex;
            align-items: center;
            color: var(--text-color);
            position: relative;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            z-index: 1;
        }

        .hero-section .container {
            position: relative;
            z-index: 2;
        }

        .hero-section h1 {
            color: var(--text-color);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .hero-section p {
            color: var(--text-color);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        [data-theme="dark"] .hero-section::before {
            background: rgba(0, 0, 0, 0.7);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .feature-card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            margin-bottom: 30px;
            box-shadow: 0 0 30px rgba(0,0,0,0.1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .footer {
            background-color: var(--card-bg);
            color: var(--text-color);
            padding: 3rem 0;
        }

        .navbar {
            background-color: var(--card-bg) !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--text-color) !important;
        }

        .navbar-brand img {
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover img {
            transform: scale(1.05);
        }

        [data-theme="dark"] .navbar-brand img {
            filter: brightness(0.9);
        }

        .nav-link {
            color: var(--text-color) !important;
            font-weight: 500;
        }

        .nav-link.active {
            color: var(--primary-color) !important;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-primary:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            color: white;
        }

        .btn-outline-light {
            border: 2px solid var(--primary-color);
            background: transparent;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            color: var(--primary-color);
        }

        .btn-outline-light:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        [data-theme="dark"] .btn-outline-light {
            border-color: white;
            color: white;
        }

        [data-theme="dark"] .btn-outline-light:hover {
            background: white;
            color: var(--primary-color);
        }

        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--card-bg);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
        }

        .theme-toggle i {
            color: var(--text-color);
            font-size: 20px;
        }

        .footer a {
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer a:hover {
            color: var(--primary-color);
        }

        .footer hr {
            border-color: var(--border-color);
        }

        .bg-light {
            background-color: var(--background-color) !important;
        }
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .card-title {
            color: var(--primary-color);
        }
        .card-text {
            color: var(--text-color);
        }
        .list-unstyled li {
            margin-bottom: 10px;
            color: var(--text-color);
        }
        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }
        .accordion {
            background: var(--card-bg);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 30px rgba(0,0,0,0.1);
        }
        .accordion-item {
            border: none;
            background: transparent;
        }
        .accordion-button {
            background: var(--card-bg);
            color: var(--text-color);
            font-weight: 600;
            padding: 1.25rem;
        }
        .accordion-button:not(.collapsed) {
            background: var(--card-bg);
            color: var(--primary-color);
        }
        .accordion-button:focus {
            box-shadow: none;
            border-color: var(--border-color);
        }
        .accordion-body {
            background: var(--card-bg);
            color: var(--text-color);
            padding: 1.25rem;
        }
        .accordion-body ul {
            padding-left: 1.5rem;
        }
        .accordion-body li {
            margin-bottom: 0.5rem;
        }
        .accordion-button::after {
            transition: transform 0.3s ease, color 0.3s ease;
            color: var(--text-color);
        }
        .accordion-button:not(.collapsed)::after {
            transform: rotate(-180deg);
        }
        [data-theme="dark"] .accordion-button::after {
            color: var(--primary-color);
        }
        .map-container {
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 30px rgba(0,0,0,0.1);
            border-radius: 15px;
            transition: all 0.3s ease;
        }
        .map-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .map-container iframe {
                width: 100%;
            height: 450px;
            border: none;
        }
        .location-details p {
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }
        .location-details i {
            width: 20px;
            text-align: center;
        }
        #themeToggle {
            background: none;
            border: none;
            padding: 0.5rem;
            color: var(--text-color);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #themeToggle:hover {
            color: var(--primary-color);
            transform: scale(1.1);
        }

        #themeToggle i {
                font-size: 1.2rem;
            }
            
        .section-divider {
            margin: 2rem 0;
            border: none;
            border-top: 3px solid var(--border-color);
            opacity: 0.8;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        [data-theme="dark"] .section-divider {
            border-color: var(--border-color);
            box-shadow: 0 1px 2px rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= base_url() ?>">
                <img src="<?= base_url('assets/img/logo.png') ?>" alt="BIMS Logo" height="50" class="me-2">
                BARANGAY DISTRICT IV
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#officials">Officials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Main_Features">Main Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Terms_&_Privacy">Terms & Privacy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#map">Map</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth/admin_login') ?>">Admin</a>
                    </li>
                    <li class="nav-item ms-2">
                        <button class="btn btn-link nav-link" id="themeToggle">
                            <i class="fas fa-sun"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Barangay Information and Management System</h1>
            <p class="lead">Streamlining barangay operations through efficient digital management</p>
            <div class="mt-4">
                <a href="<?= base_url('auth/resident/login') ?>" class="btn btn-primary btn-lg me-2">Login</a>
                <a href="<?= base_url('auth/resident/register') ?>" class="btn btn-outline-light btn-lg">Register</a>
            </div>
        </div>
    </section>

    <hr class="section-divider">

    <!-- Officials Section -->
    <section class="py-5 bg-light" id="officials">
        <div class="container">
            <h2 class="text-center mb-5">Barangay Officials</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="assets/img/logo.png" class="card-img-top" alt="Captain">
                        <div class="card-body text-center">
                            <h5 class="card-title">Captain</h5>
                            <p class="card-text">John Doe</p>
                        </div>
                    </div>
                </div>
                <!-- Kagawad 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="assets/img/logo.png" class="card-img-top" alt="Kagawad">
                        <div class="card-body text-center">
                            <h5 class="card-title">Kagawad</h5>
                            <p class="card-text">Jane Smith</p>
                        </div>
                    </div>
                </div>
                <!-- Kagawad 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="assets/img/logo.png" class="card-img-top" alt="Kagawad">
                        <div class="card-body text-center">
                            <h5 class="card-title">Kagawad</h5>
                            <p class="card-text">Alex Johnson</p>
                        </div>
                    </div>
                </div>
                <!-- Kagawad 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="assets/img/logo.png" class="card-img-top" alt="Kagawad">
                        <div class="card-body text-center">
                            <h5 class="card-title">Kagawad</h5>
                            <p class="card-text">Maria Garcia</p>
                        </div>
                    </div>
                </div>
                <!-- Kagawad 4 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="assets/img/logo.png" class="card-img-top" alt="Kagawad">
                        <div class="card-body text-center">
                            <h5 class="card-title">Kagawad</h5>
                            <p class="card-text">James Brown</p>
                        </div>
                    </div>
                </div>
                <!-- Kagawad 5 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="assets/img/logo.png" class="card-img-top" alt="Kagawad">
                        <div class="card-body text-center">
                            <h5 class="card-title">Kagawad</h5>
                            <p class="card-text">Linda White</p>
                        </div>
                    </div>
                </div>
                <!-- Kagawad 6 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="assets/img/logo.png" class="card-img-top" alt="Kagawad">
                        <div class="card-body text-center">
                            <h5 class="card-title">Kagawad</h5>
                            <p class="card-text">Robert Green</p>
                        </div>
                    </div>
                </div>
                <!-- Kagawad 7 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="assets/img/logo.png" class="card-img-top" alt="Kagawad">
                        <div class="card-body text-center">
                            <h5 class="card-title">Kagawad</h5>
                            <p class="card-text">Patricia Blue</p>
                        </div>
                    </div>
                </div>
                <!-- Secretary -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="assets/img/logo.png" class="card-img-top" alt="Secretary">
                        <div class="card-body text-center">
                            <h5 class="card-title">Secretary</h5>
                            <p class="card-text">Michael Johnson</p>
                        </div>
                    </div>
                </div>
                <!-- Treasurer -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="assets/img/logo.png" class="card-img-top" alt="Treasurer">
                        <div class="card-body text-center">
                            <h5 class="card-title">Treasurer</h5>
                            <p class="card-text">Emily Davis</p>
                        </div>
                    </div>
                </div>
                <!-- SK Chairman -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="assets/img/logo.png" class="card-img-top" alt="SK Chairman">
                        <div class="card-body text-center">
                            <h5 class="card-title">SK Chairman</h5>
                            <p class="card-text">Chris Brown</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="section-divider">

    <!-- Features Section -->
    <section class="py-5" id="Main_Features">
        <div class="container">
            <h2 class="text-center mb-5">System Features</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-money-bill-wave feature-icon"></i>
                        <h3>Budget Management</h3>
                        <p>Efficient tracking and management of barangay budget, expenses, and financial reports.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-users feature-icon"></i>
                        <h3>Officials Directory</h3>
                        <p>Comprehensive database of barangay officials and staff with their roles and responsibilities.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-address-book feature-icon"></i>
                        <h3>Resident Records</h3>
                        <p>Secure digital record-keeping system for all residents and household information.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="section-divider">

    <!-- Legal Section -->
    <section class="py-5 bg-light" id="Terms_&_Privacy">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="accordion" id="termsAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#termsCollapse" aria-expanded="false" aria-controls="termsCollapse">
                                    <i class="fas fa-file-contract me-2"></i> Terms of Service
                                </button>
                            </h2>
                            <div id="termsCollapse" class="accordion-collapse collapse" aria-labelledby="termsHeading" data-bs-parent="#termsAccordion">
                                <div class="accordion-body">
                                    <p>By accessing and using the Barangay Information and Management System (BIMS), you agree to comply with and be bound by the following terms and conditions:</p>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check-circle text-primary me-2"></i>Users must provide accurate and complete information</li>
                                        <li><i class="fas fa-check-circle text-primary me-2"></i>Respect the privacy and rights of other users</li>
                                        <li><i class="fas fa-check-circle text-primary me-2"></i>Use the system for legitimate barangay-related purposes only</li>
                                        <li><i class="fas fa-check-circle text-primary me-2"></i>Maintain the confidentiality of your account credentials</li>
                                    </ul>
                                    <div class="mt-3">
                                        <h5>Full Terms and Conditions</h5>
                                        <p>1. User Responsibilities</p>
                                        <ul>
                                            <li>Provide accurate and complete information during registration</li>
                                            <li>Update personal information when changes occur</li>
                                            <li>Maintain the security of your account credentials</li>
                                        </ul>
                                        <p>2. System Usage</p>
                                        <ul>
                                            <li>Use the system for legitimate barangay-related purposes only</li>
                                            <li>Do not attempt to access unauthorized areas of the system</li>
                                            <li>Report any security vulnerabilities or issues immediately</li>
                                        </ul>
                                        <p>3. Data Protection</p>
                                        <ul>
                                            <li>Respect the privacy of other users</li>
                                            <li>Do not share sensitive information without authorization</li>
                                            <li>Comply with data protection regulations</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="accordion" id="privacyAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#privacyCollapse" aria-expanded="false" aria-controls="privacyCollapse">
                                    <i class="fas fa-shield-alt me-2"></i> Privacy Policy
                                </button>
                            </h2>
                            <div id="privacyCollapse" class="accordion-collapse collapse" aria-labelledby="privacyHeading" data-bs-parent="#privacyAccordion">
                                <div class="accordion-body">
                                    <p>We are committed to protecting your privacy and personal information. Our privacy policy outlines how we collect, use, and protect your data:</p>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-shield-alt text-primary me-2"></i>Secure storage of personal information</li>
                                        <li><i class="fas fa-shield-alt text-primary me-2"></i>Limited access to authorized personnel only</li>
                                        <li><i class="fas fa-shield-alt text-primary me-2"></i>Regular security updates and monitoring</li>
                                        <li><i class="fas fa-shield-alt text-primary me-2"></i>Compliance with data protection regulations</li>
                                    </ul>
                                    <div class="mt-3">
                                        <h5>Full Privacy Policy</h5>
                                        <p>1. Information Collection</p>
                                        <ul>
                                            <li>Personal information collected during registration</li>
                                            <li>Usage data and system interactions</li>
                                            <li>Communication records and support tickets</li>
                                        </ul>
                                        <p>2. Data Protection</p>
                                        <ul>
                                            <li>Encryption of sensitive information</li>
                                            <li>Regular security audits and updates</li>
                                            <li>Access control and authentication measures</li>
                                        </ul>
                                        <p>3. User Rights</p>
                                        <ul>
                                            <li>Right to access personal data</li>
                                            <li>Right to request data correction</li>
                                            <li>Right to data portability and deletion</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="section-divider">

    <!-- Map Section -->
    <section class="py-5" id="map">
        <div class="container">
            <h2 class="text-center mb-4">Location</h2>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="map-container">
                        <div id="map" style="height: 450px; border-radius: 15px;"></div>
                    </div>
                    <div class="text-center mt-4">
                        <h4>Barangay District IV</h4>
                        <p class="text-muted">Babatngon, Leyte</p>
                        <div class="location-details mt-3">
                            <p><i class="fas fa-map-marker-alt text-primary me-2"></i>Located in the heart of Babatngon, Leyte</p>
                            <p><i class="fas fa-road text-primary me-2"></i>Accessible via Babatngon-Leyte Highway</p>
                            <p><i class="fas fa-building text-primary me-2"></i>Near the Municipal Hall of Babatngon</p>
                            <p><i class="fas fa-compass text-primary me-2"></i>Coordinates: 11.4234° N, 124.8289° E</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="section-divider">

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>About BIMS</h5>
                    <p>A comprehensive system designed to modernize and streamline barangay operations through efficient digital management.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone"></i> +123 456 7890</li>
                        <li><i class="fas fa-envelope"></i> admin@barangay.com </li>
                        <li><i class="fas fa-map-marker-alt"></i> Barangay Dist IV</li>
                    </ul>
                </div>
            </div>
            <hr class="mt-4">
            <div class="text-center">
                <p>&copy; <?php echo date('Y'); ?> Barangay Information and Management System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Theme toggle functionality
        const themeToggle = document.getElementById('themeToggle');
        const body = document.body;
        const icon = themeToggle.querySelector('i');

        // Check for saved theme preference
        const currentTheme = localStorage.getItem('theme') || 'light';
        if (currentTheme === 'dark') {
            body.setAttribute('data-theme', 'dark');
            icon.classList.replace('fa-sun', 'fa-moon');
        }

        themeToggle.addEventListener('click', () => {
            if (body.getAttribute('data-theme') === 'dark') {
                body.setAttribute('data-theme', 'light');
                icon.classList.replace('fa-moon', 'fa-sun');
                localStorage.setItem('theme', 'light');
            } else {
                body.setAttribute('data-theme', 'dark');
                icon.classList.replace('fa-sun', 'fa-moon');
                localStorage.setItem('theme', 'dark');
            }
        });

        // Accordion functionality
        document.addEventListener('DOMContentLoaded', function() {
            const accordionButtons = document.querySelectorAll('.accordion-button');
            
            accordionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const target = document.querySelector(this.getAttribute('data-bs-target'));
                    const isCollapsed = this.classList.contains('collapsed');
                    
                    // Toggle the collapsed class
                    this.classList.toggle('collapsed');
                    
                    // Use Bootstrap's collapse method
                    if (isCollapsed) {
                        new bootstrap.Collapse(target, {
                            toggle: true
                        });
                    } else {
                        const collapseInstance = bootstrap.Collapse.getInstance(target);
                        if (collapseInstance) {
                            collapseInstance.hide();
                        }
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([11.4238, 124.8474], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([11.4238, 124.8474]).addTo(map)
                .bindPopup('Barangay District IV, Babatngon, Leyte')
                .openPopup();
        });
    </script>
</body>
</html> 