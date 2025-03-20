<?php

// Fetch employer details from the session or database
$firstName = $_SESSION['first_name'] ?? '';
$lastName = $_SESSION['last_name'] ?? '';
$profilePicture = $_SESSION['profile_pic'] ?? '../images/default-profile.jpg';
$userType = $_SESSION['user_type'] ?? '';


// Concatenate first name and last name
$employerName = trim("$firstName $lastName");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/dark_mode.css">
    <style>
        /* Temporary CSS for debugging */
        .notification-bar {
            border: 2px solid red;
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>
</head>
<body>
<div class="navbar">
    <div class="navbar-left">
        <!-- Add any left-aligned content here -->
    </div>
    <div class="navbar-right">
        <!-- Notification Bar for Admin -->
        <?php if ($userType === 'admin'): ?>
            <div class="notification-bar">
                <i class="fas fa-bell"></i> <!-- Notification icon -->
                <span class="notification-count">3</span> <!-- Example notification count -->
            </div>
        <?php endif; ?>

        <!-- Profile Section -->
        <div class="profile-dropdown">
            <div class="profile" id="profileMenu">
                <img src="<?php echo $profilePicture; ?>" alt="Profile Picture" class="profile-pic">
                <span class="profile-name"><?php echo $employerName; ?></span>
            </div>

            <!-- Dropdown Menu -->
            <ul class="dropdown-menu" id="dropdownMenu">
                <li><a href="../views/view_change_password.php"><i class="fas fa-key"></i> Change Password</a></li>
                <li><a href="../controllers/logout_controllers.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const profileMenu = document.getElementById("profileMenu");
            const dropdownMenu = document.getElementById("dropdownMenu");

            profileMenu.addEventListener("click", function () {
                if (dropdownMenu.classList.contains("show")) {
                    dropdownMenu.classList.remove("show");
                } else {
                    dropdownMenu.classList.add("show");
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener("click", function (event) {
                if (!profileMenu.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.remove("show");
                }
            });
        });
    </script>

    <!-- Include Dark Mode Script -->
    <script src="../scripts/dark_mode.js"></script>
</body>
</html>