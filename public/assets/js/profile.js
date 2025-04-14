/**
 * Profile Picture Upload Functions
 */

// Get base URL from meta tag if available, or use default
const getBaseUrl = () => {
    const baseUrlMeta = document.querySelector('meta[name="base-url"]');
    return baseUrlMeta ? baseUrlMeta.getAttribute('content') : '';
};

// Get CSRF token for AJAX requests
const getCsrfToken = () => {
    const tokenCookie = document.cookie
        .split('; ')
        .find(row => row.startsWith('csrf_cookie_name='));
    
    if (tokenCookie) {
        return tokenCookie.split('=')[1];
    }
    
    // Fallback to meta tag
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    return csrfMeta ? csrfMeta.getAttribute('content') : '';
};

document.addEventListener('DOMContentLoaded', function() {
    console.log('Profile JS loaded');
    const profilePictureUpload = document.getElementById('profile-picture-upload');
    const profilePicturePreview = document.getElementById('profile-picture-preview');
    const uploadProfilePictureBtn = document.getElementById('upload-profile-picture-btn');
    const previewSection = document.querySelector('.preview-section');
    const previewLabel = document.getElementById('preview-label');
    
    console.log('Elements found:', {
        profilePictureUpload: !!profilePictureUpload,
        profilePicturePreview: !!profilePicturePreview,
        uploadProfilePictureBtn: !!uploadProfilePictureBtn,
        previewSection: !!previewSection,
        previewLabel: !!previewLabel
    });
    
    if (profilePictureUpload) {
        // Handle file selection for preview
        profilePictureUpload.addEventListener('change', function(e) {
            console.log('File selected:', e.target.files);
            const file = e.target.files[0];
            if (!file) {
                console.log('No file selected');
                return;
            }
            
            console.log('File type:', file.type);
            // Check if file is an image
            if (!file.type.match('image.*')) {
                alert('Please select an image file (jpg, jpeg, png)');
                return;
            }
            
            // Show preview elements
            if (previewLabel) {
                previewLabel.style.display = 'block';
                console.log('Preview label displayed');
            }
            
            if (uploadProfilePictureBtn) {
                uploadProfilePictureBtn.style.display = 'inline-block';
                console.log('Upload button displayed');
            }
            
            // Preview the selected image
            const reader = new FileReader();
            reader.onload = function(e) {
                console.log('File read completed');
                if (profilePicturePreview) {
                    profilePicturePreview.src = e.target.result;
                    profilePicturePreview.style.display = 'block';
                    console.log('Preview image updated');
                } else {
                    console.error('Preview image element not found');
                }
            };
            reader.onerror = function(e) {
                console.error('Error reading file:', e);
                alert('Error reading file. Please try another image.');
            };
            reader.readAsDataURL(file);
        });
    } else {
        console.error('File upload input not found');
    }
    
    if (uploadProfilePictureBtn) {
        // Handle upload button click
        uploadProfilePictureBtn.addEventListener('click', function() {
            console.log('Upload button clicked');
            uploadProfilePicture();
        });
    } else {
        console.error('Upload button not found');
    }
});

/**
 * Upload the profile picture using AJAX
 */
function uploadProfilePicture() {
    const fileInput = document.getElementById('profile-picture-upload');
    const residentId = document.getElementById('resident-id');
    const baseUrl = getBaseUrl();
    
    console.log('Upload function called');
    console.log('File input exists:', !!fileInput);
    console.log('Resident ID element exists:', !!residentId);
    console.log('Base URL:', baseUrl);
    
    if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
        alert('Please select a file to upload');
        return;
    }
    
    if (!residentId || !residentId.value) {
        console.error('Resident ID not found or empty:', residentId ? residentId.value : 'null');
        alert('Resident ID not found. Please reload the page and try again.');
        return;
    }
    
    const file = fileInput.files[0];
    console.log('File to upload:', file.name, file.type, file.size);
    
    const formData = new FormData();
    formData.append('profile_picture', file);
    formData.append('resident_id', residentId.value);
    
    // Add CSRF token if available
    const csrfToken = getCsrfToken();
    console.log('CSRF Token:', csrfToken ? 'Found' : 'Not found');
    
    // Show loading indicator
    const uploadBtn = document.getElementById('upload-profile-picture-btn');
    if (uploadBtn) {
        uploadBtn.disabled = true;
        uploadBtn.innerHTML = 'Uploading...';
    }
    
    // Construct full URL
    const uploadUrl = baseUrl + '/residents/uploadProfilePicture';
    console.log('Sending AJAX request to:', uploadUrl);
    
    // Setup headers
    const headers = {
        'X-Requested-With': 'XMLHttpRequest'
    };
    
    // Add CSRF header if token is available
    if (csrfToken) {
        headers['X-CSRF-TOKEN'] = csrfToken;
    }
    
    // Send AJAX request
    fetch(uploadUrl, {
        method: 'POST',
        body: formData,
        headers: headers
    })
    .then(response => {
        console.log('Response received:', response.status);
        if (!response.ok) {
            throw new Error('Server returned ' + response.status + ' ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.error) {
            console.error('Error from server:', data.error);
            alert('Error: ' + data.error);
        } else {
            // Success - update the profile picture
            const profileImg = document.getElementById('profile-picture');
            if (profileImg) {
                profileImg.src = data.profile_picture_url;
                console.log('Profile picture updated to:', data.profile_picture_url);
            } else {
                console.error('Profile image element not found');
            }
            alert('Profile picture updated successfully');
        }
    })
    .catch(error => {
        console.error('Error during fetch:', error);
        alert('An error occurred while uploading the profile picture: ' + error.message);
    })
    .finally(() => {
        // Reset button state
        if (uploadBtn) {
            uploadBtn.disabled = false;
            uploadBtn.innerHTML = 'Upload Picture';
            console.log('Upload button reset');
        }
    });
} 