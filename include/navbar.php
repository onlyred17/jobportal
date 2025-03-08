<?php

// Check if the employer is logged in
if (!isset($_SESSION['employer_id'])) {
    header('Location: ../employer_login.php'); // Redirect to login if not logged in
    exit;
}

// Fetch employer details from the session or database
$firstName = $_SESSION['first_name'] ?? 'Employer'; // Default to "Employer" if first name is not set
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
            <!-- Dark Mode Toggle Button -->
            <div class="theme-toggle" onclick="toggleDarkMode()">
                <i class="fas fa-moon"></i> <!-- Moon icon for dark mode -->
            </div>

            <!-- Profile Section -->
            <div class="profile">
                <img src="<?php echo $profilePicture; ?>" alt="Profile Picture" class="profile-pic">
                <span class="profile-name"><?php echo $employerName; ?></span>
            </div>
        </div>
    </div>

    <!-- Include Dark Mode Script -->
    <script src="../scripts/dark_mode.js"></script>
</body>
</html>