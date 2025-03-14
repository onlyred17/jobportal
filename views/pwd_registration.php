<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PWD ID Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome for icons -->
    <style>
    /* Color Palette Styles */
    body {
        background: linear-gradient(135deg, #C6E7FF, #D4F6FF); /* Gradient background */
        color: #2E3A47; /* Primary text color */
        transition: all 0.3s ease; /* Smooth transition for brightness changes */
    }

    .container {
        margin-top: 5rem; /* Adjusted top margin */
    }

    h2 {
        color: #2E3A47; /* Heading color */
    }

    /* Smaller Form Box Styles */
    .form-box {
        background: #FFFFFF; /* White background for the form box */
        border-radius: 10px; /* Rounded corners */
        padding: 2rem; /* Reduced padding for smaller form */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Shadow for depth */
        max-width: 400px; /* Maximum width of the form box */
        margin: 0 auto; /* Center the form */
    }

    .form-control {
        background: #F8F9FA; /* Light grey background for inputs */
        border: 1px solid #E2E8F0; /* Light border color */
        color: #2E3A47; /* Input text color */
    }

    .form-label {
        color: black; /* Label text color */
    }

    .btn-primary {
        background: #4A90E2; /* Primary button color */
        border: none;
        color: white;
    }
    .btn-custom {
        background: #4A90E2; /* Primary button color */
        border: none;
        color: white;
    }

    .btn-custom:hover {
        background: #357ABD; /* Primary button hover color */
    }

    .btn-check-status {
        background: #28A745; /* Green for check status button */
        color: white;
        border-radius: 10px;
        border: none;
    }

    .btn-check-status:hover {
        background: #218838; /* Darker green for hover */
    }

    .alert-info {
        background-color: #D4F6FF; /* Light blue for info alerts */
        color: #2E3A47; /* Info alert text color */
    }

    .alert-danger {
        background-color: #F8D7DA; /* Light red for error alerts */
        color: #2E3A47; /* Error alert text color */
    }

    .info-panel {
        background: #FFFFFF;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .info-panel h2 {
        color: #2E3A47;
    }

    .highlight {
        color: #4A90E2; /* Highlight color for important text */
    }

    .subtext {
        font-size: 16px;
        color: #555;
    }

    .benefits h4 {
        color: #2E3A47;
    }

    .benefits ul {
        list-style-type: none;
        padding-left: 0;
    }

    .benefits li {
        color: #555;
        margin-bottom: 10px;
    }

    .support h4 {
        color: #2E3A47;
    }

    .support a {
        color: #4A90E2;
    }

    .support a:hover {
        color: #357ABD;
    }

    /* New Accessibility Controls Styles */
    .accessibility-controls {
        position: fixed;
        top: 20px;
        right: 20px;
        background: white;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 1000;
    }

    .accessibility-controls h5 {
        margin-bottom: 15px;
    }

    .controls-section {
        margin-bottom: 15px;
    }

    .font-size-controls, .brightness-controls {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .font-size-controls button, .brightness-controls button {
        margin: 0 5px;
        padding: 5px 10px;
        background: #4A90E2;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .font-size-controls span, .brightness-controls span {
        margin: 0 10px;
        min-width: 20px;
        text-align: center;
    }

    /* Dark Mode */
    body.dark-mode {
        background: #1a1a1a;
        color: #f0f0f0;
    }

    body.dark-mode .card,
    body.dark-mode .info-panel {
        background: #2c2c2c;
        color: #f0f0f0;
    }

    body.dark-mode h2,
    body.dark-mode h4,
    body.dark-mode .form-label {
        color: #f0f0f0;
    }

    body.dark-mode .form-control {
        background: #3a3a3a;
        border-color: #4a4a4a;
        color: #f0f0f0;
    }

    body.dark-mode .highlight {
        color: #6BB0FF;
    }

    body.dark-mode .subtext,
    body.dark-mode .benefits li {
        color: #c0c0c0;
    }

    /* High Contrast Mode */
    body.high-contrast {
        background: #000000;
        color: #FFFFFF;
    }

    body.high-contrast .card,
    body.high-contrast .info-panel {
        background: #000000;
        color: #FFFFFF;
        border: 2px solid #FFFFFF;
    }

    body.high-contrast h2,
    body.high-contrast h4,
    body.high-contrast .form-label {
        color: #FFFFFF;
    }

    body.high-contrast .form-control {
        background: #000000;
        border: 2px solid #FFFFFF;
        color: #FFFFFF;
    }

    body.high-contrast .highlight {
        color: #FFFF00;
    }

    body.high-contrast .subtext,
    body.high-contrast .benefits li {
        color: #FFFFFF;
    }

    body.high-contrast .btn-custom {
        background: #000000;
        color: #FFFFFF;
        border: 2px solid #FFFFFF;
    }

    /* Toggle buttons */
    .toggle-btn {
        margin-right: 10px;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }

    .toggle-btn.active {
        background: #4A90E2;
        color: white;
    }/* Accessibility Controls Styles */
.accessibility-controls {
    position: fixed;
    top: 20px;
    right: 20px;
    background: white;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    z-index: 1000;
    width: 270px;
    transition: all 0.3s ease;
}

.accessibility-controls h5 {
    margin-bottom: 15px;
    font-size: 1rem;
    font-weight: 600;
    color: #2E3A47;
}

.controls-section {
    margin-bottom: 15px;
}

.mode-toggle {
    display: flex;
    gap: 8px;
    margin-bottom: 15px;
}

.font-size-controls, .brightness-controls {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
}

.font-size-controls button, .brightness-controls button {
    padding: 5px 10px;
    background: #4A90E2;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.2s;
}

.font-size-controls button:hover, .brightness-controls button:hover {
    background: #357ABD;
}

.font-size-controls span, .brightness-controls span {
    margin: 0 5px;
    min-width: 50px;
    text-align: center;
    font-size: 0.9rem;
}

/* Toggle buttons */
.toggle-btn {
    flex: 1;
    padding: 8px 5px;
    border: 1px solid #E2E8F0;
    background-color: #F8F9FA;
    border-radius: 5px;
    cursor: pointer;
    font-weight: 500;
    font-size: 0.85rem;
    transition: all 0.2s;
    color: #2E3A47;
}

.toggle-btn:hover {
    background-color: #E2E8F0;
}

.toggle-btn.active {
    background: #4A90E2;
    color: white;
    border-color: #4A90E2;
}

/* Dark mode styles for the accessibility panel */
body.dark-mode .accessibility-controls {
    background: #2c2c2c;
    border: 1px solid #3a3a3a;
}

body.dark-mode .accessibility-controls h5 {
    color: #f0f0f0;
}

body.dark-mode .toggle-btn {
    background-color: #3a3a3a;
    border-color: #4a4a4a;
    color: #f0f0f0;
}

body.dark-mode .toggle-btn:hover {
    background-color: #4a4a4a;
}

body.dark-mode .toggle-btn.active {
    background: #6BB0FF;
    color: #1a1a1a;
}

body.dark-mode .font-size-controls span, 
body.dark-mode .brightness-controls span {
    color: #f0f0f0;
}

/* High contrast styles for the accessibility panel */
body.high-contrast .accessibility-controls {
    background: #000000;
    border: 2px solid #FFFFFF;
    color: #FFFFFF;
}

body.high-contrast .accessibility-controls h5 {
    color: #FFFFFF;
}

body.high-contrast .toggle-btn {
    background-color: #000000;
    border: 2px solid #FFFFFF;
    color: #FFFFFF;
}

body.high-contrast .toggle-btn:hover {
    background-color: #333333;
}

body.high-contrast .toggle-btn.active {
    background: #FFFFFF;
    color: #000000;
    border-color: #FFFFFF;
}

body.high-contrast .font-size-controls button, 
body.high-contrast .brightness-controls button {
    background: #000000;
    color: #FFFFFF;
    border: 2px solid #FFFFFF;
}

body.high-contrast .font-size-controls button:hover, 
body.high-contrast .brightness-controls button:hover {
    background: #333333;
}

body.high-contrast .font-size-controls span, 
body.high-contrast .brightness-controls span {
    color: #FFFFFF;
}

/* Make the panel responsive */
@media (max-width: 768px) {
    .accessibility-controls {
        width: 180px;
        padding: 10px;
    }
    
    .toggle-btn, 
    .font-size-controls button, 
    .brightness-controls button {
        padding: 5px;
        font-size: 0.8rem;
    }
    
    .font-size-controls span, 
    .brightness-controls span {
        min-width: 40px;
        font-size: 0.8rem;
    }
}
</style>

</head>
<body id="body-element">

<!-- Accessibility Control Panel -->
<div class="accessibility-controls">
    <h5><i class="fas fa-universal-access"></i> Accessibility</h5>
    
    <div class="controls-section">
        <div class="font-size-controls">
            <button id="decrease-font" title="Decrease Font Size"><i class="fas fa-minus"></i> A</button>
            <span id="font-size-value">100%</span>
            <button id="increase-font" title="Increase Font Size">A <i class="fas fa-plus"></i></button>
        </div>
    </div>
    
    <div class="controls-section">
        <div class="brightness-mode">
            <button id="normal-mode" class="toggle-btn active">Normal</button>
            <button id="dark-mode" class="toggle-btn">Dark</button>
            <button id="high-contrast" class="toggle-btn">High Contrast</button>
        </div>
    </div>
    
    <button id="reset-all" class="btn btn-sm btn-outline-secondary mt-2">Reset All</button>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Registration Form Card (Left side) -->
            <div class="card shadow-lg">
                <div class="card-body p-4">
                    <h2 class="text-center title mb-4">PWD ID Registration</h2>

                    <!-- Success/Error Message -->
                    <div class="mb-3 text-center">
                        <?php
                        if (isset($_GET['message'])) {
                            echo '<div class="alert alert-info">' . htmlspecialchars($_GET['message']) . '</div>';
                        }
                        ?>
                    </div>

                    <!-- Registration Form -->
                    <form id="pwdForm" action="../controllers/submit_pwd_application.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control" id="full_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="birthdate" class="form-label">Birthdate</label>
                            <input type="date" name="birthdate" class="form-control" id="birthdate" required>
                        </div>

                        <div class="mb-3">
                            <label for="disability_type" class="form-label">Disability Type</label>
                            <input type="text" name="disability_type" class="form-control" id="disability_type" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" class="form-control" id="address" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" id="contact_number" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>

                        <!-- Proof of PWD -->
                        <div class="mb-3">
                            <label for="proof_of_pwd" class="form-label">Upload Proof of PWD (Image or PDF)</label>
                            <input type="file" name="proof_of_pwd" class="form-control" id="proof_of_pwd" accept=".jpg, .jpeg, .png, .pdf" required>
                        </div>

                        <!-- Valid ID Upload -->
                        <div class="mb-3">
                            <label for="valid_id" class="form-label">Upload Valid ID (Image or PDF)</label>
                            <input type="file" name="valid_id" class="form-control" id="valid_id" accept=".jpg, .jpeg, .png, .pdf" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-custom">Register</button>
                            <!-- Check Status Button -->
                            <a href="../views/view_status.php" class="btn btn-check-status">Check Status</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <!-- Info Panel (Right side) -->
            <div class="info-panel">
                <div class="info-content">
                    <h2>Welcome to the <span class="highlight">PWD ID Registration</span>!</h2>
                    <p class="subtext">
                        Register your PWD ID to access benefits and services that promote inclusivity and support for persons with disabilities.
                    </p>
                    <div class="benefits">
                        <h4><i class="fas fa-check-circle"></i> Why Register?</h4>
                        <ul>
                            <li><i class="fas fa-users"></i> Access PWD-related services and benefits</li>
                            <li><i class="fas fa-briefcase"></i> Receive disability discounts and assistance</li>
                            <li><i class="fas fa-credit-card"></i> Easily identify and verify PWD status</li>
                            <li><i class="fas fa-handshake"></i> Contribute to an inclusive society</li>
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
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Accessibility Controls JavaScript -->
<script>
    // Font size adjustment
    let currentFontSize = 100;
    const fontSizeValue = document.getElementById('font-size-value');
    const decreaseFontBtn = document.getElementById('decrease-font');
    const increaseFontBtn = document.getElementById('increase-font');
    const bodyElement = document.getElementById('body-element');

    // Brightness modes
    const normalModeBtn = document.getElementById('normal-mode');
    const darkModeBtn = document.getElementById('dark-mode');
    const highContrastBtn = document.getElementById('high-contrast');
    const resetAllBtn = document.getElementById('reset-all');

    // Font size adjustment
    decreaseFontBtn.addEventListener('click', () => {
        if (currentFontSize > 70) {
            currentFontSize -= 10;
            updateFontSize();
        }
    });

    increaseFontBtn.addEventListener('click', () => {
        if (currentFontSize < 200) {
            currentFontSize += 10;
            updateFontSize();
        }
    });

    function updateFontSize() {
        document.documentElement.style.fontSize = `${currentFontSize}%`;
        fontSizeValue.textContent = `${currentFontSize}%`;
    }

    // Brightness/Display Mode
    normalModeBtn.addEventListener('click', () => {
        bodyElement.classList.remove('dark-mode', 'high-contrast');
        setActiveButton(normalModeBtn);
    });

    darkModeBtn.addEventListener('click', () => {
        bodyElement.classList.remove('high-contrast');
        bodyElement.classList.add('dark-mode');
        setActiveButton(darkModeBtn);
    });

    highContrastBtn.addEventListener('click', () => {
        bodyElement.classList.remove('dark-mode');
        bodyElement.classList.add('high-contrast');
        setActiveButton(highContrastBtn);
    });

    // Reset all accessibility settings
    resetAllBtn.addEventListener('click', () => {
        // Reset font size
        currentFontSize = 100;
        updateFontSize();
        
        // Reset brightness mode
        bodyElement.classList.remove('dark-mode', 'high-contrast');
        setActiveButton(normalModeBtn);
    });

    function setActiveButton(activeButton) {
        // Remove active class from all buttons
        const buttons = document.querySelectorAll('.toggle-btn');
        buttons.forEach(button => {
            button.classList.remove('active');
        });
        
        // Add active class to the clicked button
        activeButton.classList.add('active');
    }
</script>

</body>
</html>