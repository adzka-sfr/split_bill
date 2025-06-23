<?php
include "../_header.php";
include "../config.php";
if (isset($_SESSION['sb_id'])) {
    echo "<script>window.location='" . base_url('dashboard') . "';</script>";
    exit();
}
?>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                if (empty($_GET['page'])) {
                    $_GET['page'] = "login";
                } else {
                    include "content.php";
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#btn-register').click(function() {
                var username = $('#registerName').val();
                var password = $('#registerPassword').val();
                if (username === '' || password === '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Please fill in all fields!'
                    });
                    return;
                } else {
                    $.ajax({
                        url: 'register.php',
                        type: 'POST',
                        data: {
                            username: username,
                            password: password
                        },
                        success: function(response) {
                            if (response === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Registration successful! Logging you in...'
                                }).then(function() {
                                    // Fill login fields
                                    $('#loginEmail').val($('#registerName').val());
                                    $('#loginPassword').val($('#registerPassword').val());
                                    // Switch to login tab
                                    $('#login-tab').click();
                                    // Trigger login
                                    $('#btn-login').focus().click();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response
                                });
                            }
                        }
                    });
                }

            })

            // enter logic - login
            // Move focus from email to password on Enter, and from password to button
            $('#loginEmail').keypress(function(e) {
                if (e.which === 13) { // Enter key pressed
                    $('#loginPassword').focus();
                }
            });
            $('#loginPassword').keypress(function(e) {
                if (e.which === 13) { // Enter key pressed
                    $('#btn-login').focus().click();
                }
            });

            // enter logic - register
            $('#registerName').keypress(function(e) {
                if (e.which === 13) { // Enter key pressed
                    $('#registerPassword').focus();
                }
            });
            $('#registerPassword').keypress(function(e) {
                if (e.which === 13) { // Enter key pressed
                    $('#btn-register').focus().click();
                }
            });

            $('#btn-login').click(function() {
                var username = $('#loginEmail').val();
                var password = $('#loginPassword').val();
                if (username === '' || password === '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Please fill in all fields!'
                    });
                    return;
                } else {
                    $.ajax({
                        url: 'login.php',
                        type: 'POST',
                        data: {
                            username: username,
                            password: password
                        },
                        success: function(response) {
                            if (response === 'success') {
                                window.location.href = '../';
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Invalid username or password!'
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>

    <?php
    include "../_footer.php";
    ?>