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
                <button type="button" class="btn btn-success w-100 mt-3" id="btn-check">Trip Checker</button>
                <script>
                document.getElementById('btn-check').addEventListener('click', function() {
                    const url = new URL(window.location.href);
                    url.searchParams.set('page', 'check');
                    window.location.href = url.pathname.replace(/\/auth\/login\/index\.php$/, '/auth/main.php') + url.search;
                });
                </script>
                
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