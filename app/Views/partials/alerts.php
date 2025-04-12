<?php
$alertTypes = [
    'error' => 'danger',
    'success' => 'success',
    'info' => 'info',
    'warning' => 'warning'
];
?>

<!-- Fixed-position Alert Container -->
<div class="alert-container" style="position: fixed; top: 20px; right: 20px; z-index: 1050; width: 350px;">
    <?php foreach ($alertTypes as $type => $class): ?>
        <?php if (session()->has($type)): ?>
            <div class="alert alert-<?= $class ?> alert-dismissible fade show" role="alert">
                <?= session($type) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if (session()->has('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                <?php foreach (session('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>

<!-- Auto-dismiss script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all alerts
    const alerts = document.querySelectorAll('.alert');
    
    // Set timeout for each alert
    alerts.forEach(function(alert) {
        setTimeout(function() {
            // Create and dispatch a click event on the close button
            const closeBtn = alert.querySelector('.btn-close');
            if (closeBtn) {
                closeBtn.click();
            }
        }, 5000); // 5 seconds
    });
});</script> 