<?php
session_start();
// Include the database connection
include '../include/db_conn.php';

// Get date parameters from URL (if provided)
$date_from = isset($_GET['date_from']) ? $_GET['date_from'] : '';
$date_to = isset($_GET['date_to']) ? $_GET['date_to'] : '';
// Get status filter from URL (if provided)
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';

// Base query
$query = "SELECT * FROM pwd_registration WHERE status IN ('pending', 'approved', 'for printing', 'for release')";

// Add date filter if provided
if (!empty($date_from) && !empty($date_to)) {
    $query .= " AND DATE(created_at) BETWEEN :date_from AND :date_to";
} elseif (!empty($date_from)) {
    $query .= " AND DATE(created_at) >= :date_from";
} elseif (!empty($date_to)) {
    $query .= " AND DATE(created_at) <= :date_to";
}

// Add status filter if provided
if (!empty($status_filter)) {
    $query .= " AND LOWER(status) = LOWER(:status_filter)";
}

$stmt = $conn->prepare($query);

// Bind parameters if date filters are applied
if (!empty($date_from)) {
    $stmt->bindParam(':date_from', $date_from);
}
if (!empty($date_to)) {
    $stmt->bindParam(':date_to', $date_to);
}

// Bind status parameter if status filter is applied
if (!empty($status_filter)) {
    $stmt->bindParam(':status_filter', $status_filter);
}

$stmt->execute();
$pwd_registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PWD Registration List</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables with Bootstrap 5 styling -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="../css/sidebar.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <link href="../css/company_table.css" rel="stylesheet">
    
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
    background-color: var(--secondary-color);
    font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    margin: 0;
    padding: 0;
}

/* Main Content */
.main-content {
    margin-left: 280px;
    margin-top: 90px;
    padding: 2rem;
    transition: margin-left 0.3s ease;
    min-height: 100vh;
}

@media (max-width: 768px) {
    .main-content {
        margin-left: 0;
        padding: 1rem;
    }
}

/* Cards */
.card {
    border: none;
    border-radius: 0.35rem;
    box-shadow: 0 0.15rem 1.75rem rgba(58, 59, 69, 0.15);
    background-color: #fff;
}

