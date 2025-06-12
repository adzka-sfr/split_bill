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
                <div class="card shadow">
                    <div class="card-header text-center">
                        <!-- <h2>Split Bill<sub style="font-size: 10px;">by Adzka</sub></h2> -->
                        <p class="text-muted">Login or Register to continue</p>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-3" id="authTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">Login</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab">Register</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="authTabContent">
                            <div class="tab-pane fade show active" id="login" role="tabpanel">
                                <div class="mb-3">
                                    <label for="loginEmail" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="loginEmail" required>
                                </div>
                                <div class="mb-3">
                                    <label for="loginPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="loginPassword" required>
                                </div>
                                <button type="button" class="btn btn-primary w-100" id="btn-login">Login</button>
                            </div>
                            <div class="tab-pane fade" id="register" role="tabpanel">
                                <div class="mb-3">
                                    <label for="registerName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="registerName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="registerPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="registerPassword" required>
                                </div>
                                <button type="button" class="btn btn-success w-100" id="btn-register">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
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