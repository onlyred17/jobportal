<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PWD ID Registration</title>
</head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="../css/registration.css">
<style>

.registration-container {
  max-width: 600px; /* Reduce the max-width for a narrower container */
  margin: 0 auto;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  padding: 30px; /* Reduce padding to make the container more compact */
}

.registration-intro {
  margin-bottom: 15px; /* Reduce space below the intro text */
  font-size: 14px; /* Slightly smaller font size */
  line-height: 1.4; /* Adjust line height for better readability */
  color: #555;
}

.form-group {
  margin-bottom: 20px; /* Reduce space between form groups */
}

.form-group h3 {
  font-size: 16px; /* Smaller heading size */
  margin-bottom: 10px; /* Reduce space below headings */
}

.form-row {
  margin-bottom: 10px; /* Reduce space between form rows */
}

.form-field {
  margin-bottom: 10px; /* Reduce space between form fields */
}

.form-field label {
  font-size: 14px; /* Smaller label font size */
}

.form-field input,
.form-field select,
.form-field textarea {
  padding: 8px; /* Reduce padding inside inputs and textareas */
  font-size: 14px; /* Smaller font size for inputs */
  width: 100%; /* Ensure inputs take full width */
}

.form-field textarea {
  height: 80px; /* Reduce height of textarea */
}

.consent-checkbox{
    display: grid;
  grid-template-columns: auto 1fr; /* checkbox + label */
  column-gap: 10px;
  align-items: start;
  max-width: 100%;
}

.consent-checkbox input{
    height: 30px;
    width: 30px;
    border: 2px solid #000; /* border color and thickness */


}
.consent-checkbox label{
    font-size: 15px;
    padding-right: 10px;
    word-break: break-word;
}

.form-actions {
  display: flex;
  gap: 10px;
  margin-top: 15px;
}


.form-actions button {
  padding: 8px 15px; /* Smaller button padding */
  font-size: 14px; /* Smaller button text */
}

.registration-info {
  margin-top: 20px; /* Reduce space above registration info */
  font-size: 14px; /* Smaller font size for info text */
}

.registration-info h3 {
  font-size: 16px; /* Smaller heading size */
  margin-bottom: 10px; /* Reduce space below heading */
}

.registration-info ol {
  padding-left: 20px; /* Adjust list padding */
}

.registration-info ol li {
  margin-bottom: 5px; /* Reduce space between list items */
}

.registration-info p {
  margin-top: 10px; /* Reduce space above paragraph */
}
</style>
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
    <input type="tel" id="contact-number" name="contact_number" placeholder="Enter your phone number" maxlength="13" required>
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
        <label for="valid-id-type">Valid ID Type <span class="required">*</span></label>
        <select id="valid-id-type" name="valid_id_type" required>
            <option value="" disabled selected>Select a Valid ID</option>
            <option value="SSS">SSS (Social Security System)</option>
            <option value="Barangay">Barangay ID</option>
            <option value="Driver-License">Driver's License</option>
            <option value="Passport">Passport</option>
            <option value="Voter-ID">Voter's ID</option>
            <option value="PhilHealth">PhilHealth ID</option>
            <option value="TIN">TIN (Taxpayer Identification Number)</option>
            <option value="Senior-Citizen">Senior Citizen ID</option>
            <option value="Postal">Postal ID</option>
            <option value="UMID">UMID (Unified Multi-purpose ID)</option>
        </select>
        <p class="form-hint">Please select the type of valid government-issued ID you will upload.</p>
    </div>
</div>

<div class="form-row">
    <div class="form-field full-width">
        <label for="valid-id-front">Valid ID (Front) <span class="required">*</span></label>
        <input type="file" id="valid-id-front" name="valid_id1" accept=".pdf,.jpg,.jpeg,.png" required>
        <p class="form-hint">Upload a clear copy of the front side of your selected government-issued ID (PDF, JPG, PNG formats accepted).</p>
    </div>
</div>

<div class="form-row">
    <div class="form-field full-width">
        <label for="valid-id-back">Valid ID (Back) <span class="required">*</span></label>
        <input type="file" id="valid-id-back" name="valid_id2" accept=".pdf,.jpg,.jpeg,.png" required>
        <p class="form-hint">Upload a clear copy of the back side of your selected government-issued ID (PDF, JPG, PNG formats accepted).</p>
    </div>
