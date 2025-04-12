<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        :root[data-theme="light"] {
            --bg-color: #f8f9fa;
            --text-color: #212529;
            --card-bg: white;
            --input-bg: white;
            --input-border: #ced4da;
            --input-text: #212529;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --muted-text: #6c757d;
            --link-color: #0d6efd;
            --link-hover: #0a58ca;
        }

        :root[data-theme="dark"] {
            --bg-color: #1a1d20;
            --text-color: #e9ecef;
            --card-bg: #2c3034;
            --input-bg: #343a40;
            --input-border: #495057;
            --input-text: #e9ecef;
            --shadow-color: rgba(0, 0, 0, 0.3);
            --muted-text: #adb5bd;
            --link-color: #6ea8fe;
            --link-hover: #8bb9fe;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        .register-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background: var(--card-bg);
            border-radius: 10px;
            box-shadow: 0 0 20px var(--shadow-color);
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h2 {
            color: var(--text-color);
            font-weight: 600;
        }

        .register-header p {
            color: var(--muted-text);
        }

        .form-control {
            background-color: var(--input-bg);
            border-color: var(--input-border);
            color: var(--input-text);
        }

        .form-control:focus {
            background-color: var(--input-bg);
            border-color: var(--link-color);
            color: var(--input-text);
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .form-control::placeholder {
            color: var(--muted-text);
        }

        .form-label {
            color: var(--text-color);
            font-weight: 500;
        }

        .btn-register {
            width: 100%;
            padding: 10px;
            font-weight: 500;
        }

        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: var(--text-color);
            cursor: pointer;
            padding: 10px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            background-color: var(--input-bg);
        }

        .form-check-input {
            background-color: var(--input-bg);
            border-color: var(--input-border);
        }

        .form-check-input:checked {
            background-color: var(--link-color);
            border-color: var(--link-color);
        }

        .form-check-label {
            color: var(--text-color);
        }

        .text-muted {
            color: var(--muted-text) !important;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: var(--link-color);
            text-decoration: none;
        }

        .login-link a:hover {
            color: var(--link-hover);
        }

        .auth-links {
            position: fixed;
            top: 20px;
            right: 70px;
            display: flex;
            gap: 10px;
        }

        .auth-link {
            background: var(--card-bg);
            border: 1px solid var(--input-border);
            color: var(--text-color);
            padding: 8px 15px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .auth-link:hover {
            background: var(--link-color);
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <!-- Auth Links -->
    <div class="auth-links">
        <a href="<?= base_url('auth/admin_login') ?>" class="auth-link">
            <i class="fas fa-user-shield me-1"></i>Admin Login
        </a>
    </div>

    <button class="theme-toggle" onclick="toggleTheme()" title="Toggle theme">
        <i class="fas fa-moon"></i>
    </button>

    <div class="container">
        <div class="register-container">
            <div class="register-header">
                <h2>Resident Registration</h2>
                <p class="text-muted">Create your resident account</p>
            </div>
            
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name" required>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                </div>
                
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
                </div>
                
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                    <label class="form-check-label" for="terms">I agree to the Terms and Conditions</label>
                </div>
                
                <button type="submit" class="btn btn-primary btn-register">Register</button>
                
                <div class="login-link">
                    <p>Already have an account? <a href="<?= base_url('auth/resident/login') ?>">Login here</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Theme Toggle Script -->
    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const themeToggle = document.querySelector('.theme-toggle i');
            
            if (html.getAttribute('data-theme') === 'light') {
                html.setAttribute('data-theme', 'dark');
                themeToggle.classList.remove('fa-moon');
                themeToggle.classList.add('fa-sun');
                localStorage.setItem('theme', 'dark');
            } else {
                html.setAttribute('data-theme', 'light');
                themeToggle.classList.remove('fa-sun');
                themeToggle.classList.add('fa-moon');
                localStorage.setItem('theme', 'light');
            }
        }

        // Check for saved theme preference
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
            
            const themeToggle = document.querySelector('.theme-toggle i');
            if (savedTheme === 'dark') {
                themeToggle.classList.remove('fa-moon');
                themeToggle.classList.add('fa-sun');
            }
        });
    </script>
</body>
</html> 