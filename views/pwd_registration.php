<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="../css/landing_page.css">

<body id="body-element">
    <!-- Header -->
    <header>
        <div class="header-container">
            <h1>DisabilityToAbility</h1>
            <nav>
    <a href="../views/pwd_landing_page.php#home">Home</a>
    <a href="../views/pwd_landing_page.php#about" >About Us</a>
    <a href="../views/pwd_landing_page.php#jobs">Job Wall</a>
    <a href="../views/pwd_registration.php">PWD Registration</a>
</nav>
        </div>
    </header>


    <div class="registration-container">
        <h2>PWD ID Registration</h2>
        <p class="registration-intro">Register your PWD ID to access personalized job recommendations and special features tailored for Persons with Disabilities.</p>
        
        <?php if(isset($_GET['message'])): ?>
            <div class="alert <?php echo strpos($_GET['message'], 'successful') !== false ? 'alert-success' : 'alert-error'; ?>">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>
        
        <form id="pwd-registration-form" class="registration-form" action="../controllers/submit_pwd_application.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <h3>Personal Information</h3>
                
                <div class="form-row">
                    <div class="form-field full-width">
                        <label for="full-name">Full Name <span class="required">*</span></label>
                        <input type="text" id="full-name" name="full_name" placeholder="Enter your complete name" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-field">
                        <label for="birthdate">Date of Birth <span class="required">*</span></label>
                        <input type="date" id="birthdate" name="birthdate" required>
                    </div>
                    <div class="form-field">
                        <label for="contact-number">Contact Number <span class="required">*</span></label>
                        <input type="tel" id="contact-number" name="contact_number" placeholder="Enter your phone number" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-field">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-field full-width">
                        <label for="address">Complete Address <span class="required">*</span></label>
                        <textarea id="address" name="address" rows="3" placeholder="Enter your complete address" required></textarea>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <h3>PWD Information</h3>
                
                <div class="form-row">
                    <div class="form-field full-width">
                        <label for="disability-type">Type of Disability <span class="required">*</span></label>
                        <select id="disability-type" name="disability_type" required>
                            <option value="">Select Type of Disability</option>
                            <option value="visual">Visual Disability</option>
                            <option value="hearing">Hearing Disability</option>
                            <option value="mobility">Mobility Disability</option>
                            <option value="cognitive">Cognitive Disability</option>
                            <option value="psychosocial">Psychosocial Disability</option>
                            <option value="speech">Speech Disability</option>
                            <option value="chronic_illness">Chronic Illness</option>
                            <option value="multiple">Multiple Disabilities</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-field full-width">
                        <label for="proof-of-pwd">Proof of PWD <span class="required">*</span></label>
                        <input type="file" id="proof-of-pwd" name="proof_of_pwd" accept=".pdf,.jpg,.jpeg,.png" required>
                        <p class="form-hint">Upload a clear copy of your PWD certification (PDF, JPG, PNG formats accepted)</p>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-field full-width">
                        <label for="valid-id">Valid ID <span class="required">*</span></label>
                        <input type="file" id="valid-id" name="valid_id" accept=".pdf,.jpg,.jpeg,.png" required>
                        <p class="form-hint">Upload a clear copy of any government-issued ID (PDF, JPG, PNG formats accepted)</p>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="form-row">
                    <div class="form-field full-width">
                        <div class="consent-checkbox">
                            <input type="checkbox" id="consent" name="consent" required>
                            <label for="consent">I consent to the collection and processing of my personal data in accordance with the Data Privacy Act. I understand that this information will be used solely for the purpose of registration and job matching services.</label>
                        </div>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="reset" class="btn-secondary">Reset Form</button>
                    <button type="submit" class="btn-secondary">Submit Registration</button>
                    <button type="button" class="btn-secondary" onclick="window.location.href='../views/view_status.php'">View Status</button>

                </div>
            </div>
        </form>
        
        <div class="registration-info">
            <h3>Registration Process</h3>
            <ol>
                <li>Fill out the registration form completely.</li>
                <li>Upload the required documents (PWD certification and valid ID).</li>
                <li>Submit your application.</li>
                <li>Your application will be reviewed by our team.</li>
                <li>Once approved, you'll receive your PWD ID and can start accessing our job matching services.</li>
            </ol>
            <p>For assistance, please contact our support team at <a href="mailto:support@disabilitytoability.com">support@disabilitytoability.com</a> or call (02) 8123-4567.</p>
        </div>
    </div>


     <!-- Enhanced Footer Section -->
     <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>DisabilityToAbility</h3>
                    <p>Creating equal employment opportunities for all.</p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#home" class="section-link" data-section="home">Home</a></li>
                        <li><a href="#about" class="section-link" data-section="about">About Us</a></li>
                        <li><a href="#jobs" class="section-link" data-section="jobs">Job Listings</a></li>
                        <li><a href="../views/pwd_registration.php">Registration</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> 123 Employment Ave., Manila</li>
                        <li><i class="fas fa-phone"></i> (02) 8123-4567</li>
                        <li><i class="fas fa-envelope"></i> <a href="mailto:info@pwdjobportal.com">info@pwdjobportal.com</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 DisabilityToAbility. All rights reserved.</p>
                <div class="footer-links">
                    <a href="#">Terms of Service</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Accessibility Statement</a>
                </div>
            </div>
        </div>
    </footer>
