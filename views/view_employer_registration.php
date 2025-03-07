<?php include '..//include/db_conn.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Registration - PWD Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Bootstrap JS (with Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
   html{
    height: 100%;
   }
    body {
        background: linear-gradient(135deg, #EBE5C2, #F8F3D9);
        color: #2E3A47;
        font-family: 'Roboto', sans-serif;
    }
    
.registration-container {
    display: flex;
    align-items: flex-start; /* Align items to the top */
    gap: 4rem;
    margin-top: 7rem;
    margin-left: 8rem;
}

/* Info Panel */
.info-panel {
    background: rgba(255, 255, 255, 0.8); /* Glassmorphism effect */
    border-radius: 20px;
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    padding: 2.5rem;
    width: 400px;
    min-height: 500px;
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

.benefits h4, .support h4 {
    color: #2E3A47;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
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
.registration-card {
    background: #FFFFFF;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    width: 500px; /* Fixed width */
    min-height: 500px; /* Set a minimum height */
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Ensures content is spaced evenly */
}
    .step {
        margin: 0;
        padding: 0;
        display: none;
    }
    .step.active {
        display: block;
    }
  /* Adjust form group spacing */
.form-group {
    position: relative;
    margin-bottom: 1.5rem; /* Reduced margin for better spacing */
}
.password-error1 {
    color: #DC3545;
    font-size: 0.9rem;
    display: none; /* Hidden by default */
    position: absolute;
    bottom: -1.2rem; /* Adjusted to move it closer to the input */
    left: 0;
}
/* Ensure the error message is positioned correctly */
.password-error1 {
    color: #DC3545;
    font-size: 0.9rem;
    display: none; /* Hidden by default */
    position: absolute;
    bottom: -2.6rem; /* Adjusted to move it closer to the input */
    left: 0;
}
/* Ensure the error message is positioned correctly */
.password-error {
    color: #DC3545;
    font-size: 0.9rem;
    display: none; /* Hidden by default */
    position: absolute;
    bottom: -1.2rem; /* Adjusted to move it closer to the input */
    left: 0;
}

/* Adjust input field padding */
.form-control {
    background: #F8F9FA;
    border: 1px solid #E2E8F0;
    color: #2E3A47;
    font-family: 'Roboto', sans-serif;
    font-size: 1rem;
    padding: 1rem; /* Adjusted padding for better alignment */
    height: auto;
}

/* Ensure labels are properly aligned */
.form-label {
    position: absolute;
    top: 50%;
    left: 1rem;
    transform: translateY(-50%);
    color: #6C757D;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    pointer-events: none;
}

/* Adjust label position when input is focused or has content */
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
    }
    .btn-primary:hover {
        background: #357ABD;
    }
    .btn-secondary {
        background: #6C757D;
        border: none;
        color: #FFFFFF;
        font-family: 'Roboto', sans-serif;
        font-weight: 500;
    }
    .btn-secondary:hover {
        background: #5A6268;
    }
    .password-error {
        color: #DC3545;
        font-size: 0.9rem;
        display: none;
        position: absolute;
        bottom: -1.5rem;
        left: 0;
    }
    h2 {
        color: #2E3A47;
        font-size: 1.5rem; /* Smaller font size for main heading */
        font-weight: 600; /* Slightly lighter weight */
        text-align: center;
        margin-bottom: 1.5rem;
        letter-spacing: -0.5px; /* Tighter letter spacing */
    }
    h4 {
        color: #2E3A47;
        font-size: 1.2rem; /* Smaller font size for subheadings */
        font-weight: 500; /* Medium weight */
        margin-bottom: 1.5rem;
        letter-spacing: -0.5px; /* Tighter letter spacing */
    }
    .step-indicator {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    .step-number {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #6C757D;
        color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 500; /* Medium weight */
        font-size: 0.9rem; /* Smaller font size for step numbers */
    }
    .step-number.active {
        background: #4A90E2;
       
        color: #FFFFFF;
    }
    .terms {
        margin-top: 1rem;
        font-size: 0.9rem;
        color: #6C757D;
    }
    .terms a {
        color: #4A90E2;
        text-decoration: none;
    }
    .terms a:hover {
        text-decoration: underline;
    }
    .next-button-container {
        display: flex;
        justify-content: center;
        margin-top: 1.5rem;
    }
    .btn-success {
    background: #4A90E2;
    border: none;
    color: #FFFFFF;
    font-family: 'Roboto', sans-serif;
    font-weight: 500;
    
}

.btn-success:hover {
    background: #357ABD;
}

.btn-secondary {
    background: #4A90E2;
    border: none;
    color: #FFFFFF;
    font-family: 'Roboto', sans-serif;
    font-weight: 500;
}
.button-container {
    display: flex;
    justify-content: center;
    gap: 1rem; /* Adds space between buttons */
    margin-top: 1.5rem;
}

.btn-secondary:hover {
    background: #357ABD;
}
/* Modern Style for Confirmation Step */
.confirmation-details {
            background: #FFFFFF;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid #E2E8F0;
        }

        .confirmation-details p {
            margin: 0.75rem 0;
            font-size: 0.95rem;
            color: #2E3A47;
            line-height: 1.6;
            padding: 0.5rem;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .confirmation-details p:hover {
            background-color: #F8F9FA;
            transform: translateX(5px);
        }
</style>
</head>
<body>
    <div class="container">
        <div class="registration-container">
              <!-- Information Panel on the Left -->
        <div class="info-panel">
            <div class="info-content">
                <h2>Welcome to the <span class="highlight">PWD Portal</span>!</h2>
                <p class="subtext">
                    Join us in building an inclusive workforce. Register as an employer to access a pool of talented professionals with disabilities.
                </p>
                <div class="benefits">
                    <h4><i class="fas fa-check-circle"></i> Why Register?</h4>
                    <ul>
                        <li><i class="fas fa-users"></i> Access a diverse talent pool</li>
                        <li><i class="fas fa-briefcase"></i> Post unlimited job openings</li>
                        <li><i class="fas fa-chart-line"></i> Track applications and analytics</li>
                        <li><i class="fas fa-handshake"></i> Build an inclusive workplace</li>
                    </ul>
                </div>
                <div class="support">
                    <h4><i class="fas fa-question-circle"></i> Need Help?</h4>
                    <p>
                        Contact our support team at <a href="mailto:support@pwdportal.com">support@pwdportal.com</a>
                        or call us at <a href="tel:+1234567890">+1 (234) 567-890</a>.
                    </p>
                </div>
            </div>
        </div>
            <!-- Registration Form -->
            <div class="registration-card">
                <h2>
                    <i class="fas fa-user-tie"></i> Employer Registration
                </h2>
                <div class="step-indicator">
                    <div class="step-number active">1</div>
                    <div class="step-number">2</div>
                    <div class="step-number">3</div> <!-- Added Step 3 -->
                </div>
                <form id="registrationForm" action="../controllers/employer_registration.php" method="POST" enctype="multipart/form-data">
                    <!-- Step 1: Personal Details -->
                    <div class="step active" id="step1">
                        <h4><i class="fas fa-user"></i> Personal Details</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder=" " required>
                                <label for="first_name" class="form-label">First Name</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder=" " required>
                                <label for="last_name" class="form-label">Last Name</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder=" " required>
                            <label for="email" class="form-label">Email</label>
                        </div>
                        <!-- Password Field -->
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder=" " required>
                            <label for="password" class="form-label">Password</label>
                            <small class="password-error1" id="password-error">
                                Password must be at least 8 characters long and include at least one letter and one number.
                            </small>
                        </div>
                        <!-- Confirm Password Field -->
                        <div class="form-group">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder=" " required>
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <small class="password-error" id="confirm-password-error">Passwords do not match.</small>
                        </div>
                        <div class="terms">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">I agree to the <a href="#" target="_blank">Terms and Conditions</a> and <a href="#" target="_blank">Privacy Policy</a>.</label>
                        </div>
                        <div class="next-button-container">
                            <button type="button" class="btn btn-primary next-step">Next <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Step 2: Company Details -->
                    <div class="step" id="step2">
                        <h4><i class="fas fa-building"></i> Company Details</h4>
                        <div class="form-group">
                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder=" " required>
                            <label for="company_name" class="form-label">Company Name</label>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="location" name="location" placeholder=" " required>
                            <label for="location" class="form-label">Location</label>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" id="company_logo" name="company_logo" accept="image/*">
                            <label for="company_logo" class="form-label">Company Logo</label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="company_description" name="company_description" rows="4" placeholder=" " required></textarea>
                            <label for="company_description" class="form-label">Company Description</label>
                        </div>
                        <div class="button-container">
                            <button type="button" class="btn btn-secondary prev-step"><i class="fas fa-arrow-left"></i> Previous</button>
                            <button type="button" class="btn btn-primary next-step">Next <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Step 3: Confirmation -->
                    <div class="step" id="step3">
                        <h4><i class="fas fa-check-circle"></i> Confirmation</h4>
                        <div class="confirmation-details">
                            <p><strong>First Name:</strong> <span id="confirm-first-name"></span></p>
                            <p><strong>Last Name:</strong> <span id="confirm-last-name"></span></p>
                            <p><strong>Email:</strong> <span id="confirm-email"></span></p>
                            <p><strong>Company Name:</strong> <span id="confirm-company-name"></span></p>
                            <p><strong>Location:</strong> <span id="confirm-location"></span></p>
                            <p><strong>Company Description:</strong> <span id="confirm-company-description"></span></p>
                        </div>
                        <div class="button-container">
                            <button type="button" class="btn btn-secondary prev-step"><i class="fas fa-arrow-left"></i> Previous</button>
                            <button type="submit" class="btn btn-success">Confirm and Submit <i class="fas fa-check"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Registration successful! You can now log in.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Error message will be dynamically inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- Missing Field Error Modal -->
<div class="modal fade" id="missingFieldModal" tabindex="-1" aria-labelledby="missingFieldModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="missingFieldModalLabel">Missing Fields</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Please fill out all required fields before proceeding.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
    const steps = document.querySelectorAll('.step');
    const nextButtons = document.querySelectorAll('.next-step');
    const prevButtons = document.querySelectorAll('.prev-step');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const passwordError = document.getElementById('password-error');
    const confirmPasswordError = document.getElementById('confirm-password-error');
    const stepNumbers = document.querySelectorAll('.step-number');
    const missingFieldModal = new bootstrap.Modal(document.getElementById('missingFieldModal'));

    let currentStep = 0;

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.classList.toggle('active', index === stepIndex);
        });
        stepNumbers.forEach((number, index) => {
            number.classList.toggle('active', index === stepIndex);
        });
    }

    function validatePassword() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        if (!passwordRegex.test(password)) {
            passwordError.style.display = 'block';
            return false;
        } else {
            passwordError.style.display = 'none';
        }

        if (password !== confirmPassword) {
            confirmPasswordError.style.display = 'block';
            return false;
        } else {
            confirmPasswordError.style.display = 'none';
        }

        return true;
    }

    function validateStep(stepIndex) {
        const step = steps[stepIndex];
        const inputs = step.querySelectorAll('input, textarea, select');
        let isValid = true;

        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value.trim()) {
                isValid = false;
            }
        });

        return isValid;
    }

    nextButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep === 0 && !validatePassword()) {
                return; // Stop if password validation fails
            }

            if (!validateStep(currentStep)) {
                missingFieldModal.show(); // Show missing field error modal
                return;
            }

            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }

            if (currentStep === 2) {
                // Populate confirmation details
                document.getElementById('confirm-first-name').textContent = document.getElementById('first_name').value;
                document.getElementById('confirm-last-name').textContent = document.getElementById('last_name').value;
                document.getElementById('confirm-email').textContent = document.getElementById('email').value;
                document.getElementById('confirm-company-name').textContent = document.getElementById('company_name').value;
                document.getElementById('confirm-location').textContent = document.getElementById('location').value;
                document.getElementById('confirm-company-description').textContent = document.getElementById('company_description').value;
            }
        });
    });

    prevButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });
});

        document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registrationForm');
    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
    const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
    const errorModalBody = document.querySelector('#errorModal .modal-body');

    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission
        console.log('Form submission triggered'); // Debugging statement

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Response received:', data); // Debugging statement
            if (data.status === 'success') {
                successModal.show(); // Show success modal
            } else {
                errorModalBody.textContent = data.message; // Set error message
                errorModal.show(); // Show error modal
            }
        })
        .catch(error => {
            console.error('Error:', error); // Debugging statement
            errorModalBody.textContent = 'An unexpected error occurred. Please try again.'; // Set generic error message
            errorModal.show(); // Show error modal
        });
    });
});
    </script>
</body>
</html>