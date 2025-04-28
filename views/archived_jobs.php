<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archived Jobs</title>
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
        
        .status-archived {
            background-color: rgba(90, 92, 105, 0.1);
            color: var(--dark-color);
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
        
        .btn-restore {
            background-color: rgba(78, 115, 223, 0.1);
            color: var(--primary-color);
        }
        
        .btn-restore:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-delete {
            background-color: rgba(231, 74, 59, 0.1);
            color: var(--danger-color);
        }
        
        .btn-delete:hover {
            background-color: var(--danger-color);
            color: white;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        table.dataTable {
            width: 100% !important;
            margin: 0 !important;
        }
        
        div.dataTables_filter {
            text-align: right;
        }
    </style>
</head>
<body>
<?php
include '../controllers/archived_jobs_table.php';
include '../include/navbar_user.php';
include '../include/sidebar.php';
?>

<div class="main-content">
    <div class="container-fluid px-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Archived Job Listings</h1>
           
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
                <h6 class="m-0 font-weight-bold text-primary">Archived Jobs</h6>
                 <!-- Back Button -->
    <div class="mt-3">
        <a href="../views/view_staff_jobs_table.php" class="btn btn-success">
        <i class="fas fa-suitcase"></i>
        </a>
    </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="archivedJobsTable" class="table table-striped table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Job Title</th>
                                <th>Status</th>
                                <th>Posted Date</th>
                                <th>Archived Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($archivedJobs) && is_array($archivedJobs)) {
                                foreach ($archivedJobs as $job) {
                                    echo "<tr>
                                            <td>" . htmlspecialchars($job['company_name']) . "</td>
                                            <td>" . htmlspecialchars($job['title']) . "</td>
                                            <td><span class='status-badge status-archived'>Archived</span></td>
                                            <td>" . htmlspecialchars($job['posted_date']) . "</td>
                                            <td>" . htmlspecialchars($job['archived_date']) . "</td>
                                            <td class='action-btns'>
                                                <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#restoreModal' data-job-id='" . $job['id'] . "'>
                                                    <i class='fas fa-undo me-1'></i> Restore
                                                </button>
                                         
                                            </td>
                                        </tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Restoring Job -->
<div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="restoreModalLabel">Restore Job Listing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="fas fa-undo fa-3x text-primary mb-3"></i>
                    <p>Are you sure you want to restore this job listing? It will be moved back to the active job listings.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Cancel
                </button>
                <a href="#" id="restoreButton" class="btn btn-primary">
                    <i class="fas fa-undo me-1"></i> Restore
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Deleting Job -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Job Listing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                    <p>Are you sure you want to permanently delete this job listing? This action cannot be undone.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Cancel
                </button>
                <a href="#" id="deleteButton" class="btn btn-danger">
                    <i class="fas fa-trash me-1"></i> Delete Permanently
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize DataTable
        const archivedJobsTable = new DataTable('#archivedJobsTable', {
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
            }
        });

        // Handle restore modal
        const restoreModal = document.getElementById('restoreModal');
        restoreModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const jobId = button.getAttribute('data-job-id');
            
            const restoreButton = document.getElementById('restoreButton');
            restoreButton.href = `../controllers/restore_job.php?id=${jobId}`;
        });
        
        // Handle delete modal
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const jobId = button.getAttribute('data-job-id');
            
            const deleteButton = document.getElementById('deleteButton');
            deleteButton.href = `../controllers/delete_job.php?id=${jobId}`;
        });
        
        // Fix modal backdrop issues
        [restoreModal, deleteModal].forEach(modal => {
            modal.addEventListener('hidden.bs.modal', function() {
                const backdrops = document.getElementsByClassName('modal-backdrop');
                for (let backdrop of backdrops) {
                    backdrop.remove();
                }
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            });
        });
    });
</script>
</body>
</html>