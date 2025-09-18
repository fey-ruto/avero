$(document).ready(function() {
    $('#login-form').submit(function(e) {
        e.preventDefault();

        var email    = $('#email').val();
        var password = $('#password').val();

        if (email == '' || password == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in both fields!',
            });
            return;
        }

        $.ajax({
            url: '../actions/login_action.php',
            type: 'POST',
            data: {
                email: email,
                password: password
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#loginMsg').text(response.message).css('color', 'green');

                    Swal.fire({
                        icon: 'success',
                        title: 'Welcome',
                        text: response.message,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../index.php';
                        }
                    });
                } else {
                    $('#loginMsg').text(response.message).css('color', 'red');
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'An error occurred! Please try again later.',
                });
            }
        });
    });
});
