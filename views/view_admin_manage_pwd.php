<?php
session_start();
include '../include/db_conn.php';
// Check for success or error messages
$success_message = isset($_GET['success']) ? $_GET['success'] : null;
$error_message = isset($_GET['error']) ? $_GET['error'] : null;
// Fetch only released PWD registrations
$query = "SELECT id, full_name, address, contact_number, email, birthdate, disability_type 
          FROM registered_pwd";
$stmt = $conn->prepare($query);
$stmt->execute();
$pwd_registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Registered PWD</title>
    <!-- Modern UI Framework -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables with Bootstrap 5 styling -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom Styles -->
    <link href="../css/sidebar.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --success-color: #1cc88a;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --info-color: #36b9cc;
            --dark-color: #5a5c69;
        }
        
        body {
            background-color: #f8f9fc;
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }
        
    /* Main Content */
.main-content {
    margin-left: 280px; /* Adjusted for wider sidebar */
    margin-top: 90px;
    padding: 2rem;
    transition: 0.3s;
}
        
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
        }
        
        .card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        table.dataTable {
            width: 100% !important;
            margin: 0 !important;
        }
        
        .disability-badge {
            background-color: rgba(54, 185, 204, 0.1);
            color: var(--info-color);
            font-size: 0.95rem;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-weight: 600;
            text-transform: uppercase;

        }
        
        .detail-field {
            background-color: #f8f9fc;
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
            padding: 0.75rem;
            margin-bottom: 1rem;
        }
        
        .detail-label {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
        }
        
        .detail-label i {
            margin-right: 0.5rem;
        }
        
        .detail-value {
            font-size: 1rem;
            margin: 0;
        }
        
        .btn-info {
            background-color: var(--info-color);
            border-color: var(--info-color);
            color: white;
        }
        
        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }
    </style>
</head>
<body>
<?php include '../include/navbar.php'; include '../include/sidebar.php'; ?>

<div class="main-content">
    <div class="container-fluid px-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Registered PWD</h1>
      
        </div>
        
        <?php 
        // Display session message
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-' . htmlspecialchars($_SESSION['message']['type']) . ' alert-dismissible fade show" role="alert">';
            echo '<i class="fas ' . ($_SESSION['message']['type'] == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle') . ' me-2"></i>';
            echo htmlspecialchars($_SESSION['message']['text']);
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
            unset($_SESSION['message']);
        }
        ?>
        
        <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">PWD List</h6>
        <div class="d-flex gap-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPwdModal">
    <i class="fas fa-plus me-1"></i> Add PWD
