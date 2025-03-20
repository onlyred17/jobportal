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
      


    </div>
    <div class="navbar-right">
        <!-- Profile Section -->  <!-- Notification Bar for Admin -->
        <?php if ($userType === 'admin'): ?>
    <div class="notification-container">
        <div class="notification-bar" id="notification-bar">
            <i class="fas fa-bell"></i>
            <span class="notification-count" id="notification-count"></span>
        </div>
        <ul class="notification-dropdown" id="notification-dropdown">
            <li class="dropdown-header">New Registrations</li>
            <div id="notification-list">
                <li class="dropdown-item">No new notifications</li>
            </div>
        </ul>
    </div>
<?php endif; ?>
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
    const notificationBar = document.getElementById("notification-bar");
    const notificationCount = document.getElementById("notification-count");
    const notificationDropdown = document.getElementById("notification-dropdown");
    const notificationList = document.getElementById("notification-list");

    const profileMenu = document.getElementById("profileMenu");
    const dropdownMenu = document.getElementById("dropdownMenu");

    function fetchNotifications() {
        fetch('../controllers/fetch_notifications.php')
            .then(response => response.json())
            .then(data => {
                // Update notification count (only unseen)
                if (data.count > 0) {
                    notificationCount.textContent = data.count;
                    notificationCount.style.display = "inline-block";
                    notificationCount.style.backgroundColor = "red"; // Add color
                    notificationCount.style.color = "white"; // Ensure contrast
                    notificationCount.style.padding = "4px 8px";
                    notificationCount.style.borderRadius = "50%";
                } else {
                    notificationCount.style.display = "none"; // Properly hide
                }

                // Populate dropdown with all notifications
                notificationList.innerHTML = data.notifications.map(notif => 
                    `<li class="dropdown-item ${notif.seen == 0 ? 'fw-bold unseen' : ''}">
                        <strong>${notif.full_name}</strong><br>
                        <small>${new Date(notif.created_at).toLocaleString()}</small>
                    </li>`
                ).join("");
            })
            .catch(error => console.error('Error fetching notifications:', error));
    }
    notificationBar.addEventListener("click", function (event) {
    event.stopPropagation();
    const isVisible = notificationDropdown.classList.contains("show");
    notificationDropdown.classList.toggle("show");

    if (!isVisible && notificationCount.style.display !== "none") {
        fetch('../controllers/mark_notifications_seen.php', { method: 'POST' })
            .then(response => response.json())
            .then(() => {
                notificationCount.textContent = "";
                notificationCount.style.display = "none"; // Hide count properly
                fetchNotifications();
            })
            .catch(error => console.error('Error marking notifications:', error));
    }
});


    profileMenu.addEventListener("click", function (event) {
        event.stopPropagation();
        dropdownMenu.classList.toggle("show");
    });

    document.addEventListener("click", function (event) {
        if (!notificationBar.contains(event.target) && !notificationDropdown.contains(event.target)) {
            notificationDropdown.classList.remove("show");
        }

        if (!profileMenu.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.remove("show");
        }
    });

    setInterval(fetchNotifications, 10000);
    fetchNotifications();
});

</script>


    <!-- Include Dark Mode Script -->
    <script src="../scripts/dark_mode.js"></script>
</body>
</html>