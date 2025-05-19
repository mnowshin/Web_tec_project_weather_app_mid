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
    if (username.length < 6) {
        usernameError.textContent = 'Username must be at least 6 characters long';
        isValid = false;
    }

    // Password validation
    if (password.length < 6) {
        passwordError.textContent = 'Password must be at least 6 characters long';
        isValid = false;
    }

    // If valid, submit the form (let PHP handle redirect)
    if (isValid) {
        event.target.submit();
    }

    return isValid;
}
