<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Barangay Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --background-color: #f8f9fa;
            --text-color: #212529;
            --card-bg: #ffffff;
            --input-bg: #ffffff;
            --border-color: #dee2e6;
            --success-color: #198754;
            --danger-color: #dc3545;
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
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .admin-login-container {
            max-width: 400px;
            width: 90%;
            padding: 40px;
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 0 40px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .admin-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .admin-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color) 0%, #0b5ed7 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 50px;
            box-shadow: 0 0 30px rgba(13,110,253,0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .admin-header h1 {
            color: var(--primary-color);
            font-size: 28px;
            margin-bottom: 8px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .admin-header p {
            color: var(--secondary-color);
            font-size: 16px;
            margin-bottom: 0;
            font-weight: 500;
        }

        .admin-email {
            text-align: center;
            margin-bottom: 25px;
            font-size: 18px;
            color: var(--text-color);
            font-weight: 500;
            background: var(--input-bg);
            padding: 12px;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .form-control {
            background-color: var(--input-bg);
            border-color: var(--border-color);
            color: var(--text-color);
            padding: 14px;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 16px;
            border: 2px solid var(--border-color);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,.15);
            background-color: var(--input-bg);
            color: var(--text-color);
        }

        .form-label {
            color: var(--text-color);
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 15px;
        }

        .btn-primary {
            width: 100%;
            padding: 14px;
            font-weight: 600;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary-color) 0%, #0b5ed7 100%);
            border: none;
            transition: all 0.3s ease;
            font-size: 16px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13,110,253,0.3);
        }

        .go-back {
            text-align: center;
            margin-top: 25px;
        }

        .go-back a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }

        .go-back a:hover {
            color: #0b5ed7;
            transform: translateX(-5px);
        }

        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--card-bg);
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .theme-toggle:hover {
            transform: scale(1.1) rotate(15deg);
        }

        .theme-toggle i {
            color: var(--text-color);
            font-size: 20px;
        }

        .alert {
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 25px;
            border: none;
            font-weight: 500;
        }

        .alert-danger {
            background-color: rgba(220,53,69,0.1);
            color: var(--danger-color);
        }

        .alert-success {
            background-color: rgba(25,135,84,0.1);
            color: var(--success-color);
        }

        .password-input {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--secondary-color);
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 5px;
        }

        .password-toggle:hover {
            color: var(--primary-color);
            transform: translateY(-50%) scale(1.1);
        }

        .form-control::placeholder {
            color: var(--secondary-color);
            opacity: 0.7;
        }

        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid var(--primary-color);
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .home-link {
            position: fixed;
            top: 20px;
            left: 20px;
            background: var(--card-bg);
            border: none;
            border-radius: 8px;
            padding: 8px 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
        }

        .home-link:hover {
            transform: scale(1.05);
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <a href="<?= base_url('home') ?>" class="home-link">
        <i class="fas fa-home me-2"></i>Home
    </a>
    <button class="theme-toggle" id="themeToggle">
        <i class="fas fa-sun"></i>
    </button>

    <div class="admin-login-container">
        <div class="admin-header">
            <div class="admin-avatar">
                <i class="fas fa-user-shield"></i>
            </div>
            <h1>Admin Panel</h1>
            <p>Enter your password to login</p>
        </div>
        
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i><?= session('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->has('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i><?= session('success') ?>
            </div>
        <?php endif; ?>


            
        <form action="<?= base_url('auth/admin_login') ?>" method="post" id="adminLoginForm">
            <input type="hidden" name="email" value="admin@barangay.com">
            <input type="hidden" name="account_type" value="admin">
            
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="password-input">
                    <input type="password" class="form-control" id="password" name="password" required 
                           placeholder="Enter your password" autofocus>
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-lock-open me-2"></i>Unlock
            </button>
        </form>
        
        <div class="go-back">
            <a href="<?= base_url('auth/login') ?>">
                <i class="fas fa-arrow-left"></i>
                <span>Back to User Login</span>
            </a>
        </div>
    </div>

    <div class="loading" id="loading">
        <div class="loading-spinner"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

        // Password toggle functionality
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.querySelector('.password-toggle i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleButton.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        // Form submission loading
        document.getElementById('adminLoginForm').addEventListener('submit', function() {
            document.getElementById('loading').style.display = 'flex';
        });
    </script>
</body>
</html> 