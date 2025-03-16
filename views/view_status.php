<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check PWD Application Status</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

        .btn-primary:hover {
            background: #357ABD; /* Primary button hover color */
        }

        .alert-info {
            background-color: #D4F6FF; /* Light blue for info alerts */
            color: #2E3A47; /* Info alert text color */
        }

        .alert-danger {
            background-color: #F8D7DA; /* Light red for error alerts */
            color: #2E3A47; /* Error alert text color */
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
        }
        /* Dark Mode Styling */
body.dark-mode .form-box {
    background: #2c2c2c; /* Dark background for form box */
    color: #f0f0f0; /* Light text color */
    border: 1px solid #4a4a4a; /* Border for the form */
}

body.dark-mode .form-control {
    background: #3a3a3a; /* Darker background for inputs */
    border: 1px solid #4a4a4a; /* Border color for inputs */
    color: #f0f0f0; /* Light text color for inputs */
}

body.dark-mode .alert-info {
    background-color: #4a90e2; /* Blue background for info alert */
    color: #fff; /* White text color */
}

body.dark-mode .alert-danger {
    background-color: #f8d7da; /* Light red for error alerts */
    color: #2e3a47; /* Dark text color for error alert */
}

/* High Contrast Mode Styling */
body.high-contrast .form-box {
    background: #000000; /* Black background for form box */
    color: #FFFFFF; /* White text color */
    border: 2px solid #FFFFFF; /* White border for the form */
}

body.high-contrast .form-control {
    background: #000000; /* Black background for inputs */
    border: 2px solid #FFFFFF; /* White border for inputs */
    color: #FFFFFF; /* White text color for inputs */
}

body.high-contrast .alert-info {
    background-color: #FFFF00; /* Yellow background for info alert */
    color: #000000; /* Black text color */
}

body.high-contrast .alert-danger {
    background-color: #FF0000; /* Red background for error alerts */
    color: #FFFFFF; /* White text color */
}
/* Enhanced Accessibility Controls Styles */
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

/* Toggle buttons styling */
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
    margin-right: 10px;
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
    border: 1px solid #4a4a4a;
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

body.dark-mode .font-size-controls button, 
body.dark-mode .brightness-controls button {
    background: #4A90E2;
}

body.dark-mode .font-size-controls button:hover, 
body.dark-mode .brightness-controls button:hover {
    background: #357ABD;
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

/* Make the panel responsive on smaller screens */
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

/* Ensure the accessibility panel itself is accessible in all modes */
body.dark-mode .btn-primary,
body.dark-mode .btn-custom {
    background: #4A90E2;
    color: white;
}

body.dark-mode .btn-primary:hover,
body.dark-mode .btn-custom:hover {
    background: #357ABD;
}

/* Fix for form elements in high contrast mode */
body.high-contrast .btn-primary {
    background: #000000;
    color: #FFFFFF;
    border: 2px solid #FFFFFF;
}

body.high-contrast .btn-primary:hover {
    background: #333333;
    color: #FFFFFF;
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
    <div class="form-box">
        <h2 class="text-center mb-4">Check PWD Application Status</h2>
        
        <form action="view_status.php" method="POST">
            <div class="mb-3">
                <label for="application_id" class="form-label">Enter Application ID</label>
                <input type="text" name="application_id" class="form-control" id="application_id" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Check Status</button>
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

<script>
    // Font size and mode control logic
    const bodyElement = document.getElementById('body-element');
    const fontSizeValue = document.getElementById('font-size-value');
    let currentFontSize = 100;
    
    // Increase font size
    document.getElementById('increase-font').addEventListener('click', () => {
        if (currentFontSize < 150) {
            currentFontSize += 10;
            bodyElement.style.fontSize = `${currentFontSize}%`;
            fontSizeValue.textContent = `${currentFontSize}%`;
        }
    });

    // Decrease font size
    document.getElementById('decrease-font').addEventListener('click', () => {
        if (currentFontSize > 60) {
            currentFontSize -= 10;
            bodyElement.style.fontSize = `${currentFontSize}%`;
            fontSizeValue.textContent = `${currentFontSize}%`;
        }
    });

    // Normal, Dark, High Contrast Mode
    document.getElementById('normal-mode').addEventListener('click', () => {
        bodyElement.classList.remove('dark-mode', 'high-contrast');
        document.getElementById('normal-mode').classList.add('active');
        document.getElementById('dark-mode').classList.remove('active');
        document.getElementById('high-contrast').classList.remove('active');
    });

    document.getElementById('dark-mode').addEventListener('click', () => {
        bodyElement.classList.add('dark-mode');
        bodyElement.classList.remove('high-contrast');
        document.getElementById('dark-mode').classList.add('active');
        document.getElementById('normal-mode').classList.remove('active');
        document.getElementById('high-contrast').classList.remove('active');
    });

    document.getElementById('high-contrast').addEventListener('click', () => {
        bodyElement.classList.add('high-contrast');
        bodyElement.classList.remove('dark-mode');
        document.getElementById('high-contrast').classList.add('active');
        document.getElementById('normal-mode').classList.remove('active');
        document.getElementById('dark-mode').classList.remove('active');
    });

    // Reset all settings
    document.getElementById('reset-all').addEventListener('click', () => {
        bodyElement.style.fontSize = '100%';
        fontSizeValue.textContent = '100%';
        currentFontSize = 100;
        bodyElement.classList.remove('dark-mode', 'high-contrast');
        document.getElementById('normal-mode').classList.add('active');
        document.getElementById('dark-mode').classList.remove('active');
        document.getElementById('high-contrast').classList.remove('active');
    });
</script>

</body>
</html>
