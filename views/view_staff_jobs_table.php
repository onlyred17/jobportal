<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
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
            --dark-color: #5a5c69;
        }
        
        body {
            background-color: #f8f9fc;
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }
        
/* Main Content */
.main-content {
    margin-left: 260px;
    margin-top: 85px;
    padding: 2.5rem;
    transition: all 0.3s ease;
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
        
        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: flex-end;
            margin-bottom: 1rem;
            padding: 1rem;
            background-color: white;
            border-radius: 0.35rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        
        .date-input {
            flex: 1;
            min-width: 200px;
        }
        
        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .btn-submit:hover {
            background-color: #2e59d9;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        
        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
        }
        
        .status-open {
            background-color: rgba(28, 200, 138, 0.1);
            color: var(--success-color);
        }
        
        .status-closed {
            background-color: rgba(231, 74, 59, 0.1);
            color: var(--danger-color);
        }
        
        .action-btns {
            display: flex;
            gap: 0.5rem;
        }
        
        .action-btn {
            border: none;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .btn-open {
            background-color: rgba(28, 200, 138, 0.1);
            color: var(--success-color);
        }
        
        .btn-open:hover {
            background-color: var(--success-color);
            color: white;
        }
        
        .btn-close {
            background-color: rgba(246, 194, 62, 0.1);
            color: var(--warning-color);
        }
        
        .btn-close:hover {
            background-color: var(--warning-color);
            color: white;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        table.dataTable {
            width: 100% !important;
            margin: 0 !important;
        }
    </style>
</head>
<body>
<?php
include '../controllers/staff_jobs_table.php';
include '../include/navbar.php';
include '../include/sidebar.php';
?>

<div class="main-content">
    <div class="container-fluid px-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Job Listings</h1>
          
        </div>
        
        <?php 
        // Display session message
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-' . $_SESSION['message']['type'] . ' alert-dismissible fade show" role="alert">';
            echo '<i class="fas ' . ($_SESSION['message']['type'] == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle') . ' me-2"></i>';
            echo $_SESSION['message']['text'];
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
            unset($_SESSION['message']); // Clear the message after displaying
        }
        ?>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Filter Options</h6>
            </div>
            <div class="card-body">
                <form method="GET" action="" class="date-filter-form">
                    <div class="filter-container">
                        <div class="date-input">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo $startDate; ?>" />
                        </div>
                        <div class="date-input">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo $endDate; ?>" />
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter me-1"></i> Apply Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Job Listings</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="jobsTable" class="table table-striped table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Job Title</th>
                                <th>Status</th>
                                <th>Posted Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($jobs as $job) {
                                $status = strtolower($job['status']);
                                $statusClass = $status === 'open' ? 'status-open' : 'status-closed';
                                
                                echo "<tr>
                                        <td>" . htmlspecialchars($job['company_name']) . "</td>
                                        <td>" . htmlspecialchars($job['title']) . "</td>
                                        <td><span class='status-badge {$statusClass}'>" . htmlspecialchars($job['status']) . "</span></td>
                                        <td>" . htmlspecialchars($job['posted_date']) . "</td>
                                        <td class='action-btns'>
                                            <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#confirmModal' data-job-id='" . $job['id'] . "' data-status='Closed'>
                                                <i class='fas fa-lock me-1'></i> Close
                                            </button>
                                            <button class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#confirmModal' data-job-id='" . $job['id'] . "' data-status='Open'>
                                                <i class='fas fa-lock-open me-1'></i> Open
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

<!-- Modal for Confirmation -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Status Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i id="statusIcon" class="fas fa-question-circle fa-3x text-warning mb-3"></i>
                    <p>Are you sure you want to change the job status to <strong><span id="statusLabel"></span></strong>?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Cancel
                </button>
                <a href="#" id="confirmButton" class="btn btn-primary">
                    <i class="fas fa-check me-1"></i> Confirm
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jobsTable = new DataTable('#jobsTable', {
            responsive: true,
            language: {
                search: "<i class='fas fa-search'></i> _INPUT_",
                searchPlaceholder: "Search jobs...",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ jobs",
                infoEmpty: "Showing 0 to 0 of 0 jobs",
                paginate: {
                    first: "<i class='fas fa-angle-double-left'></i>",
                    previous: "<i class='fas fa-angle-left'></i>",
                    next: "<i class='fas fa-angle-right'></i>",
                    last: "<i class='fas fa-angle-double-right'></i>"
                }
            }
        });

        // Handle modal opening and setting up the confirmation link
        const confirmModal = document.getElementById('confirmModal');
        confirmModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const jobId = button.getAttribute('data-job-id');
            const status = button.getAttribute('data-status');
            
            const statusLabel = document.getElementById('statusLabel');
            const statusIcon = document.getElementById('statusIcon');
            const confirmButton = document.getElementById('confirmButton');
            
            statusLabel.textContent = status;
            
            // Update icon and button colors based on status
            if (status === 'Open') {
                statusIcon.className = 'fas fa-lock-open fa-3x text-success mb-3';
                confirmButton.className = 'btn btn-success';
            } else {
                statusIcon.className = 'fas fa-lock fa-3x text-warning mb-3';
                confirmButton.className = 'btn btn-warning';
            }
            
            confirmButton.href = `../controllers/update_job_status.php?id=${jobId}&status=${status}`;
        });
    });
</script>

</body>
</html>