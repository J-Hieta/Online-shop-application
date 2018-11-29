// No need for validation if the user can't choose wrong!
// $('#date_picker').datepicker({
//     changeMonth: true,
//     changeYear: true,
//     yearRange: '-150:+0',
//     dateFormat: 'dd/mm/yy',
//     minDate: (new Date(1890, 1, 1)),
//     maxDate: (new Date()),
// });

$('#orders_table').hide();

function showInfo() {
    $('#orders_table').hide();
    $('#user_form').show();
    $('#deleting_button').show();
}

function showOrders() {
    $('#user_form').hide();
    $('#deleting_button').hide();
    $('#orders_table').show();
}

$(function() {
    // UPDATE
    $('#user_form').submit(function(button) {
        button.preventDefault();                        // Prevent traditional submission

        const fname = $('#first_name').val();
        const lname = $('#last_name').val();
        const e_mail = $('#email').val();
        // const d_picker = $('#date_picker').val();
        const pass_old = $('#password_old').val();
        const pass_new = $('#password_new').val();

        if ($(this).parsley().isValid()) {
            $.ajax({
                url: '../Scripts/updateUserInfo.php',
                data: {
                    first_name: fname,
                    last_name: lname,
                    email: e_mail,
                    // date_picker: d_picker,
                    password_old: pass_old,
                    password_new: pass_new,
                },
                type: 'post',
            })
            .done(function(data) {
                if (data  === "Wrong password") {
                    alert('Invalid password');
                }
                else if(data === 'Success') {
                    const success = $('#success_update');
                    success.slideDown('slow');
                    setTimeout(() => {
                        success.slideUp('slow');
                    }, 2500);
                }
                else {
                    alert('data: ' + data);                     // For safety reasons this would get removed
                }
            })
            .fail(function(data) {
                alert('Error occured when updating: ' + data);  // For safety reasons this would get removed
            })
        }
    });

    // DELETE
    $('#delete_button').click(() => {
        $.ajax({
            url: '../Scripts/deleteUser.php',
            type: 'post',
        })
        .done(function(data) {
            if(data === 'Error') {
                alert('Something went wrong when deleting user');
            }
            else if (data === 'Deleted') {
                // Log out
                window.location.replace('../Layouts/logout.php?deleted=true');
            }
            else {
                alert('Error occured when deleting1: ' + data);        // For safety reasons this would get removed
            }
        })
        .fail(function(data) {
            alert('Error occured when deleting: ' + data);        // For safety reasons this would get removed
        })
    });

// Code found from:
// https://www.abeautifulsite.net/whipping-file-inputs-into-shape-with-bootstrap-3

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