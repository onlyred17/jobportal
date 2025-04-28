<?php
include '../include/db_conn.php'; // Ensure this is the correct path to your database connection file

// Get the logged-in email
$loggedEmail = $_SESSION['email'];

// Query the admin table first
$sql = "SELECT 'admin' as usertype, first_name, last_name, profile_pic FROM admin WHERE email = :email";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":email", $loggedEmail, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    // If no record found in admin, check the staff table
    $sql = "SELECT 'staff' as usertype, first_name, last_name, profile_pic FROM staff WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $loggedEmail, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$user) {
    // If no record found in staff, check the super_admin table
    $sql = "SELECT 'super_admin' as usertype, first_name, last_name, profile_pic FROM super_admin WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $loggedEmail, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

// If user exists, set session variables
if ($user) {
    $_SESSION['usertype'] = $user['usertype'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['last_name'] = $user['last_name'];
    $_SESSION['profile_pic'] = $user['profile_pic'];
} else {
    // Redirect if user not found
    header("Location: ../views/login.php");
    exit();
}

// Assign session values
$profilePic = $_SESSION['profile_pic'] ?? 'default_profile.jpg';
$firstName = $_SESSION['first_name'] ?? 'First Name';
$lastName = $_SESSION['last_name'] ?? 'Last Name';
$userType = $_SESSION['usertype'] ?? 'staff'; // Default to 'staff'
?>

<div class="sidebar">
    <div class="sidebar-header">
        <div class="profile-info">
            <img src="../images/<?php echo $profilePic; ?>" alt="Profile Picture" class="sidebar-profile-pic">
            <div class="profile-details">
                <span class="profile-name1"><?php echo $firstName . ' ' . $lastName; ?></span>
            </div>
        </div>
    </div>

    <ul class="sidebar-menu">
        <?php if ($userType == 'staff'): ?>
            <li><a href="../views/view_staff_dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="module">
                <a href="#" onclick="toggleModule('job-table-menu')"><i class="fas fa-table"></i> Data Management</a>
                <ul class="sub-menu" id="job-table-menu">
                    <li><a href="../views/view_staff_jobs_table.php"><i class="fas fa-list"></i> Manage Job</a></li>
                    <li><a href="../views/view_staff_company_table.php"><i class="fas fa-list"></i> Manage Company</a></li>
                </ul>
            </li>
            <li><a href="../views/view_staff_edit_profile.php"><i class="fas fa-user-edit"></i> Profile</a></li>

        <?php elseif ($userType == 'super_admin'): ?>
            <li><a href="../views/view_super_admin_dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="module">
                <a href="#" onclick="toggleModule('staff-user-management-menu')"><i class="fas fa-users"></i> User Management</a>
                <ul class="sub-menu" id="staff-user-management-menu">
                    <li><a href="../views/view_super_admin_manage_staff.php"><i class="fas fa-user"></i> PESO Table</a></li>
                    <li><a href="../views/view_super_admin_manage_admin.php"><i class="fas fa-user-shield"></i> PDAO Table</a></li>
                </ul>
            </li>
            <li><a href="../views/view_super_admin_edit_profile.php"><i class="fas fa-user-edit"></i>Profile</a></li>
            <li class="module">
                <a href="#" onclick="toggleModule('settings-menu')"><i class="fas fa-cogs"></i> Configuration</a>
                <ul class="sub-menu" id="settings-menu">
                    <li><a href="../views/view_super_admin_backup_and_restore.php"><i class="fas fa-database"></i> Backup & Restore</a></li>
                    <li><a href="../views/view_super_admin_audit_logs.php"><i class="fas fa-history"></i> Audit Logs</a></li>
                </ul>
            </li>

        <?php elseif ($userType == 'admin'): ?>
            <li><a href="../views/view_admin_dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="module">
                <a href="#" onclick="toggleModule('manage-users-menu')"><i class="fas fa-users"></i> Manage Users</a>
                <ul class="sub-menu" id="manage-users-menu">
                    <li><a href="../views/view_admin_pwd_registration.php"><i class="fas fa-user-plus"></i> Manage Registration</a></li>
                    <li><a href="../views/view_admin_manage_pwd.php"><i class="fas fa-wheelchair"></i> Manage PWD</a></li>
                </ul>
            </li>
            <li><a href="../views/view_admin_edit_profile.php"><i class="fas fa-user-edit"></i> Profile</a></li>
            <li class="module">
                <a href="#" onclick="toggleModule('admin-settings-menu')"><i class="fas fa-cogs"></i> Configuration</a>
                <ul class="sub-menu" id="admin-settings-menu">
                    <li><a href="../views/view_admin_audit_logs.php"><i class="fas fa-history"></i> Audit Logs</a></li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>

    <!-- Sidebar Footer for Logout -->
    <div class="sidebar-footer">
     
        <a href="../controllers/logout_controllers.php" class="logout-link">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>


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
