// No need for validation if the user can't choose wrong!
$('#date_picker').datepicker({
    changeMonth: true,
    changeYear: true,
    yearRange: '-150:+0',
    dateFormat: 'dd/mm/yy',
    minDate: (new Date(1890, 1, 1)),
    maxDate: (new Date()),
});

$('#user_form1').hide();

function showInfo() {
    $('#user_form1').hide();
    $('#user_form').show();
}

function showOrders() {
    $('#user_form').hide();
    $('#user_form1').show();
    // Change right side to show user's orders
}

function uploadImage() {
    // Handle here or with php
}
