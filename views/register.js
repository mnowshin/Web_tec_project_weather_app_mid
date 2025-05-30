function validateRegistration(event) {
    event.preventDefault();

    const name = document.getElementById('name').value.trim();
    const userid = document.getElementById('userid').value.trim();
    const email = document.getElementById('email').value.trim();
    const location = document.getElementById('location').value.trim();
    const password = document.getElementById('password').value;
    const number = document.getElementById('number').value.trim();

    // Get error spans
    const nameError = document.getElementById('nameError');
    const useridError = document.getElementById('useridError');
    const emailError = document.getElementById('emailError');
    const locationError = document.getElementById('locationError');
    const passwordError = document.getElementById('passwordError');
    const numberError = document.getElementById('numberError');

    // Reset error messages
    nameError.textContent = '';
    useridError.textContent = '';
    emailError.textContent = '';
    locationError.textContent = '';
    passwordError.textContent = '';
    numberError.textContent = '';

    let isValid = true;

    // Validation rules
    // Name: Non-empty
    if (!name) {
        nameError.textContent = 'Name is required';
        isValid = false;
    }

    // UserID: Non-empty, unique
    const users = JSON.parse(localStorage.getItem('users')) || [];
    if (!userid) {
        useridError.textContent = 'UserID is required';
        isValid = false;
    } else if (users.some(user => user.userid === userid)) {
        useridError.textContent = 'UserID already exists';
        isValid = false;
    }

    // Email: Valid format
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email) {
        emailError.textContent = 'Email is required';
        isValid = false;
    } else if (!emailRegex.test(email)) {
        emailError.textContent = 'Enter a valid email address';
        isValid = false;
    }

    // Location: Non-empty
    if (!location) {
        locationError.textContent = 'Location is required';
        isValid = false;
    }

    // Password: 8+ characters, mixed case, numbers, special characters
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
    if (!password) {
        passwordError.textContent = 'Password is required';
        isValid = false;
    } else if (!passwordRegex.test(password)) {
        passwordError.textContent = 'Password must be 8+ characters, with uppercase, lowercase, number, and special character';
        isValid = false;
    }

    // Phone Number: 10-12 digits
    const numberRegex = /^\d{10,12}$/;
    if (!number) {
        numberError.textContent = 'Phone number is required';
        isValid = false;
    } else if (!numberRegex.test(number)) {
        numberError.textContent = 'Enter a valid phone number (10-12 digits)';
        isValid = false;
    }

    // If valid, store user data and redirect
    if (isValid) {
        // Create form data
        const formData = new FormData();
        formData.append('name', name);
        formData.append('userid', userid);
        formData.append('email', email);
        formData.append('location', location);
        formData.append('password', password);
        formData.append('number', number);

        // Send AJAX request
        fetch('register.php', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.href = data.redirect;
            } else {
                if (data.errors) {
                    if (data.errors.userid) useridError.textContent = data.errors.userid;
                    if (data.errors.email) emailError.textContent = data.errors.email;
                    if (data.errors.database) alert(data.errors.database);
                }
                console.error('Registration failed:', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Registration failed. Please try again.');
        });
    }
}