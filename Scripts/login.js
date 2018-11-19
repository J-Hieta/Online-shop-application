function fromRegistration(message) {
    // If user registered show success alert
    if (message === 'successful') {
        // Show alert and slide smoothly it after some seconds
        const success = $('#success_alert');
        success.show();
        setTimeout(() => {
            success.slideUp('slow');
        }, 2500);
    }
}
