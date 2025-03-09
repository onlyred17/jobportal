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
    <link href="../css/staff_edit_profile.css" rel="stylesheet">
</head>
<body>
    <?php include '../include/sidebar.php'; ?>
    <?php include '../include/navbar.php'; ?>

    <div class="main-content d-flex justify-content-center">
        <div class="staff-profile-card">
            <!-- Profile Display -->
            <div id="profileDisplay">
                <div class="staff-profile-header">
                    <img src="<?php echo !empty($staff['profile_pic']) ? htmlspecialchars($staff['profile_pic']) : '../images/default_profile.png'; ?>" 
                         alt="Profile Picture" 
                         class="staff-profile-pic" 
                         id="profilePicPreview">
                </div>

                <div class="text-center">
                    <h4><?php echo htmlspecialchars($staff['first_name']) . " " . htmlspecialchars($staff['last_name']); ?></h4>
                    <p><i class="fas fa-phone"></i> <?php echo htmlspecialchars($staff['contact_number']); ?></p>
                </div>

                <div class="text-center mt-3">
                    <button id="editProfileBtn" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Profile
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#changeProfilePicModal">
                        <i class="fas fa-camera"></i> Change Profile Picture
                    </button>
                </div>
            </div>

            <!-- Edit Profile Form (Initially Hidden) -->
            <div id="editProfileFormContainer" class="hidden">
                <form id="editProfileForm" method="POST" action="../controllers/staff_edit_profile.php">
                    <h4 class="text-center">Edit Profile</h4>
                    
                    <div class="mb-3">
                        <label for="editFirstName">First Name</label>
                        <input type="text" id="editFirstName" name="firstName" class="form-control" value="<?php echo htmlspecialchars($staff['first_name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="editLastName">Last Name</label>
                        <input type="text" id="editLastName" name="lastName" class="form-control" value="<?php echo htmlspecialchars($staff['last_name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="editContactNumber">Contact Number</label>
                        <input type="tel" id="editContactNumber" name="contactNumber" class="form-control" value="<?php echo htmlspecialchars($staff['contact_number']); ?>" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <button type="button" class="btn btn-danger" id="cancelEdit">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Change Profile Picture Modal -->
    <div class="modal fade" id="changeProfilePicModal" tabindex="-1" aria-labelledby="changeProfilePicLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeProfilePicLabel">Change Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <form id="profilePicForm" method="POST" action="../controllers/staff_edit_profile.php" enctype="multipart/form-data">
                        <input type="file" id="profilePicInput" name="profilePic" accept="image/*" class="form-control mb-3" required>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('editProfileBtn').addEventListener('click', function() {
            document.getElementById('profileDisplay').style.display = 'none';
            document.getElementById('editProfileFormContainer').style.display = 'block';
        });

        document.getElementById('cancelEdit').addEventListener('click', function() {
            document.getElementById('profileDisplay').style.display = 'block';
            document.getElementById('editProfileFormContainer').style.display = 'none';
        });
    </script>
</body>
</html>
