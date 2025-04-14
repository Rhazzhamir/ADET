<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<!-- Meta tags for JavaScript -->
<meta name="base-url" content="<?= base_url() ?>">
<meta name="csrf-token" content="<?= csrf_hash() ?>">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Test Profile Picture Upload</h3>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h4><?= $resident['full_name'] ?></h4>
                        <p><?= $resident['email'] ?><br><?= $resident['phone'] ?></p>
                    </div>
                    
                    <hr>
                    
                    <!-- Include the profile picture upload component -->
                    <?= $this->include('partials/profile_picture_upload') ?>
                    
                    <div class="mt-4 p-3 bg-light">
                        <h5>Debug Information:</h5>
                        <div id="debug-info" class="small">
                            <p>Resident ID: <?= $resident['id'] ?></p>
                            <p>Upload URL: <code><?= base_url('residents/uploadProfilePicture') ?></code></p>
                            <p>Base URL: <code><?= base_url() ?></code></p>
                            <p>CSRF Token: <code><?= csrf_hash() ?></code></p>
                        </div>
                        <div id="console-output" class="bg-dark text-light p-2 mt-2" style="height: 150px; overflow-y: auto; font-family: monospace;">
                            <!-- Console output will be displayed here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Override console.log to display in our debug div
document.addEventListener('DOMContentLoaded', function() {
    const originalConsoleLog = console.log;
    const originalConsoleError = console.error;
    const consoleOutput = document.getElementById('console-output');
    
    // Override console.log
    console.log = function() {
        // Call the original console.log
        originalConsoleLog.apply(console, arguments);
        
        // Add to our debug div
        const args = Array.from(arguments);
        const message = args.map(arg => {
            if (typeof arg === 'object') {
                try {
                    return JSON.stringify(arg, null, 2);
                } catch (e) {
                    return String(arg);
                }
            }
            return String(arg);
        }).join(' ');
        
        if (consoleOutput) {
            const logLine = document.createElement('div');
            logLine.textContent = '> ' + message;
            consoleOutput.appendChild(logLine);
            consoleOutput.scrollTop = consoleOutput.scrollHeight;
        }
    };
    
    // Override console.error
    console.error = function() {
        // Call the original console.error
        originalConsoleError.apply(console, arguments);
        
        // Add to our debug div with error styling
        const args = Array.from(arguments);
        const message = args.map(arg => {
            if (typeof arg === 'object') {
                try {
                    return JSON.stringify(arg, null, 2);
                } catch (e) {
                    return String(arg);
                }
            }
            return String(arg);
        }).join(' ');
        
        if (consoleOutput) {
            const logLine = document.createElement('div');
            logLine.textContent = '! ' + message;
            logLine.style.color = '#ff5252';
            consoleOutput.appendChild(logLine);
            consoleOutput.scrollTop = consoleOutput.scrollHeight;
        }
    };
    
    console.log('Debug console initialized');
});
</script>
<?= $this->endSection() ?> 