<?php
session_start();
// Include the database connection
include '../include/db_conn.php';

// Fetch all companies
$query = "SELECT * FROM company";
$stmt = $conn->prepare($query);
$stmt->execute();
$companies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company List</title>
    
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
        
        .company-logo {
            max-width: 80px;
            max-height: 80px;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            background-color: white;
            padding: 4px;
        }
        
        .action-btns {
            display: flex;
            gap: 0.5rem;
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
        
        .table-responsive {
            overflow-x: auto;
        }
        
        table.dataTable {
            width: 100% !important;
            margin: 0 !important;
        }
        
        .description-cell {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .modal-logo {
            width: 120px;
            height: 120px;
            object-fit: contain;
            display: block;
            margin: 0 auto 1rem auto;
            border-radius: 8px;
            padding: 4px;
            background-color: white;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        
        .btn-warning {
            color: #212529;
            background-color: var(--warning-color);
            border-color: var(--warning-color);
        }
        
        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
    </style>
</head>
<body>
<?php
include '../controllers/update_company.php';
include '../include/navbar.php';
include '../include/sidebar.php';
?>
<div class="main-content">
    <div class="container-fluid px-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Company List</h1>
           
        </div>
        
        <?php
        // Display session message
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-' . $_SESSION['message']['type'] . ' alert-dismissible fade show" role="alert">';
            echo '<i class="fas ' . ($_SESSION['message']['type'] == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle') . ' me-2"></i>';
            echo $_SESSION['message']['text'];
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
            unset($_SESSION['message']); // Clear message after displaying
        }
        ?>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Companies</h6>
                <a href="../controllers/generate_company_report.php?search=" 
   id="generateReportBtn" class="btn btn-danger">
   <i class="fas fa-file-pdf me-1"></i> Generate Report
</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="companiesTable" class="table table-striped table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Company Logo</th>
                                <th>Company Name</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($companies as $company): ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo htmlspecialchars($company['logo']); ?>" alt="<?php echo htmlspecialchars($company['name']); ?> Logo" class="company-logo">
                                    </td>
                                    <td class="align-middle font-weight-bold"><?php echo htmlspecialchars($company['name']); ?></td>
                                    <td class="align-middle">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        <?php echo htmlspecialchars($company['location']); ?>
                                    </td>
                                    <td class="align-middle description-cell" title="<?php echo htmlspecialchars($company['description']); ?>">
                                        <?php echo htmlspecialchars($company['description']); ?>
                                    </td>
                                    <td class="align-middle action-btns">
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateCompanyModal<?php echo $company['id']; ?>">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCompanyModal<?php echo $company['id']; ?>">
                                            <i class="fas fa-trash-alt me-1"></i> Delete
                                        </button>
                                    </td>
                                </tr>

                                <!-- Update Company Modal -->
                                <div class="modal fade" id="updateCompanyModal<?php echo $company['id']; ?>" tabindex="-1" aria-labelledby="updateCompanyModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateCompanyModalLabel">Update Company</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Company Logo Preview -->
                                                <img src="<?php echo htmlspecialchars($company['logo']); ?>" alt="Company Logo" class="modal-logo" id="logoPreview<?php echo $company['id']; ?>">
                                                
                                                <!-- Update Company Form -->
                                                <form method="POST" action="../controllers/update_company.php?id=<?php echo $company['id']; ?>" enctype="multipart/form-data">
                                                    <div class="mb-3">
                                                        <label for="name<?php echo $company['id']; ?>" class="form-label">
                                                            <i class="fas fa-building me-1 text-primary"></i> Company Name
                                                        </label>
                                                        <input type="text" class="form-control" id="name<?php echo $company['id']; ?>" name="name" value="<?php echo htmlspecialchars($company['name']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="location<?php echo $company['id']; ?>" class="form-label">
                                                            <i class="fas fa-map-marker-alt me-1 text-primary"></i> Location
                                                        </label>
                                                        <input type="text" class="form-control" id="location<?php echo $company['id']; ?>" name="location" value="<?php echo htmlspecialchars($company['location']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description<?php echo $company['id']; ?>" class="form-label">
                                                            <i class="fas fa-info-circle me-1 text-primary"></i> Description
                                                        </label>
                                                        <textarea class="form-control" id="description<?php echo $company['id']; ?>" name="description" rows="3" required><?php echo htmlspecialchars($company['description']); ?></textarea>
                                                    </div>
                                                    <!-- Logo upload input -->
                                                    <div class="mb-3">
                                                        <label for="logo<?php echo $company['id']; ?>" class="form-label">
                                                            <i class="fas fa-image me-1 text-primary"></i> Company Logo
                                                        </label>
                                                        <input type="file" class="form-control" id="logo<?php echo $company['id']; ?>" name="logo" accept="image/*" onchange="previewLogo(this, 'logoPreview<?php echo $company['id']; ?>')">
                                                        <div class="form-text">Leave empty to keep current logo</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end mt-4">
                                                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-save me-1"></i> Update Company
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Company Modal -->
                                <div class="modal fade" id="deleteCompanyModal<?php echo $company['id']; ?>" tabindex="-1" aria-labelledby="deleteCompanyModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteCompanyModalLabel">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                                                <h5>Are you sure you want to delete this company?</h5>
                                                <p class="text-muted"><?php echo htmlspecialchars($company['name']); ?></p>
                                                <p class="text-danger">This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-1"></i> Cancel
                                                </button>
                                                <a href="../controllers/delete_company.php?id=<?php echo $company['id']; ?>" class="btn btn-danger">
                                                    <i class="fas fa-trash-alt me-1"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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
        const companiesTable = new DataTable('#companiesTable', {
            responsive: true,
            language: {
                search: "<i class='fas fa-search'></i> _INPUT_",
                searchPlaceholder: "Search companies...",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ companies",
                infoEmpty: "Showing 0 to 0 of 0 companies",
                paginate: {
                    first: "<i class='fas fa-angle-double-left'></i>",
                    previous: "<i class='fas fa-angle-left'></i>",
                    next: "<i class='fas fa-angle-right'></i>",
                    last: "<i class='fas fa-angle-double-right'></i>"
                }
            }
        });
          // Update the Generate Report button with the current search term
    const generateReportBtn = document.getElementById('generateReportBtn');
    companiesTable.on('search.dt', function() {
        const searchTerm = companiesTable.search();
        generateReportBtn.href = `../controllers/generate_company_report.php?search=${encodeURIComponent(searchTerm)}`;
    });

    // Trigger the search event initially to set the correct href
    companiesTable.search();
});
 

    // Function to preview logo before upload
    function previewLogo(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    // Enable tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
    tooltipTriggerList.forEach(function(tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
  

</script>

</body>
</html>