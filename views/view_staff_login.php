<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login - PWD Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
   /* General Styles */
html, body {
    height: 100%;
    margin: 0;
    font-family: 'Roboto', sans-serif;
    background: linear-gradient(135deg, #C6E7FF, #D4F6FF); /* New gradient background */
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    padding: 2rem;
}

.login-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 4rem; /* Spacing between info panel and login card */
    max-width: 1200px;
    width: 100%;
}

/* Info Panel */
.info-panel {
    background: #FBFBFB; /* Solid color from the palette */
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    padding: 2.5rem;
    width: 400px;
    min-height: 400px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.info-content {
    text-align: left;
}

.info-panel h2 {
    color: #2E3A47;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.highlight {
    color: #4A90E2;
}

.subtext {
    color: #6C757D;
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 2rem;
}

.benefits ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.benefits ul li {
    color: #6C757D;
    font-size: 1rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.benefits ul li i {
    color: #4A90E2;
    font-size: 1.2rem;
}

.support p {
    color: #6C757D;
    font-size: 1rem;
    line-height: 1.6;
}

.support a {
    color: #4A90E2;
    text-decoration: none;
    font-weight: 500;
}

.support a:hover {
    text-decoration: underline;
}

/* Login Card */
.login-card {
    background-image: url('../images/bg4.jpg'); /* Solid color from the palette */
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    padding: 2.5rem;
    width: 400px;
    min-height: 400px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.login-card h2 {
    color:rgb(255, 255, 255);
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    text-align: center;
}

.form-group {
    position: relative;
    margin-bottom: 1.5rem;
}

.form-control {
    background: #F8F9FA;
    border: 1px solid #E2E8F0;
    color:rgb(0, 0, 0);
    font-family: 'Roboto', sans-serif;
    font-size: 1rem;
    padding: 1rem;
    height: auto;
    width: 100%;
    border-radius: 8px;
}

.form-label {
    position: absolute;
    top: 50%;
    left: 1rem;
    transform: translateY(-50%);
    color:rgb(0, 8, 15);
    font-size: 0.9rem;
    transition: all 0.2s ease;
    pointer-events: none;
}

.form-control:focus + .form-label,
.form-control:not(:placeholder-shown) + .form-label {
    top: 0.7rem;
    font-size: 0.8rem;
    color: #4A90E2;
}

.btn-primary {
    background: #4A90E2;
    border: none;
    color: #FFFFFF;
    font-family: 'Roboto', sans-serif;
    font-weight: 500;
    padding: 0.75rem;
    border-radius: 8px;
    width: 100%;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #357ABD;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.forgot-password {
    text-align: center;
    margin-top: 1rem;
}

.forgot-password a {
    color:rgb(0, 0, 0);
    text-decoration: none;
    font-weight: 500;
}

.forgot-password a:hover {
    text-decoration: underline;
}

.sign-up-link {
    text-align: center;
    margin-top: 1.5rem;
    font-size: 0.95rem;
}

.sign-up-link a {
    color:rgb(0, 0, 0);
    text-decoration: none;
    font-weight: 500;
}

.sign-up-link a:hover {
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 768px) {
    .login-container {
        flex-direction: column;
        align-items: center;
        gap: 2rem; /* Smaller gap for mobile */
    }

    .info-panel, .login-card {
        width: 100%;
        margin-bottom: 2rem;
    }
}
        </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <!-- Info Panl -->
                  <!-- Info Panel -->
            <div class="info-panel">
                <div class="info-content">
                    <h2>Welcome Back to the <span class="highlight">PWD Portal</span>!</h2>
                    <p class="subtext">
                        Log in to manage your job postings, track applications, and connect with talented professionals.
                    </p>
                    <div class="benefits">
                        <ul>
                            <li><i class="fas fa-users"></i> Access your staff dashboard</li>
                            <li><i class="fas fa-briefcase"></i> Manage job postings</li>
                            <li><i class="fas fa-chart-line"></i> Track application analytics</li>
                        </ul>
                    </div>
                    <div class="support">
                        <p>
                            Need help? Contact us at <a href="mailto:support@pwdportal.com">support@pwdportal.com</a>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Login Form -->
            <div class="login-card">
                <h2><i class="fas fa-sign-in-alt"></i> Staff Login</h2>
                <form id="loginForm" method="POST" action="../controllers/staff_login.php">
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder=" " required>
                        <label for="email" class="form-label">Email</label>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder=" " required>
                        <label for="password" class="form-label">Password</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Log In</button>
                 
                 
                </form>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Login successful! Redirecting to your dashboard...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="errorModalBody">
                    <!-- Error message will be inserted here dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and AJAX Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            // Get form data
            const formData = new FormData(this);

            // Send AJAX request
            fetch('../controllers/staff_login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Show success modal
                    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();

                    // Redirect to dashboard after 2 seconds
                    setTimeout(() => {
                        window.location.href = 'view_staff_dashboard.php';
                    }, 2000);
                } else {
                    // Show error modal
                    const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                    document.getElementById('errorModalBody').textContent = data.message;
                    errorModal.show();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                document.getElementById('errorModalBody').textContent = 'An unexpected error occurred. Please try again.';
                errorModal.show();
            });
        });
    </script>
</body>
</html>