<!-- Accessibility Toggle Button -->
<button class="accessibility-toggle" id="accessibility-toggle">
        <i class="fas fa-universal-access"></i>
    </button>
    <div class="accessibility-controls" id="accessibility-controls">
        <h5><i class="fas fa-universal-access"></i> Accessibility</h5>
        <div class="controls-section">
            <div class="font-size-controls">
                <button id="decrease-font-panel" title="Decrease Font Size"><i class="fas fa-minus"></i> A</button>
                <span id="font-size-value-panel">100%</span>
                <button id="increase-font-panel" title="Increase Font Size">A <i class="fas fa-plus"></i></button>
            </div>
        </div>
        <div class="controls-section">
            <div class="brightness-mode">
                <button id="normal-mode-panel" class="toggle-btn active">Normal</button>
                <button id="dark-mode-panel" class="toggle-btn">Dark</button>
                <button id="high-contrast-panel" class="toggle-btn">High Contrast</button>
            </div>
        </div>
        <button id="tts-toggle-panel">Enable TTS on Hover</button>
        <button id="reset-all-panel">Reset All</button>
    </div>
</body>
<script src="../scripts/landing_page.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
    // Apply saved font size
    const savedFontSize = localStorage.getItem('fontSize');
    if (savedFontSize) {
        document.documentElement.style.fontSize = savedFontSize + '%';
    }

    // Apply saved theme
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-mode');
    } else if (savedTheme === 'high-contrast') {
        document.body.classList.add('high-contrast');
    }

    // Apply TTS setting
    const ttsEnabled = localStorage.getItem('ttsEnabled');
    if (ttsEnabled === 'true') {
        document.getElementById('tts-toggle-panel').textContent = 'Disable TTS on Hover';
    } else {
        document.getElementById('tts-toggle-panel').textContent = 'Enable TTS on Hover';
    }
});
document.addEventListener('DOMContentLoaded', () => {

// Save font size preference
function saveFontSize(fontSize) {
    localStorage.setItem('fontSize', fontSize);
}

// Save theme preference (Normal, Dark, High Contrast)
function saveTheme(theme) {
    localStorage.setItem('theme', theme);
}

// Save TTS preference (Enabled or Disabled)
function saveTTS(state) {
    localStorage.setItem('ttsEnabled', state);
}

// Font Size Change
document.getElementById('increase-font-panel').addEventListener('click', function () {
    let fontSize = parseInt(localStorage.getItem('fontSize') || '100') + 10;
    if (fontSize <= 150) {
        document.documentElement.style.fontSize = fontSize + '%';
        saveFontSize(fontSize);
    }
});

document.getElementById('decrease-font-panel').addEventListener('click', function () {
    let fontSize = parseInt(localStorage.getItem('fontSize') || '100') - 10;
    if (fontSize >= 70) {
        document.documentElement.style.fontSize = fontSize + '%';
        saveFontSize(fontSize);
    }
});

// Theme Change
document.getElementById('normal-mode-panel').addEventListener('click', function () {
    document.body.classList.remove('dark-mode', 'high-contrast');
    saveTheme('normal');
});

document.getElementById('dark-mode-panel').addEventListener('click', function () {
    document.body.classList.add('dark-mode');
    saveTheme('dark');
});

document.getElementById('high-contrast-panel').addEventListener('click', function () {
    document.body.classList.add('high-contrast');
    saveTheme('high-contrast');
});

// TTS Toggle
document.getElementById('tts-toggle-panel').addEventListener('click', function () {
    let ttsEnabled = localStorage.getItem('ttsEnabled') === 'true' ? 'false' : 'true';
    localStorage.setItem('ttsEnabled', ttsEnabled);
    this.textContent = ttsEnabled === 'true' ? 'Disable TTS on Hover' : 'Enable TTS on Hover';
});
});

</script>
</html>