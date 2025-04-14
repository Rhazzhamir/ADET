<div class="profile-picture-container">
    <!-- Hidden resident ID field for AJAX request -->
    <input type="hidden" id="resident-id" value="<?= isset($resident['id']) ? $resident['id'] : '' ?>">
    
    <!-- Current profile picture display -->
    <div class="profile-picture-wrapper">
        <img id="profile-picture" src="<?= isset($resident['profile_picture']) && !empty($resident['profile_picture']) 
            ? base_url($resident['profile_picture']) 
            : base_url('assets/img/default-profile.png') ?>" 
            alt="Profile Picture" class="rounded-circle profile-img">
    </div>
    
    <!-- Upload form -->
    <div class="profile-upload-section mt-3">
        <div class="form-group">
            <label for="profile-picture-upload" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-camera"></i> Select Image
            </label>
            <input type="file" id="profile-picture-upload" accept="image/jpeg,image/png,image/jpg" class="d-none">
        </div>
        
        <!-- Preview section -->
        <div class="preview-section mt-2">
            <p class="text-muted small" id="preview-label" style="display: none;">Preview:</p>
            <div class="preview-container">
                <img id="profile-picture-preview" src="#" alt="Preview" style="max-width: 100%; max-height: 150px; display: none; margin: 0 auto;">
            </div>
            <button type="button" id="upload-profile-picture-btn" class="btn btn-primary btn-sm mt-2" style="display: none;">
                <i class="fas fa-upload"></i> Upload Picture
            </button>
        </div>
    </div>
</div>

<!-- Include the necessary JavaScript -->
<script src="<?= base_url('assets/js/profile.js') ?>"></script>

<style>
    .profile-picture-container {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .profile-picture-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto;
        overflow: hidden;
        border-radius: 50%;
        border: 3px solid #2979ff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .profile-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .preview-section {
        margin-top: 15px;
    }
    
    .preview-container {
        margin: 10px 0;
        text-align: center;
    }
</style>

<script>
    // Show preview section when a file is selected
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Profile upload partial loaded');
        const fileInput = document.getElementById('profile-picture-upload');
        
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const previewLabel = document.getElementById('preview-label');
                const previewImg = document.getElementById('profile-picture-preview');
                const uploadBtn = document.getElementById('upload-profile-picture-btn');
                
                if (this.files.length > 0) {
                    // Show preview elements
                    if (previewLabel) previewLabel.style.display = 'block';
                    if (uploadBtn) uploadBtn.style.display = 'inline-block';
                    
                    console.log('File selected in partial');
                }
            });
        } else {
            console.error('File input not found in partial');
        }
    });
</script> 