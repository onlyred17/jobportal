<?php include 'partials/sidebar.php'; ?>
<?php include 'partials/navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - PWD Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="views/styles/sidebar.css" rel="stylesheet">
    <link href="views/styles/dashboard.css" rel="stylesheet">
</head>
<body>
    <!-- Sidebar -->
    <?php include 'partials/sidebar.php'; ?>

    <!-- Navbar -->
    <?php include 'partials/navbar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Edit Profile</h2>
        <form id="profileForm" method="POST" action="">
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="companyName">Company Name</label>
                <input type="text" id="companyName" name="companyName" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</body>
</html>