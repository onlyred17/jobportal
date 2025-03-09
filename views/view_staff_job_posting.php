<?php
session_start();
include '../include/db_conn.php';

// Fetch companies from the database
$companies = [];
try {
    $stmt = $conn->prepare("SELECT id, name, logo FROM company");
    $stmt->execute();
    $companies = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Posting - PWD Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="../css/sidebar.css" rel="stylesheet">
    <link href="../css/dark_mode.css" rel="stylesheet">
    <link href="../css/employer_job_posting.css" rel="stylesheet">
    <link href="../css/modal.css" rel="stylesheet">

</head>
<body>
    <!-- Sidebar -->
    <?php include '../include/sidebar.php'; ?>

    <!-- Navbar -->
    <?php include '../include/navbar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Job Posting</h2>
        <div class="form-container">
        <form id="jobPostForm" method="POST" action="../controllers/staff_job_posting.php">
    
    <!-- Select Company -->
    <div class="form-group">
        <label for="companySelect">Select Company</label>
        <select id="companySelect" name="company_id" class="form-control" required>
            <option value="" selected disabled>Select a company</option>
            <?php foreach ($companies as $company): ?>
                <option value="<?= $company['id']; ?>"><?= htmlspecialchars($company['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

  

    <div class="form-group">
        <label for="jobTitle">Job Title</label>
        <input type="text" id="jobTitle" name="jobTitle" placeholder="e.g., Software Engineer" required class="form-control">
    </div>
    <div class="form-group">
        <label for="jobDescription">Job Description</label>
        <textarea id="jobDescription" name="jobDescription" placeholder="Describe the job role and responsibilities" required class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="jobLocation">Location</label>
        <input type="text" id="jobLocation" name="jobLocation" placeholder="e.g., Remote, New York" required class="form-control">
    </div>
    <div class="form-group">
        <label for="jobType">Job Type</label>
        <select id="jobType" name="jobType" required class="form-control">
            <option value="full-time">Full-time</option>
            <option value="part-time">Part-time</option>
            <option value="contract">Contract</option>
            <option value="internship">Internship</option>
        </select>
    </div>
    <div class="form-group">
        <label for="salary">Salary</label>
        <input type="text" id="salary" name="salary" placeholder="e.g., $50,000 - $70,000" required class="form-control">
    </div>
    <div class="form-group">
        <label for="requirements">Requirements</label>
        <textarea id="requirements" name="requirements" placeholder="List the skills and qualifications required" required class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Post Job</button>
</form>
        </div>
    </div>
    
<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Job posted successfully!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="errorMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Fetch company details when selecting a company
document.getElementById('companySelect').addEventListener('change', function () {
    let companyId = this.value;
    
    if (companyId) {
        fetch('../controllers/get_company_details.php?company_id=' + companyId)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('companyName').value = data.company_name;
                
                let logo = document.getElementById('companyLogo');
                if (data.company_logo) {
                    logo.src = '../uploads/logos/' + data.company_logo;
                    logo.style.display = 'block';
                } else {
                    logo.style.display = 'none';
                }
            } else {
                alert('Failed to fetch company details.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
});
document.getElementById('jobPostForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    // Get form data
    const formData = new FormData(this);

    // Submit form data via AJAX
    fetch('../controllers/staff_job_posting.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Show success modal
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            // Reset form after posting
            document.getElementById('jobPostForm').reset();

            // Optional: Refresh page after a few seconds
            setTimeout(() => location.reload(), 2000);
        } else {
            // Show error modal with the error message
            document.getElementById('errorMessage').textContent = data.message;
            const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        }
    })
    .catch(error => {
        // Show error modal for network errors
        document.getElementById('errorMessage').textContent = 'An error occurred while submitting the form.';
        const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        errorModal.show();
    });
});
</script>

</script>
</html>
