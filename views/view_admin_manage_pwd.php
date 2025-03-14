<?php
session_start();
include '../include/db_conn.php';

// Fetch only approved, for printing, for release, and released PWD registrations
$query = "SELECT * FROM pwd_registration WHERE status IN ('approved', 'for printing', 'for release', 'released')";
$stmt = $conn->prepare($query);
$stmt->execute();
$pwd_registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PWD Registration List</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/sidebar.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <link href="../css/company_table.css" rel="stylesheet">
    <!-- FontAwesome (for action icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
<?php include '../include/navbar.php'; include '../include/sidebar.php'; ?>
<div class="main-content">
    <h2>PWD Registration List</h2>
    
    <?php 
    // Display session message with status and full name
    if (isset($_SESSION['message'])) {
        echo '<div class="alert alert-' . $_SESSION['message']['type'] . ' alert-dismissible fade show" role="alert">';
        echo $_SESSION['message']['text'];
        if (!empty($_SESSION['message']['full_name']) && !empty($_SESSION['message']['status'])) {
            echo ' - ' . htmlspecialchars($_SESSION['message']['full_name']) . ' (Status: ' . htmlspecialchars($_SESSION['message']['status']) . ')';
        }
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        unset($_SESSION['message']); // Clear message after displaying
    }
    ?>
    
    <table id="pwdTable" class="table table-striped">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Address</th>
                <th>Disability Type</th>
                <th>Current Status</th>
                <th>Update Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pwd_registrations as $pwd): ?>
                <tr>
                    <td><?php echo htmlspecialchars($pwd['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($pwd['address']); ?></td>
                    <td><?php echo htmlspecialchars($pwd['disability_type']); ?></td>
                    <td><?php echo htmlspecialchars($pwd['status']); ?></td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $pwd['id']; ?>">Update</button>
                    </td>
                </tr>
                <!-- Update Status Modal -->
                <div class="modal fade" id="updateModal<?php echo $pwd['id']; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Status</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../controllers/update_pwd_status.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $pwd['id']; ?>">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Select Status</label>
                                        <select name="status" class="form-select">
                                            <option value="for printing">For Printing</option>
                                            <option value="for release">For Release</option>
                                            <option value="released">Released</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pwdTable').DataTable();
    });
</script>
</body>
</html>
