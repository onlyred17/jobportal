<?php
// Set default values if session variables are not set
$profilePic = isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : 'default_profile.jpg';
$firstName = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : 'First Name';
$lastName = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : 'Last Name';
?>
<div class="sidebar">
    <!-- Sidebar Header with Profile Picture and Name -->
    <div class="sidebar-header">
        <div class="profile-info">
            <img src="../images/<?php echo $profilePic; ?>" alt="Profile Picture" class="sidebar-profile-pic">
            <div class="profile-details">
                <span class="profile-name1"><?php echo $firstName . ' ' . $lastName; ?></span>
                <div class="profile-role">Staff</div> <!-- Add this line for the role -->
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <li><a href="../views/view_staff_dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="../views/view_staff_job_posting.php"><i class="fas fa-briefcase"></i> Job Posting</a></li>
        <li><a href="../views/view_staff_edit_profile.php"><i class="fas fa-user-edit"></i>Profile</a></li>

        <!-- Job Table Module -->
        <li class="module">
            <a href="#" onclick="toggleModule('job-table-menu')">
                <i class="fas fa-table"></i> Table
            </a>
            <ul class="sub-menu" id="job-table-menu">
                <li><a href="../views/view_staff_jobs_table.php"><i class="fas fa-list"></i> Job Table</a></li>
                <!-- You can add more sub-menu items if needed -->
                <li><a href="../views/view_staff_company_table.php"><i class="fas fa-list"></i> Company Table</a></li>

            </ul>
         
        </li>

        <!-- Settings Module -->
        <li class="module">
            <a href="#" onclick="toggleModule('settings-menu')">
                <i class="fas fa-cog"></i> Configuration Settings
            </a>
            <ul class="sub-menu" id="settings-menu">
                <li><a href="../views/view_staff_add_company.php"><i class="fas fa-plus"></i> Add Company</a></li>
            </ul>
        </li>

        <li><a href="../controllers/logout_controllers.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</div>

<!-- JavaScript for Smooth Expanding Modules -->
<script>
    function toggleModule(menuId) {
        var menu = document.getElementById(menuId);
        if (menu.classList.contains('active')) {
            menu.style.maxHeight = "0px";
            menu.classList.remove('active');
        } else {
            menu.style.maxHeight = menu.scrollHeight + "px";
            menu.classList.add('active');
        }
    }
</script>
