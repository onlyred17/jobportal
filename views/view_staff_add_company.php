<?php
session_start();
// Get the current page/module name (without the .php extension)
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="../css/sidebar.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <link href="../css/staff_add_company.css" rel="stylesheet">
</head>
<body>
   <?php
    include '../include/navbar_user.php';
    include '../include/sidebar.php';

   ?>

    <div class="company-container">
        <div class="company-card">
            <h2 class="company-title"><i class="fas fa-building"></i> Add Company</h2>

            <form action="../controllers/staff_add_company.php" method="POST" enctype="multipart/form-data">
                <div class="company-field">
                    <label>Company Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter company name" required>
                </div>
                <div class="company-field">
                    <label>Location</label>
                    <input type="text" name="location" class="form-control" placeholder="Enter company location" required>
                </div>
                <div class="company-field">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter company description" required></textarea>
                </div>
                <div class="company-field">
                    <label>Company Logo</label>
                    <input type="file" name="logo" class="form-control" accept="image/png, image/jpeg">
                </div>
                <button type="submit" class="company-btn"><i class="fas fa-plus"></i> Add Company</button>
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
