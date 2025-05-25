function validateProfileForm() {
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const location = document.getElementById('location');
    const phone = document.getElementById('phone');
    
    const nameError = document.getElementById('nameError');
    const emailError = document.getElementById('emailError');
    const locationError = document.getElementById('locationError');
    const phoneError = document.getElementById('phoneError');
    
    // Reset errors
    nameError.textContent = '';
    emailError.textContent = '';
    locationError.textContent = '';
    phoneError.textContent = '';
    
    let isValid = true;

    // Name validation
    if (name.value.trim().length < 3) {
        nameError.textContent = 'Name must be at least 3 characters long';
        isValid = false;
    }

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value)) {
        emailError.textContent = 'Please enter a valid email address';
        isValid = false;
    }

    // Location validation
    if (location.value.trim().length < 2) {
        locationError.textContent = 'Please enter a valid location';
        isValid = false;
    }

    // Phone validation
    const phoneRegex = /^\d{10,12}$/;
    if (!phoneRegex.test(phone.value.replace(/[-()\s]/g, ''))) {
        phoneError.textContent = 'Please enter a valid phone number (10-12 digits)';
        isValid = false;
    }

    return isValid;
}

// Add success message fade out
document.addEventListener('DOMContentLoaded', function() {
    const successMessage = document.querySelector('.success-message');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.opacity = '0';
            setTimeout(() => successMessage.remove(), 500);
        }, 3000);
    }
});
