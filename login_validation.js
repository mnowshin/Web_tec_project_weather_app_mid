function validateForm(event) {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const usernameError = document.getElementById('usernameError');
    const passwordError = document.getElementById('passwordError');

    // Reset error messages
    usernameError.textContent = '';
    passwordError.textContent = '';

    let isValid = true;

    // Username validation
    if (username.length < 4) {
        usernameError.textContent = 'Username must be at least 4 characters long';
        isValid = false;
    }

    // Password validation
    if (password.length < 6) {
        passwordError.textContent = 'Password must be at least 6 characters long';
        isValid = false;
    }

    // If valid, store username and redirect to dashboard
    if (isValid) {
        localStorage.setItem('username', username);
        window.location.href = 'dashboard.html';
    }

    return isValid;
}