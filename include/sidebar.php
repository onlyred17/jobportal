<?php
session_start();

// Redirect if the user is not logged in
if (!isset($_SESSION['employer_id'])) {
    header('Location: ../employer_login.php');
    exit;
}

// Set default values if session variables are not set
$profilePic = isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : 'default_profile.jpg';
$firstName = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : 'First Name';
$lastName = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : 'Last Name';
?>

<div class="sidebar">
    <!-- Sidebar Header with Profile Picture and Name -->
    <div class="sidebar-header">
        <div class="profile-info">
            <!-- Use a CSS class to make the image smaller -->
            <img src="../images/<?php echo $profilePic; ?>" alt="Profile Picture" class="profile-pic">
            <div class="profile-details">
                <span class="profile-name"><?php echo $firstName . ' ' . $lastName; ?></span>
                <span class="profile-role">Employer</span>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <li><a href="../views/view_employer_dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="../views/view_job_posting.php"><i class="fas fa-briefcase"></i> Job Posting</a></li>
        <li><a href="#edit-profile"><i class="fas fa-user-edit"></i> Edit Profile</a></li>
        <li><a href="#settings"><i class="fas fa-cog"></i> Settings</a></li>
        <li><a href="../controllers/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</div>