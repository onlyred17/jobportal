<?php
include '../controllers/staff_edit_profile.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - PWD Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/navbar.css" rel="stylesheet">
    <link href="../css/sidebar.css" rel="stylesheet">
    <link href="../css/dark_mode.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #38b000;
            --danger-color: #d90429;
            --card-bg: #ffffff;
            --text-color: #333333;
            --border-radius: 16px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* Main Content */
.main-content {
    margin-left: 280px;
    margin-top: 40px;
    padding: 2rem;
    transition: margin-left 0.3s;
    min-height: 100vh;
}
    
        
        .profile-container {
            max-width: 800px;
            width: 100%;
            padding: 20px;
        }
        
        .profile-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .profile-header {
            position: relative;
            height: 100px;
            background: linear-gradient(to right, #4361ee, #3a0ca3);
            display: flex;
            justify-content: center;
        }
        
        .profile-pic-container {
    position: relative;
}

.profile-pic1 {
    width: 120px !important; /* Increased from 150px */
    height: 120px !important; /* Increased from 150px */
    border-radius: 50%;
    object-fit: cover;
    border: 6px solid white;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}
        
        .change-pic-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .change-pic-btn:hover {
            background: var(--secondary-color);
            transform: scale(1.1);
        }
        
        .profile-body {
            padding: 20px 30px 30px;
            text-align: center;
        }
        
        .profile-name {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .profile-contact {
            color: #666;
            margin-bottom: 20px;
        }
        
        .btn-modern {
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .btn-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.15);
        }
        
        .btn-modern.btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-modern.btn-primary:hover {
            background: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-modern.btn-success {
            background: var(--success-color);
            border-color: var(--success-color);
        }
        
        .btn-modern.btn-danger {
            background: var(--danger-color);
            border-color: var(--danger-color);
        }
        
        .form-modern .form-control {
            border-radius: 8px;
            padding: 12px 20px;
            border: 1px solid #ddd;
            box-shadow: none;
            transition: all 0.3s ease;
        }
        
        .form-modern .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }
        
        .form-modern label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #555;
        }
        
        .hidden {
            display: none;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        .animate-fade {
            animation: fadeIn 0.5s ease forwards;
        }
        
        .animate-slide {
            animation: slideUp 0.5s ease forwards;
        }
        
        /* Modal styles */
        .modal-content {
            border-radius: 16px;
            border: none;
        }
        
        .modal-header {
            background: linear-gradient(to right, #4361ee, #3a0ca3);
            color: white;
            border-radius: 16px 16px 0 0;
            border-bottom: none;
        }
        
        .modal-body {
            padding: 30px;
        }  
  </style>
</head>
<body>
    <?php include '../include/sidebar.php'; ?>
    <?php include '../include/navbar.php'; ?>

    <div class="main-content d-flex justify-content-center">
        <div class="profile-container">
            <div class="profile-card">
                <!-- Profile Display (Hidden) -->
                <div id="profileDisplay" class="hidden">
                    <!-- Your existing profile display content -->
                </div>

                <!-- Edit Profile Form (Visible) -->
                <div id="editProfileFormContainer">
                    <div class="profile-header"></div>
                    <div class="profile-body">
                        <form id="editProfileForm" method="POST" action="../controllers/staff_edit_profile.php" enctype="multipart/form-data" class="form-modern animate-slide">
                            <h3 class="mb-4">Edit Your Profile</h3>

                            <!-- Profile Picture Section -->
                            <div class="mb-4 text-center">
                                <div class="profile-pic-container">
                                    <img src="<?php echo !empty($staff['profile_pic']) ? htmlspecialchars($staff['profile_pic']) : '../images/default_profile.png'; ?>" 
                                         alt="Profile Picture" 
                                         class="profile-pic1" 
                                         id="profilePicPreview">
                                    <div class="change-pic-btn" onclick="document.getElementById('profilePicInput').click()">
                                        <i class="fas fa-camera"></i>
                                    </div>
                                </div>
                                <input type="file" id="profilePicInput" name="profilePic" accept="image/*" class="form-control d-none">
                                <small class="text-muted">Click the camera icon to change your profile picture.</small>
                            </div>

                            <!-- Edit Profile Fields -->
                            <div class="mb-4">
                                <label for="editFirstName">First Name</label>
                                <input type="text" id="editFirstName" name="firstName" class="form-control" value="<?php echo htmlspecialchars($staff['first_name']); ?>" required>
                            </div>

                            <div class="mb-4">
                                <label for="editLastName">Last Name</label>
                                <input type="text" id="editLastName" name="lastName" class="form-control" value="<?php echo htmlspecialchars($staff['last_name']); ?>" required>
                            </div>

                            <div class="mb-4">
                                <label for="editContactNumber">Contact Number</label>
                                <input type="tel" id="editContactNumber" name="contactNumber" class="form-control" value="<?php echo htmlspecialchars($staff['contact_number']); ?>" required>
                            </div>

                            <!-- Form Buttons -->
                            <div class="d-flex justify-content-center gap-3 mt-4">
                                <button type="submit" class="btn btn-modern btn-success">
                                    <i class="fas fa-save me-2"></i>Save Changes
                                </button>
                                <button type="button" class="btn btn-modern btn-danger" id="cancelEdit">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Image Preview Functionality
        document.getElementById('profilePicInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                const preview = document.getElementById('profilePicPreview');
                
                reader.onload = function(event) {
                    preview.src = event.target.result;
                }
                
                reader.readAsDataURL(file);
            }
        });

        // Cancel Button Functionality
        document.getElementById('cancelEdit').addEventListener('click', function() {
            // Redirect or hide the edit form as needed
            window.location.href = 'profile.php'; // Example: Redirect back to the profile page
        });
    </script>
</body>
</html>