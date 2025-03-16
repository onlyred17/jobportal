

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Dashboard - PWD Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="../css/sidebar.css" rel="stylesheet">
    <link href="../css/employer_dashboard.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- For graphs -->
</head>
<body>
    <!-- Sidebar -->
    <?php include '../include/sidebar.php'; ?>

    <!-- Navbar -->
    <?php include '../include/navbar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard Graphs -->
        <section id="dashboard">
            <h2>Dashboard Overview</h2>
            <div class="graphs">
                <div class="graph-container">
                    <canvas id="applicationsChart"></canvas>
                </div>
                <div class="graph-container">
                    <canvas id="jobsChart"></canvas>
                </div>
            </div>
        </section>

        <!-- Job Posting Module -->
        <section id="job-posting">
            <h2>Job Posting</h2>
            <form id="jobPostForm" method="POST" action="">
                <div class="form-group">
                    <label for="jobTitle">Job Title</label>
                    <input type="text" id="jobTitle" name="jobTitle" required>
                </div>
                <div class="form-group">
                    <label for="jobDescription">Job Description</label>
                    <textarea id="jobDescription" name="jobDescription" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="jobLocation">Location</label>
                    <input type="text" id="jobLocation" name="jobLocation" required>
                </div>
                <button type="submit" name="jobPostForm" class="btn btn-primary">Post Job</button>
            </form>
        </section>

        <!-- Edit Profile -->
        <section id="edit-profile">
            <h2>Edit Profile</h2>
            <form id="profileForm" method="POST" action="">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="companyName">Company Name</label>
                    <input type="text" id="companyName" name="companyName" required>
                </div>
                <button type="submit" name="profileForm" class="btn btn-primary">Save Changes</button>
            </form>
        </section>
    </div>

    <!-- Scripts -->
    <script src="../scripts/employer_dashboard.js"></script>
    <script>
        // Charts
        const applicationsChart = new Chart(document.getElementById('applicationsChart'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Job Applications',
                    data: <?php echo json_encode($applicationsData); ?>,
                    backgroundColor: '#4A90E2',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });

        const jobsChart = new Chart(document.getElementById('jobsChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Jobs Posted',
                    data: <?php echo json_encode($jobsData); ?>,
                    borderColor: '#4A90E2',
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>
</body>
</html>