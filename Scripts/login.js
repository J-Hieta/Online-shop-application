function fromRegistration(message) {
    // If user registered show success alert
    if (message === 'successful') {
        // Show alert and slide it smoothly after some seconds
        const success = $('#success_alert');
        success.slideDown('slow');
        setTimeout(() => {
            success.slideUp('slow');
        }, 2500);
    }
}
