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
include '../controllers/update_company.php';
include '../include/navbar.php';
include '../include/sidebar.php';
?>
        <div class="main-content">
<?php
// Display session message
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-' . $_SESSION['message']['type'] . ' alert-dismissible fade show" role="alert">';
    echo $_SESSION['message']['text'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    unset($_SESSION['message']); // Clear message after displaying
}
            ?>
        <h2>Company List</h2>
        
        <table id="companiesTable" class="table table-striped">
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
    <img src="<?php echo htmlspecialchars($company['logo']); ?>" alt="Company Logo" style="max-width: 100px; max-height: 100px; object-fit: contain;">
</td>

                        
                        <!-- Displaying Name and Description -->
                        <td><?php echo htmlspecialchars($company['name']); ?></td>
                        <td><?php echo htmlspecialchars($company['location']); ?></td>
                        <td><?php echo htmlspecialchars($company['description']); ?></td>
                        
                        <td class="action-btns">
                            <!-- Update and Delete Links with updated button classes -->
                            <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateCompanyModal<?php echo $company['id']; ?>">Update</a>
                            <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCompanyModal<?php echo $company['id']; ?>">Delete</a>
                        </td>
                    </tr>

<!-- Update Company Modal -->
<div class="modal" id="updateCompanyModal<?php echo $company['id']; ?>" tabindex="-1" aria-labelledby="updateCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <!-- Displaying Company Logo -->
                <img src="<?php echo htmlspecialchars($company['logo']); ?>" alt="Company Logo" width="50" class="me-2">
                <h5 class="modal-title" id="updateCompanyModalLabel">Update Company</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Update Company Form -->
                <form method="POST" action="../controllers/update_company.php?id=<?php echo $company['id']; ?>" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $company['name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" value="<?php echo $company['location']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" required><?php echo $company['description']; ?></textarea>
                    </div>
                    <!-- Logo upload input -->
                    <div class="mb-3">
                        <label for="logo" class="form-label">Company Logo</label>
                        <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>



                    <!-- Delete Company Modal -->
                    <div class="modal" id="deleteCompanyModal<?php echo $company['id']; ?>" tabindex="-1" aria-labelledby="deleteCompanyModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteCompanyModalLabel">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this company?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="../controllers/delete_company.php?id=<?php echo $company['id']; ?>" class="btn btn-danger">Delete</a>
                                </div>
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
            $('#companiesTable').DataTable({
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
