<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Barangay Management System</title>
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

        .register-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background: var(--card-bg);
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h1 {
            color: var(--primary-color);
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .register-header p {
            color: var(--secondary-color);
            font-size: 16px;
        }

        .form-control {
            background-color: var(--input-bg);
            border-color: var(--border-color);
            color: var(--text-color);
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25);
            background-color: var(--input-bg);
            color: var(--text-color);
        }

        .form-label {
            color: var(--text-color);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            font-weight: 500;
            border-radius: 8px;
            background: var(--primary-color);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
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

        .admin-link {
            position: fixed;
            top: 20px;
            right: 70px;
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

        .admin-link:hover {
            transform: scale(1.05);
            color: var(--primary-color);
        }

        .theme-toggle:hover {
            transform: scale(1.1);
        }

        .theme-toggle i {
            color: var(--text-color);
            font-size: 20px;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .alert {
            border-radius: 8px;
            padding: 12px 20px;
        }

        .form-text {
            color: var(--secondary-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <a href="<?= base_url('/') ?>" class="home-link">
        <i class="fas fa-home me-2"></i>Home
    </a>
    <a href="<?= base_url('auth/admin_login') ?>" class="admin-link">
        <i class="fas fa-user-shield me-2"></i>Admin
    </a>
    <button class="theme-toggle" id="themeToggle">
        <i class="fas fa-sun"></i>
    </button>

    <div class="container">
        <div class="register-container">
            <div class="register-header">
                <h1>Create Account</h1>
                <p>Register as a resident</p>
            </div>
            
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger">
                    <?= session('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->has('success')): ?>
                <div class="alert alert-success">
                    <?= session('success') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('auth/register') ?>" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div class="form-text">Password must be at least 8 characters long</div>
                </div>
                
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="contact" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="contact" name="contact" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="birthdate" class="form-label">Birth Date</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                    <label class="form-check-label" for="terms">I agree to the <a href="<?= base_url('legal/terms') ?>">terms</a></label>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-user-plus me-2"></i>Register
                </button>
            </form>
            
            <div class="login-link">
                <p>Already have an account? <a href="<?= base_url('auth/login') ?>">Login here</a></p>
            </div>
        </div>
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
    </script>
</body>
</html> 