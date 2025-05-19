function validateRegistration(event) {
    event.preventDefault();

    // Get form inputs
    const name = document.getElementById('name').value.trim();
    const userid = document.getElementById('userid').value.trim();
    const email = document.getElementById('email').value.trim();
    const location = document.getElementById('location').value.trim();
    const country = document.getElementById('country').value.trim();
    const password = document.getElementById('password').value;
    const number = document.getElementById('number').value.trim();

    // Get error spans
    const nameError = document.getElementById('nameError');
    const useridError = document.getElementById('useridError');
    const emailError = document.getElementById('emailError');
    const locationError = document.getElementById('locationError');
    const countryError = document.getElementById('countryError');
    const passwordError = document.getElementById('passwordError');
    const numberError = document.getElementById('numberError');

    // Reset error messages
    nameError.textContent = '';
    useridError.textContent = '';
    emailError.textContent = '';
    locationError.textContent = '';
    countryError.textContent = '';
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

    // Country: Non-empty
    if (!country) {
        countryError.textContent = 'Country is required';
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
        const user = { name, userid, email, location, country, password, number };
        users.push(user);
        localStorage.setItem('users', JSON.stringify(users));
        localStorage.setItem('registrationSuccess', 'Registration successful! Please login.');
        window.location.href = '../index.php';
    }
}