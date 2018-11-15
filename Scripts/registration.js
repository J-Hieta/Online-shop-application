let password;
let password_confirm;

function check_passwords() {
    password = document.getElementById('password');
    password_confirm = document.getElementById('password_confirm');

    // Check that passwords match. If not, inform user
    if (password.value !== password_confirm.value) {
        password_confirm.setCustomValidity('Passwords do not match');
    }
    else {
        // Passwords match, reset alert to non-existent
        password_confirm.setCustomValidity('');
    }
}
