<?php
session_start();
include '../include/db_conn.php';

// Fetch staff data
$sql = "SELECT staff_id, first_name, last_name, email, usertype, status FROM staff";
$stmt = $conn->prepare($sql);
$stmt->execute();
$staff_members = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="../css/sidebar.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    
    <style>
        :root {
            --success-color: #1cc88a;
            --danger-color: #e74a3b;
        }

        .main-content {
            margin-left: 280px;
            margin-top: 90px;
            padding: 2rem;
            transition: margin-left 0.3s;
            min-height: 100vh;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Nunito', sans-serif;
        }

        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background-color: #ffffff;
            border-bottom: 2px solid #e3e6f0;
            font-weight: bold;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: 500;
            display: inline-block;
            text-transform: uppercase;
            font-size: .75rem;
        }

        .status-active {
            background-color: rgba(28, 200, 138, 0.1);
            color: var(--success-color);
        }

        .status-inactive {
            background-color: rgba(231, 74, 59, 0.1);
            color: var(--danger-color);
        }

        .btn {
            border-radius: 0.3rem;
        }

        .modal-header {
            border-bottom: none;
        }

        .add-staff-btn {
            margin-left: auto;
        }
    </style>
</head>
<body>

<?php include '../include/navbar_user.php'; ?>
<?php include '../include/sidebar.php'; ?>

<div class="main-content">
    <h1 class="h3 text-dark">Manage Staff</h1>

    <!-- Session Message Display -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible fade show" role="alert">
            <i class="fas <?= ($_SESSION['message']['type'] == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle') ?> me-2"></i>
            <?= $_SESSION['message']['text'] ?>
            <?php if (!empty($_SESSION['message']['full_name'])): ?>
                - <?= htmlspecialchars($_SESSION['message']['full_name']) ?>
            <?php endif; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); // Clear message after displaying ?>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="text-primary">Staff List</h6>
            <!-- Add Staff Button -->
            <button class="btn btn-success btn-sm add-staff-btn" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                <i class="fas fa-plus"></i> Add Staff
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="staffTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($staff_members as $staff): ?>
                            <tr>
                                <td><?= htmlspecialchars($staff['first_name']) ?></td>
                                <td><?= htmlspecialchars($staff['last_name']) ?></td>
                                <td><?= htmlspecialchars($staff['email']) ?></td>
                                <td><?= htmlspecialchars(ucfirst($staff['usertype'])) ?></td>
                                <td>
                                    <span class="status-badge <?= strtolower(trim($staff['status'])) === 'active' ? 'status-active' : 'status-inactive' ?>">
                                        <?= htmlspecialchars($staff['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm update-staff" data-bs-toggle="modal" data-bs-target="#updateStaffModal"
                                        data-id="<?= $staff['staff_id'] ?>"
                                        data-firstname="<?= htmlspecialchars($staff['first_name']) ?>"
                                        data-lastname="<?= htmlspecialchars($staff['last_name']) ?>"
                                        data-email="<?= htmlspecialchars($staff['email']) ?>"
                                        data-status="<?= htmlspecialchars($staff['status']) ?>">
                                        <i class="fas fa-edit"></i> Update
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

<!-- Add Staff Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="fas fa-user-plus"></i> Add Staff</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="../controllers/super_admin_add_staff.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Enter first name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Enter last name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Add Staff
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Update Staff Modal -->
<div class="modal fade" id="updateStaffModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-user-edit"></i> Update Staff Status</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="../controllers/super_admin_update_staff.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="staff_id" id="staffId">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="staffFullName" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" id="staffEmail" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" id="staffStatus">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#staffTable').DataTable();

        $('.update-staff').on('click', function() {
            $('#staffId').val($(this).data('id'));
            $('#staffFullName').val($(this).data('firstname') + " " + $(this).data('lastname'));
            $('#staffEmail').val($(this).data('email'));
            $('#staffStatus').val($(this).data('status'));
        });
    });
</script>
</body>
</html>
