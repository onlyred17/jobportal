<?php
include '../include/db_conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM pwd_registration WHERE id = ?");
    $stmt->execute([$id]);
    $pwd = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pwd) {
        echo "No record found!";
        exit;
    }
} else {
    echo "Invalid request!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PWD Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2><?php echo htmlspecialchars($pwd['full_name']); ?></h2>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($pwd['address']); ?></p>
    <p><strong>Contact:</strong> <?php echo htmlspecialchars($pwd['contact_number']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($pwd['email']); ?></p>
    <p><strong>Birthdate:</strong> <?php echo htmlspecialchars($pwd['birthdate']); ?></p>
    <p><strong>Disability Type:</strong> <?php echo htmlspecialchars($pwd['disability_type']); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($pwd['status']); ?></p>
    <a href="pwd_list.php" class="btn btn-secondary">Back to List</a>
</div>
</body>
</html>
