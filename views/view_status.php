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
        <h2 class="text-center mb-4">Check PWD Application Status</h2>
        
        <form action="view_status.php" method="POST">
            <div class="mb-3">
                <label for="application_id" class="form-label">Enter Application ID</label>
                <input type="text" name="application_id" class="form-control" id="application_id" required>
            </div>
            
            <button type="submit" class="btn btn-secondary">Check Status</button>
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
                    echo "<div class='mt-3 alert alert-info'>Your Application Status: " . $user['status'] . "</div>";
                } else {
                    echo "<div class='mt-3 alert alert-danger'>Application ID not found.</div>";
                }

            } catch (PDOException $e) {
                echo "<div class='mt-3 alert alert-danger'>Error: " . $e->getMessage() . "</div>";
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

</body>
</html>
