
<?php
session_start();
// Include the database connection
include '../include/db_conn.php';

// Fetch only pending PWD registrations
$query = "SELECT * FROM pwd_registration WHERE status = 'pending'";
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
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/sidebar.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <link href="../css/company_table.css" rel="stylesheet">
    <!-- FontAwesome (for action icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
<?php
include '../include/navbar.php';
include '../include/sidebar.php';
?>
        <div class="main-content">
<?php
// Display session message
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-' . $_SESSION['message']['type'] . ' alert-dismissible fade show" role="alert">';
    echo $_SESSION['message']['text'];
    if (!empty($_SESSION['message']['full_name'])) {
        echo ' - ' . htmlspecialchars($_SESSION['message']['full_name']);
    }
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    unset($_SESSION['message']); // Clear message after displaying
}
?>
        <h2>PWD Approval List</h2>
        
        <table id="pwdTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Disability Type</th>
                    <th>Current Status</th>
                    <th>Proof of PWD</th>
                    <th>Valid ID</th>
                    <th>Actions</th>
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
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#proofModal<?php echo $pwd['id']; ?>">View Proof</button>
                        </td>
                        <td>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#validIdModal<?php echo $pwd['id']; ?>">View Valid ID</button>
                        </td>

                        <td class="action-btns">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateStatusModal<?php echo $pwd['id']; ?>">Update</button>
                        </td>
                    </tr>

                 <!-- Valid ID Modal -->
<div class="modal" id="validIdModal<?php echo $pwd['id']; ?>" tabindex="-1" aria-labelledby="validIdModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="validIdModalLabel">Valid ID</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <iframe src="<?php echo htmlspecialchars($pwd['valid_id']); ?>" width="100%" height="500px"></iframe>
            </div>
        </div>
    </div>
</div>

                    <!-- Proof of PWD Modal -->
                    <div class="modal" id="proofModal<?php echo $pwd['id']; ?>" tabindex="-1" aria-labelledby="proofModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="proofModalLabel">Proof of PWD</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <iframe src="<?php echo htmlspecialchars($pwd['proof_of_pwd']); ?>" width="100%" height="500px"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Update Status Modal -->
                    <div class="modal" id="updateStatusModal<?php echo $pwd['id']; ?>" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateStatusModalLabel">Update Status</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../controllers/update_pwd_status.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?php echo $pwd['id']; ?>">
                                        <label for="status" class="form-label">Select Status:</label>
                                        <select name="status" class="form-control">
                                            <option value="approved">Approved</option>
                                            <option value="rejected">Rejected</option>
                                            <option value="for_printing">For Printing</option>
                                            <option value="for_release">For Release</option>
                                            <option value="released">Released</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#pwdTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false
        });
    });
</script>
</body>
</html>