/* Card Header */
.card-header {
    background-color: var(--secondary-color);
    border-bottom: 1px solid #e3e6f0;
    padding: 1rem 1.25rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

/* Status Badges */
.status-badge {
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-pending {
    background-color: rgba(246, 194, 62, 0.1);
    color: var(--warning-color);
}

.status-approved {
    background-color: rgba(28, 200, 138, 0.1);
    color: var(--success-color);
}

.status-rejected {
    background-color: rgba(231, 74, 59, 0.1);
    color: var(--danger-color);
}

.status-for-printing,
.status-for-release {
    background-color: rgba(78, 115, 223, 0.1);
    color: var(--primary-color);
}

.status-released {
    background-color: rgba(54, 185, 204, 0.1);
    color: var(--info-color);
}

/* Date Filter */
.date-filter-container {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 1rem;
}

.date-filter-container label {
    font-weight: 600;
}

/* Date Range Filter */
.date-range-filter {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Action Buttons */
.action-btns {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.action-btns button {
    display: flex;
    align-items: center;
    justify-content: center;
}

.action-btns button i {
    margin-right: 0.25rem;
}

/* Table Responsive */
.table-responsive {
    overflow-x: auto;
}

/* Iframe Container */
.iframe-container {
    width: 100%;
    height: 500px;
    overflow: hidden;
    border-radius: 0.35rem;
    box-shadow: 0 0.15rem 1.75rem rgba(58, 59, 69, 0.1);
    margin-top: 1rem;
}

.iframe-container iframe {
    width: 100%;
    height: 100%;
    border: none;
}

/* Status Filter Styles */
.filter-section {
    display: flex;
    gap: 15px;
    align-items: center;
    flex-wrap: wrap;
}

.status-filter-container {
    display: flex;
    align-items: center;
    gap: 10px;
}

.status-filter-container label {
    font-weight: 600;
    margin-bottom: 0;
}

.status-filter-container select {
    min-width: 150px;
}
    </style>
</head>
<body>
<?php
include '../include/navbar.php';
include '../include/sidebar.php';
?>
<div class="main-content">
    <div class="container-fluid px-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">PWD Registration Records</h1>
         
        </div>
        
        <?php
        // Display session message
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-' . $_SESSION['message']['type'] . ' alert-dismissible fade show" role="alert">';
            echo '<i class="fas ' . ($_SESSION['message']['type'] == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle') . ' me-2"></i>';
            echo $_SESSION['message']['text'];
            if (!empty($_SESSION['message']['full_name'])) {
                echo ' - ' . htmlspecialchars($_SESSION['message']['full_name']);
            }
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
            unset($_SESSION['message']); // Clear message after displaying
        }
        ?>
        
        <!-- Filter Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Filter Options</h6>
            </div>
            <div class="card-body">
                <form id="filterForm" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="d-flex flex-column gap-3">
                    <!-- Date Range Filter -->
                    <div class="filter-section">
                        <div class="date-range-filter">
                        <label for="dateFrom" style="font-weight: bold;"><i class="fas fa-calendar-alt me-1"></i> From:</label>
                        <input type="date" id="dateFrom" name="date_from" class="form-control" value="<?php echo $date_from; ?>">
                        </div>
                        
                        <div class="date-range-filter">
                        <label for="dateTo" style="font-weight: bold;"><i class="fas fa-calendar-alt me-1"></i> To:</label>
                        <input type="date" id="dateTo" name="date_to" class="form-control" value="<?php echo $date_to; ?>">
                        </div>
                        
                        <!-- Status Filter -->
                        <div class="status-filter-container">
                            <label for="statusFilter"><i class="fas fa-filter me-1"></i> Status:</label>
                            <select id="statusFilter" name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="pending" <?php echo ($status_filter === 'pending') ? 'selected' : ''; ?>>Pending</option>
                                <option value="approved" <?php echo ($status_filter === 'approved') ? 'selected' : ''; ?>>Approved</option>
                                <option value="for printing" <?php echo ($status_filter === 'for printing') ? 'selected' : ''; ?>>For Printing</option>
                                <option value="for release" <?php echo ($status_filter === 'for release') ? 'selected' : ''; ?>>For Release</option>
                            </select>
                        </div>
                         <div class="ms-auto">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter me-1"></i> Apply Filters
                        </button>
                        <button type="button" id="generatePdfButton" class="btn btn-danger">
                            <i class="fas fa-file-pdf me-1"></i> Generate PDF
                        </button>
                        <button type="button" id="generateExcelButton" class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Generate Excel
                        </button>
                        <?php if (!empty($date_from) || !empty($date_to) || !empty($status_filter)): ?>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary ms-2">
                            <i class="fas fa-times me-1"></i> Clear Filters
                        </a>
                        <?php endif; ?>
                    </div>
                    </div>
                    
                   
                </form>
            </div>
        </div>
        
<!-- PWD Registration Records Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">PWD List</h6>
    
    </div>
    <div class="card-body">
        <?php if (count($pwd_registrations) > 0): ?>
        <div class="table-responsive">
            <table id="pwdTable" class="table table-striped table-hover" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Disability Type</th>
                        <th>Status</th>
                        <th>Proof of PWD</th>
                        <th>Type Of Valid ID</th>
                        <th>Valid Front ID</th>
                        <th>Valid Back ID</th>
                        <th>Registration Date</th>
                        <th>Actions</th>
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
                                <span class="disability-badge">
                                    <?php echo htmlspecialchars($pwd['disability_type']); ?>
                                </span>
                            </td>
                            <td class="align-middle">
                                <?php
                                $statusClass = '';
                                $status = strtolower($pwd['status']);
                                
                                if ($status == 'pending') {
                                    $statusClass = 'status-pending';
                                } elseif ($status == 'approved') {
                                    $statusClass = 'status-approved';
                                } elseif ($status == 'rejected') {
                                    $statusClass = 'status-rejected';
                                } elseif ($status == 'for printing' || $status == 'for release') {
                                    $statusClass = 'status-for-printing';
                                } elseif ($status == 'released') {
                                    $statusClass = 'status-released';
                                }
                                ?>
                                <span class="status-badge <?php echo $statusClass; ?>">
                                    <?php echo htmlspecialchars($pwd['status']); ?>
                                </span>
                            </td>
                            <td class="align-middle">
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#proofModal<?php echo $pwd['id']; ?>">
                                    <i class="fas fa-file-medical me-1"></i> View Proof
                                </button>
                            </td>
                            <td class="align-middle">
                                <span class="valid-id-type">
                                    <?php echo htmlspecialchars($pwd['valid_id_type']); ?>
                                </span>
                            </td>
                            <td class="align-middle">
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#validIdModal<?php echo $pwd['id']; ?>">
                                    <i class="fas fa-id-card me-1"></i> View front
                                </button>
                            </td>
                            <td class="align-middle">
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#backIdModal<?php echo $pwd['id']; ?>">
                                    <i class="fas fa-id-card me-1"></i> View Back
                                </button>
                            </td>

                            <td class="align-middle">
                                <span class="registration-date">
                                    <?php echo date("F j, Y", strtotime($pwd['created_at'])); ?>
                                </span>
                            </td>

                            <td class="align-middle action-btns">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateStatusModal<?php echo $pwd['id']; ?>">
                                    <i class="fas fa-edit me-1"></i> Update
                                </button>
                            </td>
                        </tr>

                     <!-- Valid ID Modal -->
<div class="modal fade" id="validIdModal<?php echo $pwd['id']; ?>" tabindex="-1" aria-labelledby="validIdModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="validIdModalLabel">
                    <i class="fas fa-id-card me-2"></i> Front of Valid ID
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="<?php echo htmlspecialchars($pwd['valid_id']); ?>" class="img-fluid" alt="Valid ID" />
            </div>
        </div>
    </div>
</div>

                  <!-- Back of Valid ID Modal -->
<div class="modal fade" id="backIdModal<?php echo $pwd['id']; ?>" tabindex="-1" aria-labelledby="backIdModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="backIdModalLabel">
                    <i class="fas fa-id-card me-2"></i> Back of Valid ID
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="<?php echo htmlspecialchars($pwd['valid_id_back']); ?>" class="img-fluid" alt="Back of Valid ID" />
            </div>
        </div>
    </div>
</div>

                       <!-- Proof of PWD Modal -->
<div class="modal fade" id="proofModal<?php echo $pwd['id']; ?>" tabindex="-1" aria-labelledby="proofModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="proofModalLabel">
                    <i class="fas fa-file-medical me-2"></i> Proof of PWD
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="<?php echo htmlspecialchars($pwd['proof_of_pwd']); ?>" class="img-fluid" alt="Proof of PWD" />
            </div>
        </div>
    </div>
</div>


                     <!-- Update Status Modal -->
<div class="modal fade" id="updateStatusModal<?php echo htmlspecialchars($pwd['id']); ?>" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="updateStatusModalLabel">
                    <i class="fas fa-edit me-2"></i> Update Status
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../controllers/update_pwd_status.php" method="POST">
                <div class="modal-body">
                    <!-- Hidden input to send ID -->
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($pwd['id']); ?>">

                    <div class="mb-3">
                        <label for="status<?php echo $pwd['id']; ?>" class="form-label">
                            <i class="fas fa-tag me-1"></i> Select Status:
                        </label>
                        <select name="status" id="status<?php echo $pwd['id']; ?>" class="form-select" required onchange="toggleRejectionReason(<?php echo $pwd['id']; ?>)">
                            <option value="" disabled selected>Choose status</option>
                            <option value="Approved" <?php echo (strtolower($pwd['status']) == 'approved') ? 'selected' : ''; ?>>Approved</option>
                            <option value="Rejected" <?php echo (strtolower($pwd['status']) == 'rejected') ? 'selected' : ''; ?>>Rejected</option>
                            <option value="For Printing" <?php echo (strtolower($pwd['status']) == 'for printing') ? 'selected' : ''; ?>>For Printing</option>
                            <option value="For Release" <?php echo (strtolower($pwd['status']) == 'for release') ? 'selected' : ''; ?>>For Release</option>
                            <option value="Released" <?php echo (strtolower($pwd['status']) == 'released') ? 'selected' : ''; ?>>Released</option>
                        </select>
                    </div>

                <!-- Reason for Rejection (hidden by default) -->
<div class="mb-3" id="rejectionReasonContainer<?php echo $pwd['id']; ?>" style="display: none;">
    <label for="rejectionReason<?php echo $pwd['id']; ?>" class="form-label">
        <i class="fas fa-comment-alt me-1"></i> Reason for Rejection:
    </label>
    <textarea name="rejection_reason" id="rejectionReason<?php echo $pwd['id']; ?>" class="form-control" rows="3" placeholder="Enter reason for rejection"></textarea>
</div>

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i> No records found matching your filter criteria.
        </div>
        <?php endif; ?>
    </div>
</div>


<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    // Only initialize DataTable if there are records in the table
    if ($("#pwdTable tbody tr").length > 0) {
        // Initialize DataTable with advanced options
        const pwdTable = $('#pwdTable').DataTable({
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
            },
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            // Don't save state to prevent any issues with conflicting filters
            stateSave: false
        });
    }

    // Get the filter inputs
    const dateFromInput = document.getElementById('dateFrom');
    const dateToInput = document.getElementById('dateTo');
    const statusFilterInput = document.getElementById('statusFilter');

    // Generate PDF Button
    document.getElementById('generatePdfButton').addEventListener('click', function() {
        const dateFrom = dateFromInput.value || '';
        const dateTo = dateToInput.value || '';
        const statusFilter = statusFilterInput.value || '';
        const searchTerm = $('#pwdTable_filter input').val() || '';
        
        const pdfUrl = `../controllers/generate_pwd_report.php?date_from=${dateFrom}&date_to=${dateTo}&status=${statusFilter}&search=${encodeURIComponent(searchTerm)}`;
        window.open(pdfUrl, '_blank');
    });

    // Generate Excel Button
    document.getElementById('generateExcelButton').addEventListener('click', function() {
        const dateFrom = dateFromInput.value || '';
        const dateTo = dateToInput.value || '';
        const statusFilter = statusFilterInput.value || '';
        
        const excelUrl = `../controllers/generate_registration_report_excel.php?date_from=${dateFrom}&date_to=${dateTo}&status=${statusFilter}`;
        window.open(excelUrl, '_blank');
    });

    // Date validation to ensure "to" date is not before "from" date
    $("#dateTo").on("change", function() {
        const dateFrom = $("#dateFrom").val();
        const dateTo = $(this).val();
        
        if (dateFrom && dateTo && dateFrom > dateTo) {
            alert("'To' date cannot be earlier than 'From' date!");
            $(this).val('');
        }
    });
    
    // Date validation for "from" date when "to" date is already set
    $("#dateFrom").on("change", function() {
        const dateFrom = $(this).val();
        const dateTo = $("#dateTo").val();
        
        if (dateFrom && dateTo && dateFrom > dateTo) {
            alert("'From' date cannot be later than 'To' date!");
            $(this).val('');
        }
    });
});

// Function to show or hide the reason for rejection input based on the selected status
function toggleRejectionReason(pwdId) {
    const statusSelect = document.getElementById('status' + pwdId);
    const rejectionReasonContainer = document.getElementById('rejectionReasonContainer' + pwdId);
    
    if (statusSelect.value === 'Rejected') {
        rejectionReasonContainer.style.display = 'block'; // Show the reason input
    } else {
        rejectionReasonContainer.style.display = 'none'; // Hide the reason input
    }
}

// Ensure the "Reason for Rejection" input is visible if the status is already "Rejected"
document.addEventListener('DOMContentLoaded', function() {
    <?php foreach ($pwd_registrations as $pwd): ?>
        <?php if (strtolower($pwd['status']) == 'rejected'): ?>
            toggleRejectionReason(<?php echo $pwd['id']; ?>);
        <?php endif; ?>
    <?php endforeach; ?>
});
</script>
</body>
</html>