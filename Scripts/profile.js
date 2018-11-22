// No need for validation if the user can't choose wrong!
$('#date_picker').datepicker({
    changeMonth: true,
    changeYear: true,
    yearRange: '-150:+0',
    dateFormat: 'dd/mm/yy',
    minDate: (new Date(1890, 1, 1)),
    maxDate: (new Date()),
});

// $('#user_form1').hide();

function showInfo() {
    // $('#user_form1').hide();
    $('#user_form').show();
}

function showOrders() {
    $('#user_form').hide();
    // $('#user_form1').show();
    // Change right side to show user's orders
}


// Code found from:
// https://www.abeautifulsite.net/whipping-file-inputs-into-shape-with-bootstrap-3
$(function () {

    // We can attach the `fileselect` event to all file inputs on the page
    $(document).on('change', ':file', function () {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    // We can watch for our custom `fileselect` event like this
    $(document).ready(function () {
        $(':file').on('fileselect', function (event, numFiles, label) {
            
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }
        });
    });
});