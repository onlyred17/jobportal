<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Staff</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="../css/sidebar.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <link href="../css/admin_add_staff.css" rel="stylesheet"> <!-- Create a new CSS file -->
</head>
<body>
    <?php
    include '../include/navbar.php';
    include '../include/sidebar.php';
    ?>

    <div class="staff-container">
        <div class="staff-card">
            <h2 class="staff-title"><i class="fas fa-user-plus"></i> Add Staff</h2>

            <form action="../controllers/admin_add_staff.php" method="POST">
                <div class="staff-field">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" placeholder="Enter first name" required>
                </div>
                <div class="staff-field">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Enter last name" required>
                </div>
                <div class="staff-field">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                </div>
                <div class="staff-field">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>
                <button type="submit" class="staff-btn"><i class="fas fa-user-plus"></i> Add Staff</button>
            </form>
        </div>
    </div>

    <!-- Modal for Success / Error -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message']['type'] == 'success' ? 'Success' : 'Error';
                        }
                        ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message']['text'];
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show modal if there's a message
        <?php if (isset($_SESSION['message'])): ?>
            var messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
            messageModal.show();
            <?php unset($_SESSION['message']); ?> // Clear session message after showing
        <?php endif; ?>
    </script>
</body>
</html>
