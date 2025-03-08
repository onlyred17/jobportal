
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
        <h2>Dashboard Overview</h2>
        <div class="graphs">
            <div class="graph-container">
                <canvas id="applicationsChart"></canvas>
            </div>
            <div class="graph-container">
                <canvas id="jobsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Scripts -->
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