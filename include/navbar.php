<?php
// Check if the user is logged in
if (!isset($_SESSION['staff_id'])) {
    header('Location: ../views/view_staff_login.php'); // Redirect to login if not logged in
    exit;
}

// Fetch employer details from the session or database
$firstName = $_SESSION['first_name'] ?? 'Staff'; // Default to "Employer" if first name is not set
$lastName = $_SESSION['last_name'] ?? ''; // Default to empty if last name is not set
$profilePicture = $_SESSION['profile_pic'] ?? '../images/default-profile.jpg'; // Default profile picture

// Concatenate first name and last name
$employerName = trim("$firstName $lastName"); // Combine first and last name with a space
include '../notification/fetch_jobs.php';

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
            <div class="profile">
                <img src="<?php echo $profilePicture; ?>" alt="Profile Picture" class="profile-pic">
                <span class="profile-name"><?php echo $employerName; ?></span>
            </div>
            <div class="notifications">
                <button class="notification-btn" id="notificationBtn">
                    <i class="fas fa-bell"></i>
                    <span class="badge" id="notificationBadge"><?php echo $newJobsCount; ?></span>
                </button>
                <div class="notification-dropdown" id="notificationDropdown">
                    <?php if ($newJobsCount > 0): ?>
                        <?php foreach ($newJobs as $job): ?>
                            <div class="notification-item">
                                <strong><?php echo htmlspecialchars($job['title']); ?></strong><br>
                                <span><?php echo htmlspecialchars($job['description']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="notification-item">
                            No new job postings.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
document.addEventListener("DOMContentLoaded", function () {
    var badge = document.getElementById("notificationBadge");
    var notificationBtn = document.getElementById("notificationBtn");

    // Fetch the new job count from PHP
    var newJobsCount = <?php echo $newJobsCount; ?>;

    // Check if notification state is saved in sessionStorage
    var savedState = sessionStorage.getItem("notificationState");

    // If clicked previously, hide the badge
    if (savedState === "clicked") {
        badge.style.display = "none";
    } else {
        // Show the badge if new jobs exist
        if (newJobsCount > 0) {
            badge.style.display = "block";
            badge.textContent = newJobsCount;
        } else {
            badge.style.display = "none";
        }
    }

    // Handle clicking the notification button (hide badge)
    notificationBtn.addEventListener("click", function () {
        sessionStorage.setItem("notificationState", "clicked");
        badge.style.display = "none";
    });

    // Handle posting a new job
    document.getElementById("postJobForm").addEventListener("submit", function (event) {
        event.preventDefault();  // Prevent form submission

        var formData = new FormData(this);

        fetch("post_job.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                // Update the job count in the notification badge
                newJobsCount = data.newJobsCount;  // Update with new count from backend
                badge.textContent = newJobsCount;
                badge.style.display = "block";  // Show the badge with updated count
                alert(data.message);  // Show success message
            } else {
                alert(data.message);  // Show error message if any
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
    });
});

    </script>

    <!-- Include Dark Mode Script -->
    <script src="../scripts/dark_mode.js"></script>
</body>
</html>
