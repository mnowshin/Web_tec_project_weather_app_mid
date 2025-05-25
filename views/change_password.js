function validateForm() {
    const currentPassword = document.getElementById('current_password');
    const newPassword = document.getElementById('new_password');
    const confirmPassword = document.getElementById('confirm_password');
    
    const currentPasswordError = document.getElementById('currentPasswordError');
    const newPasswordError = document.getElementById('newPasswordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');
    
    // Reset errors
    currentPasswordError.textContent = '';
    newPasswordError.textContent = '';
    confirmPasswordError.textContent = '';
    
    let isValid = true;

    // Current password validation
    if (currentPassword.value.length < 1) {
        currentPasswordError.textContent = 'Please enter your current password';
        isValid = false;
    }

    // New password validation
    if (newPassword.value.length < 8) {
        newPasswordError.textContent = 'Password must be at least 8 characters long';
        isValid = false;
    }

    // Password complexity check
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!passwordRegex.test(newPassword.value)) {
        newPasswordError.textContent = 'Password must contain uppercase, lowercase, number and special character';
        isValid = false;
    }

    // Confirm password validation
    if (newPassword.value !== confirmPassword.value) {
        confirmPasswordError.textContent = 'Passwords do not match';
        isValid = false;
    }

    return isValid;
}

// Add dropdown menu functionality
document.addEventListener('DOMContentLoaded', function() {
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('userDropdown');
        const userProfile = document.querySelector('.user-profile');
        if (!userProfile.contains(e.target) && dropdown.style.display === 'block') {
            dropdown.style.display = 'none';
        }
    });
});

function toggleDropdown(event) {
    const dropdown = document.getElementById('userDropdown');
    const isVisible = dropdown.style.display === 'block';
    
    // Close any open dropdowns first
    const dropdowns = document.getElementsByClassName('dropdown');
    for (let d of dropdowns) {
        d.style.display = 'none';
    }
    
    if (!isVisible) {
        dropdown.style.display = 'block';
        event.stopPropagation();
    }
}
