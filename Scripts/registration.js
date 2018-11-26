let password;
let password_confirm;

function checkPasswords() {
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

let password_new;
let password_confirm_update;

function checkPasswordsOnUpdate() {
    password_new = document.getElementById('password_new');
    password_confirm_update = document.getElementById('password_confirm_update');

    // Check that passwords match. If not, inform user
    if (password_new.value !== password_confirm_update.value) {
        password_confirm_update.setCustomValidity('Passwords do not match');
    }
    else {
        // Passwords match, reset alert to non-existent
        password_confirm_update.setCustomValidity('');
    }
}
