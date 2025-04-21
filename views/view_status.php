<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check PWD Application Status</title>
 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="../css/landing_page.css">
    <style>
      /* Centering the form */
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 80vh;
}

.form-box {
    background: #ffffff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

/* Form Inputs */
.form-label {
    font-weight: 600;
    color: #333;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* Button Styling */
.btn-secondary {
 margin-top: 20px !important;
}

    </style>
</head>
<body id="body-element">
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


<div class="container">
    <div class="form-box">
        <h2 class="text-center mb-4" id="status-title">Check PWD Application Status</h2>
        
        <form action="view_status.php" method="POST">
            <div class="mb-3">
                <label for="application_id" class="form-label" id="application-id-label">Enter Application ID</label>
                <input type="text" name="application_id" class="form-control" id="application_id" required>
            </div>
            
            <button type="submit" class="btn btn-secondary" id="check-status-btn">Check Status</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $application_id = $_POST['application_id'];

            try {
                $conn = new PDO("mysql:host=localhost;dbname=job_portal", "root", "");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("SELECT * FROM pwd_registration WHERE application_id = ?");
                $stmt->execute([$application_id]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    echo "<div class='mt-3 alert alert-info'><span id='status-result'>Your Application Status: " . $user['status'] . "</span></div>";
                } else {
                    echo "<div class='mt-3 alert alert-danger'><span id='status-not-found'>Application ID not found.</span></div>";
                }

            } catch (PDOException $e) {
                echo "<div class='mt-3 alert alert-danger'><span id='status-error'>Error: " . $e->getMessage() . "</span></div>";
            }
        }
        ?>
    </div>
</div>
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
<script src="../scripts/landing_page.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // TTS Toggle
    document.getElementById('tts-toggle-panel').addEventListener('click', function () {
        let ttsEnabled = localStorage.getItem('ttsEnabled') === 'true' ? 'false' : 'true';
        localStorage.setItem('ttsEnabled', ttsEnabled);
        this.textContent = ttsEnabled === 'true' ? 'Disable TTS on Hover' : 'Enable TTS on Hover';
    });

    // Language Toggle Functionality
    // Get language buttons
    const englishButton = document.getElementById('english-mode');
    const tagalogButton = document.getElementById('tagalog-mode');
    
    // Language translations for the view status page
    const translations = {
        english: {
            // Header/Navigation
            home: "Home",
            aboutUs: "About Us",
            jobWall: "Job Wall",
            pwdRegistration: "PWD Registration",
            
            // Status Check Page
            statusTitle: "Check PWD Application Status",
            applicationIdLabel: "Enter Application ID",
            checkStatusBtn: "Check Status",
            statusResult: "Your Application Status: ",
            statusNotFound: "Application ID not found.",
            statusError: "Error: ",
            
            // Accessibility Panel
            accessibility: "Accessibility",
            normalMode: "Normal",
            darkMode: "Dark",
            highContrastMode: "High Contrast",
            language: "Language",
            enableTTS: "Enable TTS on Hover",
            disableTTS: "Disable TTS on Hover",
            resetAll: "Reset All",
            
            // Footer
            footerTagline: "Creating equal employment opportunities for all.",
            quickLinks: "Quick Links",
            contactUs: "Contact Us",
            allRightsReserved: "All rights reserved.",
            termsOfService: "Terms of Service",
            privacyPolicy: "Privacy Policy",
            accessibilityStatement: "Accessibility Statement"
        },
        tagalog: {
            // Header/Navigation
            home: "Home",
            aboutUs: "Tungkol sa Amin",
            jobWall: "Job Wall",
            pwdRegistration: "Rehistro ng PWD",
            
            // Status Check Page
            statusTitle: "Tingnan ang Status ng Aplikasyon ng PWD",
            applicationIdLabel: "Ilagay ang Application ID",
            checkStatusBtn: "Tingnan ang Status",
            statusResult: "Status ng Iyong Aplikasyon: ",
            statusNotFound: "Hindi nahanap ang Application ID.",
            statusError: "May Error: ",
            
            // Accessibility Panel
            accessibility: "Accessibility",
            normalMode: "Normal",
            darkMode: "Madilim",
            highContrastMode: "Mataas na Kontrast",
            language: "Wika",
            enableTTS: "Paganahin ang TTS sa Hover",
            disableTTS: "Huwag Paganahin ang TTS sa Hover",
            resetAll: "I-reset Lahat",
            
            // Footer
            footerTagline: "Lumilikha ng pantay na oportunidad sa trabaho para sa lahat.",
            quickLinks: "Madaliang mga Link",
            contactUs: "Makipag-ugnay sa Amin",
            allRightsReserved: "Lahat ng karapatan ay nakalaan.",
            termsOfService: "Mga Tuntunin ng Serbisyo",
            privacyPolicy: "Patakaran sa Privacy",
            accessibilityStatement: "Pahayag sa Accessibility"
        }
    };
    
    // Current language (default to stored language or English)
    let currentLanguage = localStorage.getItem('selectedLanguage') || 'english';
    
    // Function to update text based on current language
    function updateLanguage(language) {
        // Store the selected language in localStorage to maintain across pages
        localStorage.setItem('selectedLanguage', language);
        currentLanguage = language;
        
        // Update navigation text
        document.querySelectorAll('nav a[href="../views/pwd_landing_page.php#home"]').forEach(el => el.textContent = translations[language].home);
        document.querySelectorAll('nav a[href="../views/pwd_landing_page.php#about"]').forEach(el => el.textContent = translations[language].aboutUs);
        document.querySelectorAll('nav a[href="../views/pwd_landing_page.php#jobs"]').forEach(el => el.textContent = translations[language].jobWall);
        document.querySelectorAll('nav a[href="../views/pwd_registration.php"]').forEach(el => el.textContent = translations[language].pwdRegistration);
        
        // Update status check page elements
        document.getElementById('status-title').textContent = translations[language].statusTitle;
        document.getElementById('application-id-label').textContent = translations[language].applicationIdLabel;
        document.getElementById('check-status-btn').textContent = translations[language].checkStatusBtn;
        
        // Update any status result messages (if present)
        const statusResult = document.getElementById('status-result');
        if (statusResult) {
            const currentStatus = statusResult.textContent.split(': ')[1];
            statusResult.textContent = translations[language].statusResult + currentStatus;
        }
        
        const statusNotFound = document.getElementById('status-not-found');
        if (statusNotFound) {
            statusNotFound.textContent = translations[language].statusNotFound;
        }
        
        const statusError = document.getElementById('status-error');
        if (statusError) {
            const errorMsg = statusError.textContent.split(': ')[1];
            statusError.textContent = translations[language].statusError + errorMsg;
        }
        
        // Update accessibility panel
        document.querySelector('.accessibility-controls h5').textContent = translations[language].accessibility;
        document.querySelector('#normal-mode-panel').textContent = translations[language].normalMode;
        document.querySelector('#dark-mode-panel').textContent = translations[language].darkMode;
        document.querySelector('#high-contrast-panel').textContent = translations[language].highContrastMode;
        document.querySelector('.language-selection h6').textContent = translations[language].language;
        
        const ttsButton = document.querySelector('#tts-toggle-panel');
        if (ttsButton) {
            if (localStorage.getItem('ttsEnabled') === 'true') {
                ttsButton.textContent = translations[language].disableTTS;
            } else {
                ttsButton.textContent = translations[language].enableTTS;
            }
        }
        
        document.querySelector('#reset-all-panel').textContent = translations[language].resetAll;
        
        // Update footer text
        document.querySelector('.footer-section p').textContent = translations[language].footerTagline;
        document.querySelectorAll('.footer-section h3')[1].textContent = translations[language].quickLinks;
        document.querySelectorAll('.footer-section h3')[2].textContent = translations[language].contactUs;
        
        const footerLinks = document.querySelectorAll('.footer-section ul li a');
        footerLinks[0].textContent = translations[language].home;
        footerLinks[1].textContent = translations[language].aboutUs;
        footerLinks[2].textContent = translations[language].jobWall;
        footerLinks[3].textContent = translations[language].pwdRegistration;
        
        const copyrightText = document.querySelector('.footer-bottom p').textContent;
        const yearMatch = copyrightText.match(/\d{4}/);
        if (yearMatch) {
            const year = yearMatch[0];
            document.querySelector('.footer-bottom p').textContent = `© ${year} DisabilityToAbility. ${translations[language].allRightsReserved}`;
        }
        
        const footerBottomLinks = document.querySelectorAll('.footer-links a');
        footerBottomLinks[0].textContent = translations[language].termsOfService;
        footerBottomLinks[1].textContent = translations[language].privacyPolicy;
        footerBottomLinks[2].textContent = translations[language].accessibilityStatement;
    }
    
    // Function to set active language button
    function setActiveLanguageButton(button) {
        document.querySelectorAll('.language-selection .toggle-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        button.classList.add('active');
    }
    
    // Add event listeners to language buttons
    englishButton.addEventListener('click', function() {
        updateLanguage('english');
        setActiveLanguageButton(this);
    });
    
    tagalogButton.addEventListener('click', function() {
        updateLanguage('tagalog');
        setActiveLanguageButton(this);
    });
    
    // Initialize the page with the stored or default language
    const initialLanguage = localStorage.getItem('selectedLanguage') || 'english';
    updateLanguage(initialLanguage);
    
    // Set the correct active button based on stored language
    if (initialLanguage === 'english') {
        setActiveLanguageButton(englishButton);
    } else {
        setActiveLanguageButton(tagalogButton);
    }
});
</script>
</body>
</html>