<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Barangay Information System' ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
    <!-- Custom styles -->
    <style>
        .login-page {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            width: 400px;
        }
        .login-logo {
            font-size: 2.1rem;
            font-weight: 300;
            margin-bottom: 0.9rem;
            text-align: center;
            color: #fff;
        }
        .login-card {
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .login-card-body {
            border-radius: 10px;
            padding: 2rem;
        }
        .btn-login {
            background: #1e3c72;
            border-color: #1e3c72;
        }
        .btn-login:hover {
            background: #2a5298;
            border-color: #2a5298;
        }
        .register-link {
            color: #1e3c72;
            text-decoration: none;
        }
        .register-link:hover {
            color: #2a5298;
            text-decoration: underline;
        }
    </style>
</head>
<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>Barangay</b> Information System
        </div>
        <div class="card login-card">
            <div class="card-body login-card-body">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>
</body>
</html> 