</button>

            <a href="../controllers/generate_manage_pwd_report.php" 
               id="generateReportBtn" class="btn btn-danger" target="_blank">
                <i class="fas fa-file-pdf me-1"></i> Generate Report
            </a>
        </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="pwdTable" class="table table-striped table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Birthdate</th>
                                <th>Disability Type</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pwd_registrations as $pwd): ?>
                                <tr>
                                    <td class="align-middle font-weight-bold"><?php echo htmlspecialchars($pwd['full_name']); ?></td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                            <span><?php echo htmlspecialchars($pwd['address']); ?></span>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-phone text-primary me-2"></i>
                                            <span><?php echo htmlspecialchars($pwd['contact_number']); ?></span>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-envelope text-primary me-2"></i>
                                            <span><?php echo htmlspecialchars($pwd['email']); ?></span>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar-alt text-primary me-2"></i>
                                            <span><?php echo htmlspecialchars($pwd['birthdate']); ?></span>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="disability-badge">
                                            <?php echo htmlspecialchars($pwd['disability_type']); ?>
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-info btn-sm view-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#viewModal"
                                                data-id="<?php echo $pwd['id']; ?>"
                                                data-name="<?php echo htmlspecialchars($pwd['full_name']); ?>"
                                                data-address="<?php echo htmlspecialchars($pwd['address']); ?>"
                                                data-contact="<?php echo htmlspecialchars($pwd['contact_number']); ?>"
                                                data-email="<?php echo htmlspecialchars($pwd['email']); ?>"
                                                data-birthdate="<?php echo htmlspecialchars($pwd['birthdate']); ?>"
                                                data-disability="<?php echo htmlspecialchars($pwd['disability_type']); ?>">
                                            <i class="fas fa-eye me-1"></i> View
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Details Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewModalLabel">
                    <i class="fas fa-id-card me-2"></i> Manage PWD
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="detail-field">
                    <div class="detail-label">
                        <i class="fas fa-user"></i> Full Name
                    </div>
                    <div class="detail-value" id="modalName"></div>
                </div>
                
                <div class="detail-field">
                    <div class="detail-label">
                        <i class="fas fa-map-marker-alt"></i> Address
                    </div>
                    <div class="detail-value" id="modalAddress"></div>
                </div>
                
                <div class="detail-field">
                    <div class="detail-label">
                        <i class="fas fa-phone"></i> Contact Number
                    </div>
                    <div class="detail-value" id="modalContact"></div>
                </div>
                
                <div class="detail-field">
                    <div class="detail-label">
                        <i class="fas fa-envelope"></i> Email Address
                    </div>
                    <div class="detail-value" id="modalEmail"></div>
                </div>
                
                <div class="detail-field">
                    <div class="detail-label">
                        <i class="fas fa-calendar-alt"></i> Birthdate
                    </div>
                    <div class="detail-value" id="modalBirthdate"></div>
                </div>
                
                <div class="detail-field">
                    <div class="detail-label">
                        <i class="fas fa-wheelchair"></i> Disability Type
                    </div>
                    <div class="detail-value">
                        <span class="disability-badge" id="modalDisability"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Close
                </button>
                <button type="button" class="btn btn-primary" id="printDetails">
                    <i class="fas fa-print me-1"></i> Print Details
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Add PWD Modal -->
<div class="modal fade" id="addPwdModal" tabindex="-1" aria-labelledby="addPwdModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addPwdModalLabel">
                    <i class="fas fa-user-plus me-2"></i> Add PWD
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../controllers/admin_add_pwd.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="fullName" class="form-label"><i class="fas fa-user"></i> Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="full_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label"><i class="fas fa-map-marker-alt"></i> Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label"><i class="fas fa-phone"></i> Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="birthdate" class="form-label"><i class="fas fa-calendar-alt"></i> Birthdate</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                    </div>
                    <div class="mb-3">
                        <label for="disability" class="form-label"><i class="fas fa-wheelchair"></i> Disability Type</label>
                        <input type="text" class="form-control" id="disability" name="disability_type" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save PWD
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">
                    <i class="fas fa-check-circle me-2"></i> Success
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <i class="fas fa-check-circle fa-2x me-3"></i>
                <span id="successMessage">PWD registered successfully!</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                    <i class="fas fa-check me-1"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Error Modal HTML -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="errorModalLabel"><i class="fas fa-exclamation-circle me-2"></i> Error</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <i class="fas fa-exclamation-circle fa-2x me-3"></i>
                <span><?php echo $error_message; ?></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Success Modal -->
<?php if ($success_message): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        });
    </script>
<?php endif; ?>

<!-- Error Modal -->
<?php if ($error_message): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        });
    </script>
<?php endif; ?>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize DataTable
        const pwdTable = new DataTable('#pwdTable', {
            responsive: true,
            language: {
                search: "<i class='fas fa-search'></i> _INPUT_",
                searchPlaceholder: "Search registrations...",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ registrations",
                infoEmpty: "Showing 0 to 0 of 0 registrations",
                paginate: {
                    first: "<i class='fas fa-angle-double-left'></i>",
                    previous: "<i class='fas fa-angle-left'></i>",
                    next: "<i class='fas fa-angle-right'></i>",
                    last: "<i class='fas fa-angle-double-right'></i>"
                }
            }
        });

        // When View button is clicked, fill the modal with PWD details
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const name = this.getAttribute('data-name');
                const address = this.getAttribute('data-address');
                const contact = this.getAttribute('data-contact');
                const email = this.getAttribute('data-email');
                const birthdate = this.getAttribute('data-birthdate');
                const disability = this.getAttribute('data-disability');

                document.getElementById('modalName').textContent = name;
                document.getElementById('modalAddress').textContent = address;
                document.getElementById('modalContact').textContent = contact;
                document.getElementById('modalEmail').textContent = email;
                document.getElementById('modalBirthdate').textContent = birthdate;
                document.getElementById('modalDisability').textContent = disability;
            });
        });

        // Print functionality (placeholder)
        document.getElementById('printDetails').addEventListener('click', function() {
            alert('Print functionality will be implemented here.');
            // In a real implementation, you would use window.print() or generate a PDF
        });
          // Get the Generate Report button
    const generateReportBtn = document.getElementById('generateReportBtn');

// Function to update the Generate Report button's URL
function updateGenerateReportUrl() {
    const searchTerm = pwdTable.search(); // Get the current search term
    generateReportBtn.href = `../controllers/generate_manage_pwd_report.php?search=${encodeURIComponent(searchTerm)}`;
}

// Update the URL when the search term changes
pwdTable.on('search.dt', function() {
    updateGenerateReportUrl();
});

// Trigger the update initially to set the correct URL
updateGenerateReportUrl();
    });
</script>

</body