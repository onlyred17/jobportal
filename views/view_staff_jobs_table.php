<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome (for action icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="../css/sidebar.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <link href="../css/jobs_table.css" rel="stylesheet">

    <style>
      /* You can add custom styles here */
    </style>
</head>
<body>
<?php
include '../controllers/staff_jobs_table.php';

include '../include/navbar.php';
include '../include/sidebar.php';
?>
    <div class="main-content">
        <h2>Job Listings</h2>
        
        <form method="GET" action="" class="date-filter-form">
    <div class="filter-container">
        <!-- Start Date -->
        <div class="date-input">
            <label for="start_date" class="label">Start Date:</label>
            <input type="date" name="start_date" id="start_date" class="input-field" value="<?php echo $startDate; ?>" />
        </div>

        <!-- End Date -->
        <div class="date-input">
            <label for="end_date" class="label">End Date:</label>
            <input type="date" name="end_date" id="end_date" class="input-field" value="<?php echo $endDate; ?>" />
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-submit">Filter</button>
    </div>
</form>

        <table id="jobsTable" class="table table-striped mt-4">
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
                    echo "<tr>
                            <td>" . htmlspecialchars($job['company_name']) . "</td>
                            <td>" . htmlspecialchars($job['title']) . "</td>
                            <td>" . htmlspecialchars($job['status']) . "</td>
                            <td>" . htmlspecialchars($job['posted_date']) . "</td>
                            <td class='action-btns'>
                                <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#confirmModal' data-job-id='" . $job['id'] . "' data-status='Closed'>Close</button>
                                <button class='btn btn-success' data-bs-toggle='modal' data-bs-target='#confirmModal' data-job-id='" . $job['id'] . "' data-status='Open'>Open</button>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
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
                    Are you sure you want to change the job status to <strong><span id="statusLabel"></span></strong>?
                </div>
                <div class="modal-footer">
                    <a href="#" id="confirmButton" class="btn btn-danger">Confirm</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#jobsTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false
            });

            // Handle modal opening and setting up the confirmation link
            $('#confirmModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var jobId = button.data('job-id'); // Extract info from data-* attributes
                var status = button.data('status');
                var statusLabel = status === 'Open' ? 'Open' : 'Closed'; // Set status label for the modal

                var modal = $(this);
                modal.find('#statusLabel').text(statusLabel); // Set the status label in the modal body
                modal.find('#confirmButton').attr('href', '../controllers/update_job_status.php?id=' + jobId + '&status=' + status); // Update the confirm button link
            });
        });
    </script>
</body>
</html>