</div>


            </div>
            
            <div class="form-group">
    <div class="form-row">
        <div class="form-field full-width">
        <div class="consent-checkbox">
  <input type="checkbox" id="checkbox" class="check" />
  <label for="checkbox">
    I consent to the collection and processing of my personal <br> data in accordance with the Data Privacy Act.
  </label>
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
            <button id="high-contrast-panel" class="toggle-btn hidden">High Contrast</button>
        </div>
    </div>
    <style>
        .hidden{
            display: none;
        }
    </style>
    <div class="controls-section">
        <div class="language-selection">
            <h6><i class="fas fa-language"></i> Language</h6>
            <button id="english-mode" class="toggle-btn active">English</button>
            <button id="tagalog-mode" class="toggle-btn">Tagalog</button>
        </div>
    </div>
    <button id="tts-toggle-panel">Enable TTS on Hover</button>
    <button id="reset-all-panel">Reset All</button>
</div>
</body>
<script src="../scripts/registration.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {

// TTS Toggle
document.getElementById('tts-toggle-panel').addEventListener('click', function () {
    let ttsEnabled = localStorage.getItem('ttsEnabled') === 'true' ? 'false' : 'true';
    localStorage.setItem('ttsEnabled', ttsEnabled);
    this.textContent = ttsEnabled === 'true' ? 'Disable TTS on Hover' : 'Enable TTS on Hover';
});
});
// Language Toggle Functionality
document.addEventListener('DOMContentLoaded', () => {
    // Get language buttons
    const englishButton = document.getElementById('english-mode');
    const tagalogButton = document.getElementById('tagalog-mode');
    
    // Language translations for the PWD registration page
    const translations = {
        english: {
             // Header/Navigation
            home: "Home",
            aboutUs: "About Us",
            jobWall: "Job Wall",
            pwdRegistration: "PWD Registration",
            // Accessibility Panel
            accessibilityTitle: 'Accessibility',
            normalMode: 'Normal',
            darkMode: 'Dark',
            highContrastMode: 'High Contrast',
            enableTTS: 'Enable TTS on Hover',
            disableTTS: 'Disable TTS on Hover',
            resetAll: 'Reset All',
            language: 'Language',
            
            // PWD Registration Form
            pwdRegistrationTitle: 'PWD ID Registration',
            pwdRegistrationIntro: 'Register your PWD ID to access personalized job recommendations and special features tailored for Persons with Disabilities.',
            fullName: 'Full Name',
            dateOfBirth: 'Date of Birth',
            contactNumber: 'Contact Number',
            emailAddress: 'Email Address',
            completeAddress: 'Complete Address',
            disabilityType: 'Type of Disability',
            proofOfPWD: 'Proof of PWD',
            idtype: 'Valid ID Type',
            validID1: 'Valid ID (Front)',
            validID2: 'Valid ID (Back)',
            consentText: 'I consent to the collection and processing of my personal data in accordance with the Data Privacy Act.',
            resetForm: 'Reset Form',
            submitRegistration: 'Submit Registration',
            viewStatus: 'View Status',
            registrationProcessTitle: 'Registration Process',
            registrationProcessSteps: [
                'Fill out the registration form completely.',
                'Upload the required documents (PWD certification and valid ID).',
                'Submit your application.',
                'Your application will be reviewed by our team.',
                'Once approved, you\'ll receive your PWD ID and can start accessing our job matching services.'
            ],
            supportContact: 'For assistance, please contact our support team at support@disabilitytoability.com or call (02) 8123-4567.'
        },
        tagalog: {
              // Header/Navigation
              home: "Home",
            aboutUs: "Tungkol sa Amin",
            jobWall: "Mga Trabaho",
            pwdRegistration: "Rehistro ng PWD",
            
            // Accessibility Panel
            accessibilityTitle: 'Accessibility',
            normalMode: 'Normal',
            darkMode: 'Madilim',
            highContrastMode: 'Mataas na Kontrast',
            enableTTS: 'Paganahin ang TTS sa Hover',
            disableTTS: 'Huwag Paganahin ang TTS sa Hover',
            resetAll: 'I-reset Lahat',
            language: 'Wika',
            
            // PWD Registration Form
            pwdRegistrationTitle: 'Rehistro ng PWD ID',
            pwdRegistrationIntro: 'Irehistro ang iyong PWD ID upang makakuha ng mga personalized na rekomendasyon sa trabaho at mga espesyal na tampok na inaalok para sa mga Persons with Disabilities.',
            fullName: 'Buong Pangalan',
            dateOfBirth: 'Petsa ng Kapanganakan',
            contactNumber: 'Numero ng Telepono',
            emailAddress: 'Email Address',
            completeAddress: 'Kumpletong Address',
            disabilityType: 'Uri ng Kapansanan',
            proofOfPWD: 'Patunay ng PWD',
            idtype: 'Uri ng ID',
            validID1: 'Balidong ID (Harap)',
            validID2: 'Balidong ID (Likod)',
            consentText: 'Ako ay sumasang-ayon sa koleksyon at pagproseso ng aking personal na data alinsunod sa Data Privacy Act.',
            resetForm: 'I-reset ang Form',
            submitRegistration: 'Isumite ang Rehistro',
            viewStatus: 'Tingnan ang Status',
            registrationProcessTitle: 'Proseso ng Rehistro',
            registrationProcessSteps: [
                'Punan ang registration form ng kumpleto.',
                'I-upload ang mga kinakailangang dokumento (PWD certification at valid ID).',
                'I-submit ang iyong aplikasyon.',
                'Susuriin ng aming koponan ang iyong aplikasyon.',
                'Kapag naaprubahan, matatanggap mo ang iyong PWD ID at makakagamit ng mga serbisyo ng job matching.'
            ],
            supportContact: 'Para sa tulong, mangyaring makipag-ugnay sa aming support team sa support@disabilitytoability.com o tumawag sa (02) 8123-4567.'
        }
    };
    
    // Current language (default to English)
    let currentLanguage = 'english';
    
    // Function to update text based on current language
    function updateLanguage(language) {
        localStorage.setItem('selectedLanguage', language);
        currentLanguage = language;

           // Update navigation text
        document.querySelectorAll('a[href="../views/pwd_landing_page.php#home"]').forEach(el => el.textContent = translations[language].home);
        document.querySelectorAll('a[href="../views/pwd_landing_page.php#about"]').forEach(el => el.textContent = translations[language].aboutUs);
        document.querySelectorAll('a[href="../views/pwd_landing_page.php#jobs"]').forEach(el => el.textContent = translations[language].jobWall);
        document.querySelectorAll('a[href="../views/pwd_registration.php"]').forEach(el => el.textContent = translations[language].pwdRegistration);
        // Update PWD registration form text
        document.querySelector('.registration-container h2').textContent = translations[language].pwdRegistrationTitle;
        document.querySelector('.registration-intro').textContent = translations[language].pwdRegistrationIntro;
        
        document.querySelectorAll('label[for="full-name"]').forEach(label => label.textContent = translations[language].fullName);
        document.querySelectorAll('label[for="birthdate"]').forEach(label => label.textContent = translations[language].dateOfBirth);
        document.querySelectorAll('label[for="contact-number"]').forEach(label => label.textContent = translations[language].contactNumber);
        document.querySelectorAll('label[for="email"]').forEach(label => label.textContent = translations[language].emailAddress);
        document.querySelectorAll('label[for="address"]').forEach(label => label.textContent = translations[language].completeAddress);
        
        document.querySelectorAll('label[for="disability-type"]').forEach(label => label.textContent = translations[language].disabilityType);
        document.querySelectorAll('label[for="proof-of-pwd"]').forEach(label => label.textContent = translations[language].proofOfPWD);        
        document.querySelectorAll('label[for="valid-id-type"]').forEach(label => label.textContent = translations[language].idtype);
        document.querySelectorAll('label[for="valid-id-front"]').forEach(label => label.textContent = translations[language].validID1);
        document.querySelectorAll('label[for="valid-id-back"]').forEach(label => label.textContent = translations[language].validID2);

        document.querySelector('.consent-checkbox label').textContent = translations[language].consentText;
        
        document.querySelector('.form-actions button[type="reset"]').textContent = translations[language].resetForm;
        document.querySelector('.form-actions button[type="submit"]').textContent = translations[language].submitRegistration;
        document.querySelector('.form-actions button[type="button"]').textContent = translations[language].viewStatus;
        
        document.querySelector('.registration-info h3').textContent = translations[language].registrationProcessTitle;
        
        const processList = document.querySelector('.registration-info ol');
        processList.innerHTML = '';
        translations[language].registrationProcessSteps.forEach(step => {
            const li = document.createElement('li');
            li.textContent = step;
            processList.appendChild(li);
        });
        
        document.querySelector('.registration-info p').textContent = translations[language].supportContact;
    }
        // Initialize the page with the stored or default language
    const initialLanguage = localStorage.getItem('selectedLanguage') || 'english';
    updateLanguage(initialLanguage);
    // Add event listeners to language buttons
    englishButton.addEventListener('click', function() {
        updateLanguage('english');
        setActiveLanguageButton(this);
    });
    
    tagalogButton.addEventListener('click', function() {
        updateLanguage('tagalog');
        setActiveLanguageButton(this);
    });
    
    // Function to set active language button
    function setActiveLanguageButton(button) {
        document.querySelectorAll('.language-selection .toggle-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        button.classList.add('active');
    }
    
    // Initialize the page with the default language (English)
    updateLanguage(currentLanguage);
});

</script>
</html>