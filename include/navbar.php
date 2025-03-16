<?php

// Fetch employer details from the session or database
$firstName = $_SESSION['first_name'] ?? ''; // Default to "Employer" if first name is not set
$lastName = $_SESSION['last_name'] ?? ''; // Default to empty if last name is not set
$profilePicture = $_SESSION['profile_pic'] ?? '../images/default-profile.jpg'; // Default profile picture

// Concatenate first name and last name
$employerName = trim("$firstName $lastName"); // Combine first and last name with a space

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Posting - PWD Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/dark_mode.css">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-left">
            <!-- Add any left-aligned content here -->
        </div>
        <div class="navbar-right">
    <!-- Profile Section -->
    <div class="profile-dropdown">
        <div class="profile" id="profileMenu">
            <img src="<?php echo $profilePicture; ?>" alt="Profile Picture" class="profile-pic">
            <span class="profile-name"><?php echo $employerName; ?></span>
        </div>

        <!-- Dropdown Menu -->
        <ul class="dropdown-menu" id="dropdownMenu">
            <li><a href="../views/view_change_password.php"><i class="fas fa-key"></i> Change Password</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
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
