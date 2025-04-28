<?php
session_start();
include '../controllers/audit_logs.php'; // Fetch logs from DB
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="../css/sidebar.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fc;
            font-family: 'Nunito', sans-serif;
        }
        .main-content {
            margin-left: 260px;
            margin-top: 85px;
            padding: 2.5rem;
            transition: all 0.3s ease;
        }
        @media (max-width: 768px) {
            .main-content { margin-left: 0; }
        }
        .card {
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
        }
        .status-success { background-color: rgba(28, 200, 138, 0.1); color: #1cc88a; }
        .status-warning { background-color: rgba(246, 194, 62, 0.1); color: #f6c23e; }
        .status-danger { background-color: rgba(231, 74, 59, 0.1); color: #e74a3b; }
        .table-responsive { overflow-x: auto; }
        table.dataTable { width: 100% !important; }

    /* Fix description overflow inside the modal */
    #logDescription {
        word-wrap: break-word;
        white-space: pre-wrap; /* Keeps line breaks */
    }

    </style>
</head>
<body>
<?php
include '../include/navbar_user.php';
include '../include/sidebar.php';
?>

<div class="main-content">
    <div class="container-fluid px-4">
        <h1 class="h3 mb-4 text-gray-800">Audit Logs</h1>

        <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Audit Logs</h6>
<div class="d-flex gap-2"> <!-- Add a container with flexbox -->
    <button id="generateExcelButton" class="btn btn-success">
        <i class="fas fa-file-excel"></i> Generate Excel
    </button>
    <a href="../controllers/generate_audit_report.php" class="btn btn-danger" target="_blank">
        <i class="fas fa-download"></i> Generate PDF
    </a>
</div>
</div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="auditTable" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Action</th>
                                <th>Description</th>
                                <th>Timestamp</th>
                                <th>User Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($audit_logs as $log) {
                                $statusClass = strtolower($log['action']) === 'login' ? 'status-success' :
                                               (strtolower($log['action']) === 'update' ? 'status-warning' : 'status-danger');

                                echo "<tr>
                                        <td>" . htmlspecialchars($log['full_name']) . "</td>
                                        <td><span class='status-badge {$statusClass}'>" . htmlspecialchars($log['action']) . "</span></td>
                                        <td>" . htmlspecialchars($log['description']) . "</td>
                                        <td>" . htmlspecialchars($log['created_at']) . "</td>
                                        <td>" . htmlspecialchars($log['usertype']) . "</td>
                                        <td>
                                            <button class='btn btn-primary btn-sm view-log' data-bs-toggle='modal' data-bs-target='#logModal'
                                                data-user='" . htmlspecialchars($log['full_name']) . "' 
                                                data-action='" . htmlspecialchars($log['action']) . "' 
                                                data-description='" . htmlspecialchars($log['description']) . "' 
                                                data-ip='" . htmlspecialchars($log['ip_address']) . "' 
                                                data-timestamp='" . htmlspecialchars($log['created_at']) . "' 
                                                data-usertype='" . htmlspecialchars($log['usertype']) . "'>
                                                <i class='fas fa-eye'></i> View
                                            </button>
                                        </td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL FOR VIEWING FULL LOG DETAILS -->
<div class="modal fade" id="logModal" tabindex="-1" aria-labelledby="logModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-file-alt"></i> Audit Log Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr><th>User</th><td id="logUser"></td></tr>
                        <tr><th>Action</th><td id="logAction"></td></tr>
                        <tr><th>Description</th><td id="logDescription"></td></tr>
                        <tr><th>IP Address</th><td id="logIP"></td></tr>
                        <tr><th>Timestamp</th><td id="logTimestamp"></td></tr>
                        <tr><th>User Type</th><td id="logUserType"></td></tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable and store it in a variable
    const table = $('#auditTable').DataTable();
    
    // Update the Generate Report button with the current search term
    table.on('search.dt', function() {
        const searchTerm = table.search();
        const reportUrl = `../controllers/generate_super_admin_audit_report.php?search=${encodeURIComponent(searchTerm)}`;
        $('.btn-danger').attr('href', reportUrl);
    });

    // Your existing modal code
    $(document).on("click", ".view-log", function() {
        $('#logUser').text($(this).data('user'));
        $('#logAction').text($(this).data('action'));
        $('#logDescription').text($(this).data('description'));
        $('#logIP').text($(this).data('ip'));
        $('#logTimestamp').text($(this).data('timestamp'));
        $('#logUserType').text($(this).data('usertype'));
    });
});
document.getElementById('generateExcelButton').addEventListener('click', function () {
    // Make an AJAX request to trigger the PHP script for generating the Excel file
    fetch('../controllers/generate_audit_report_excel.php', {
        method: 'GET',
    })
    .then(response => {
        if (response.ok) {
            window.location.href = '../controllers/generate_audit_report_excel.php'; // Redirect to download the file
        } else {
            alert("Failed to generate the Excel file.");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("An error occurred while generating the Excel file.");
    });
});
   
</script>


</body>
</html>
