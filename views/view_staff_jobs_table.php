<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
 <!-- Scripts - Include only once at the bottom of the page -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
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
            <form method="GET" action="">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo htmlspecialchars($startDate); ?>" />
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo htmlspecialchars($endDate); ?>" />
                        </div>
                        <div class="col-md-4">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="" <?php echo $statusFilter === '' ? 'selected' : ''; ?>>All</option>
                                <option value="Open" <?php echo $statusFilter === 'Open' ? 'selected' : ''; ?>>Open</option>
                                <option value="Closed" <?php echo $statusFilter === 'Closed' ? 'selected' : ''; ?>>Closed</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter me-1"></i> Apply Filter
                        </button>
                        <a href="../controllers/generate_jobs_report.php?start_date=<?php echo $startDate; ?>&end_date=<?php echo $endDate; ?>&status=<?php echo $statusFilter; ?>&search=" 
   id="generateReportBtn" class="btn btn-danger" target="_blank">
   <i class="fas fa-file-pdf"></i> Generate Report
</a>
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postJobModal">
            <i class="fas fa-plus me-1"></i> Post Job
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
<!-- Post Job Modal -->
<div class="modal fade" id="postJobModal" tabindex="-1" aria-labelledby="postJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postJobModalLabel">
                    <i class="fas fa-briefcase text-primary me-1"></i> Post a New Job
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="postJobForm" method="POST" action="../controllers/staff_job_posting.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="company_id" class="form-label">
                            <i class="fas fa-building me-1 text-primary"></i> Select Company
                        </label>
                        <select class="form-control" id="company_id" name="company_id" required>
                            <option value="">-- Choose Company --</option>
                            <?php
                            // Fetch companies from the database
                            include '../include/db_conn.php'; // Ensure this path is correct
                            $query = "SELECT id, name FROM company";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $companies = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($companies as $company) {
                                echo "<option value='{$company['id']}'>{$company['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jobTitle" class="form-label">
                            <i class="fas fa-heading me-1 text-primary"></i> Job Title
                        </label>
                        <input type="text" class="form-control" id="jobTitle" name="jobTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="jobDescription" class="form-label">
                            <i class="fas fa-file-alt me-1 text-primary"></i> Description
                        </label>
                        <textarea class="form-control" id="jobDescription" name="jobDescription" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="jobLocation" class="form-label">
                            <i class="fas fa-map-marker-alt me-1 text-primary"></i> Location
                        </label>
                        <input type="text" class="form-control" id="jobLocation" name="jobLocation" required>
                    </div>
                    <div class="mb-3">
                        <label for="jobType" class="form-label">
                            <i class="fas fa-briefcase me-1 text-primary"></i> Job Type
                        </label>
                        <select class="form-control" id="jobType" name="jobType" required>
                            <option value="Full-time">Full-time</option>
                            <option value="Part-time">Part-time</option>
                            <option value="Contract">Contract</option>
                            <option value="Internship">Internship</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="salary" class="form-label">
                            <i class="fas fa-dollar-sign me-1 text-primary"></i> Salary
                        </label>
                        <input type="number" class="form-control" id="salary" name="salary" required>
                    </div>
                    <div class="mb-3">
                        <label for="requirements" class="form-label">
                            <i class="fas fa-list me-1 text-primary"></i> Requirements
                        </label>
                        <textarea class="form-control" id="requirements" name="requirements" rows="3" required></textarea>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Post Job
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feedbackModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="feedbackModalMessage"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
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
    // Initialize modals once
    const postJobModal = new bootstrap.Modal(document.getElementById('postJobModal'), {
        backdrop: 'static',
        keyboard: true
    });
    
    // Handle post job button click
    const postJobButton = document.querySelector('button[data-bs-target="#postJobModal"]');
    if (postJobButton) {
        postJobButton.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            postJobModal.show();
        });
    }
    
    // Fix for modal backdrop issue
    const modalElement = document.getElementById('postJobModal');
    modalElement.addEventListener('hidden.bs.modal', function() {
        // Remove any remaining backdrop
        const backdrops = document.getElementsByClassName('modal-backdrop');
        for (let backdrop of backdrops) {
            backdrop.remove();
        }
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
    });

    // Initialize DataTable
    const jobsTable = new DataTable('#jobsTable', {
        responsive: true,
        language: {
            search: "<i class='fas fa-search'></i> _INPUT_",
            searchPlaceholder: "Search...",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ jobs",
            infoEmpty: "Showing 0 to 0 of 0 jobs",
            paginate: {
                first: "<i class='fas fa-angle-double-left'></i>",
                previous: "<i class='fas fa-angle-left'></i>",
                next: "<i class='fas fa-angle-right'></i>",
                last: "<i class='fas fa-angle-double-right'></i>"
            }
        },
    });

    // Handle confirm modal
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
    
    // Also add the backdrop fix for the confirm modal
    confirmModal.addEventListener('hidden.bs.modal', function() {
        const backdrops = document.getElementsByClassName('modal-backdrop');
        for (let backdrop of backdrops) {
            backdrop.remove();
        }
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
    });
      
    // Update the Generate Report button with the current search term
    const generateReportBtn = document.getElementById('generateReportBtn');
    if (generateReportBtn) {
        jobsTable.on('search.dt', function() {
            const searchTerm = jobsTable.search();
            generateReportBtn.href = `../controllers/generate_jobs_report.php?start_date=<?php echo $startDate; ?>&end_date=<?php echo $endDate; ?>&status=<?php echo $statusFilter; ?>&search=${searchTerm}`;
        });
    }

    // Handle form submission
    const postJobForm = document.getElementById("postJobForm");
    if (postJobForm) {
        postJobForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent the form from submitting traditionally
            
            let formData = new FormData(this);

            fetch("../controllers/staff_job_posting.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Close the postJobModal first
                postJobModal.hide();
                
                // Then show the feedback modal
                let feedbackModal = new bootstrap.Modal(document.getElementById("feedbackModal"));
                document.getElementById("feedbackModalTitle").innerText = data.status === "success" ? "Success" : "Error";
                document.getElementById("feedbackModalMessage").innerText = data.message;
                
                feedbackModal.show();

                if (data.status === "success") {
                    setTimeout(() => {
                        location.reload(); // Reload after success
                    }, 2000);
                }
            })
            .catch(error => {
                // Close the postJobModal first
                postJobModal.hide();
                
                // Then show the feedback modal
                let feedbackModal = new bootstrap.Modal(document.getElementById("feedbackModal"));
                document.getElementById("feedbackModalTitle").innerText = "Error";
                document.getElementById("feedbackModalMessage").innerText = "An unexpected error occurred.";
                feedbackModal.show();
            });
        });
    }
});
</script>
</body>
</html>

